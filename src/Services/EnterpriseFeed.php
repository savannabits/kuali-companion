<?php

namespace Savannabits\KualiCompanion\Services;

use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\FilesystemException;

class EnterpriseFeed
{
    const KUALI_PATH = '';
    /**
     * @var Collection<KualiGlEntry> $transactions
     */
    private Collection $transactions;
    public function __construct(private string $filesBaseName, private ?string $disk = null)
    {
        if (!$this->disk) $this->disk = config('kuali-companion.ef.default_disk','local');
        $this->transactions = collect();
    }

    public static function init(string $filesBaseName, ?string $disk = null): EnterpriseFeed
    {

        return new self($filesBaseName, $disk);
    }
    public static function getNextDocNumber(): ?string
    {
        try {
            return \Http::withoutVerifying()->get(config('kfs.ws_url') . '/nextDocumentNumber.do')->throw()->body();
        } catch (RequestException $e) {
            \Log::error($e);
            return null;
        }
    }

    public function addGlEntry(KualiGlEntry $transaction): static
    {
        // TODO: Process the Transaction
        $this->transactions->push($transaction);
        return $this;
    }

    private function generateGlFile(): bool|string
    {
        \Log::info("Generating Enterprise Feed Files:");
        $path = self::KUALI_PATH."/{$this->filesBaseName}.data";
        if (Storage::disk($this->disk)->fileExists($path)) {
            abort(500,'The file already exists');
        }
        abort_unless($this->transactions?->count(),500,'This entry has zero transactions');
        foreach ($this->transactions as $transaction) {
            $line = $this->formatGlEntry($transaction);
            $res = Storage::disk($this->disk)->append($path, $line);
            \Log::info($res);
        }
        return $path;
    }
    private function generateReconFile(): string
    {
        $path = self::KUALI_PATH."/{$this->filesBaseName}.recon";
        $glEntryTable = 'gl_entry_t';
        $entryAmountColumn = 'trn_ldgr_entr_amt';
        $amount = $this->transactions->sum(fn(KualiGlEntry $entry) => $entry->getTransactionAmount());
        $sign = $amount >= 0 ? '+': '-';
        Storage::disk($this->disk)->append($path, "c $glEntryTable ".\Str::padLeft($this->transactions->count(),10,'0').";");
        Storage::disk($this->disk)->append($path, "s $entryAmountColumn $sign".\Str::padLeft(number_format(abs($amount),2, thousands_separator: ''),21,'0').";");
        Storage::disk($this->disk)->append($path, 'e 02;');
        return $path;
    }
    private function generateDoneFile(): bool|string
    {
        $path = self::KUALI_PATH."/{$this->filesBaseName}.done";
        Storage::disk($this->disk)->put($path, '');
        return $path;
    }
    public function generateFiles(): array
    {
        if (Storage::disk($this->disk)->directoryMissing(self::KUALI_PATH)) {
            try {
                \Log::info("Attempting to create directory ".self::KUALI_PATH);
                Storage::disk($this->disk)->createDirectory(self::KUALI_PATH);
            } catch (FilesystemException $e) {
                \Log::error($e);
                abort(500,'Could not create the required '.self::KUALI_PATH.' directory');
            }
        }
        $data = $this->generateGlFile();
        $recon = $this->generateReconFile();
        $done = $this->generateDoneFile();
        return [$data,$recon,$done];
    }

    /**
     * @param string $filesBaseName
     * @return EnterpriseFeed
     */
    public function filesBaseName(string $filesBaseName): EnterpriseFeed
    {
        $this->filesBaseName = $filesBaseName;
        return $this;
    }

    /**
     * @return string
     */
    public function getFilesBaseName(): string
    {
        return $this->filesBaseName;
    }

    /**
     * @param string $disk
     * @return EnterpriseFeed
     */
    public function disk(string $disk): EnterpriseFeed
    {
        $this->disk = $disk;
        return $this;
    }

    /**
     * @return string
     */
    public function getDisk(): string
    {
        return $this->disk;
    }
    private function formatGlEntry(KualiGlEntry $entry): string
    {
        return
            \Str::padRight($entry->getFiscalYear() ?? '',4).
            \Str::padRight($entry->getChartOfAccountsCode(),2).
            \Str::padRight($entry->getAccountNumber(),7).
            \Str::padRight($entry->getSubAccountNumber() ?? '',5).
            \Str::padRight($entry->getObjectCode(),4).
            \Str::padRight($entry->getSubObjectCode() ?? '',3).
            \Str::padRight($entry->getBalanceTypeCode() ?? '',2).
            \Str::padRight($entry->getObjectTypeCode() ?? '',2).
            \Str::padRight($entry->getFiscalPeriodCode() ?? '',2).
            \Str::padRight($entry->getDocumentTypeCode(),4).
            \Str::padRight($entry->getSystemOriginationCode(),2).
            \Str::padRight($entry->getFinancialDocumentNumber(),14).
            \Str::padRight($entry->getEntrySequenceNumber() ?? '',5).
            \Str::padRight($entry->getTransactionDescription(),40).
            \Str::padLeft(number_format($entry->getTransactionAmount(),2,'.',''),21,'0').
            $entry->getDebitCreditCode()->value.
            \Str::padRight($entry->getTransactionDate()?->isoFormat('YYYY-MM-DD') ?? '',10).
            \Str::padRight($entry->getOrganizationDocumentNumber() ?? '',10).
            \Str::padRight($entry->getProjectCode() ?? '',10).
            \Str::padRight($entry->getOrganizationReferenceId() ?? '',8).
            \Str::padRight($entry->getReferenceDocumentTypeCode() ?? '',4).
            \Str::padRight($entry->getReferenceOriginationCode() ?? '',2).
            \Str::padRight($entry->getReferenceDocumentNumber() ?? '',14).
            \Str::padRight($entry->getReversalDate()?->isoFormat('YYYY-MM-DD') ?? '',10).
            \Str::padRight($entry->getEncumbranceUpdateCode()?->value ?? '',1);
    }
}