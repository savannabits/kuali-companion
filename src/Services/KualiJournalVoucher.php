<?php

namespace Savannabits\KualiCompanion\Services;

use Illuminate\Support\Collection;

class KualiJournalVoucher
{

    private String $principalUserName="";
    private String $vc="";
    private String $description="";
    private String $orgDocNbr="";
    private String $explanation="";
    private String $fiscalYear="";
    private String $accPeriodCode="";
    private String $balanceTypeCode="";
    private Collection $accountingLines;
    private Collection $noteDescription;
    public function __construct()
    {
        $this->accountingLines = collect();
        $this->noteDescription = collect();
    }
    public static function init(): KualiJournalVoucher
    {
        return new static();
    }

    /**
     * @param AccountingLine $accountingLine
     * @return KualiJournalVoucher
     */
    public function addAccountingLine(AccountingLine $accountingLine): KualiJournalVoucher
    {
        $this->accountingLines->push($accountingLine->collect());
        return $this;
    }

    /**
     * @param Collection<AccountingLine> $accountingLines
     * @return KualiJournalVoucher
     */
    public function setAccountingLines(Collection $accountingLines): static
    {
        $this->accountingLines = $accountingLines->map(fn(AccountingLine $line) => $line->collect());
        return $this;
    }

    /**
     * @return Collection
     */
    public function getAccountingLines(): Collection
    {
        return $this->accountingLines;
    }
    public function addNoteDescription(string $note): static
    {
        $this->noteDescription->push($note);
        return $this;
    }

    /**
     * @return Collection
     */
    public function getNoteDescription(): Collection
    {
        return $this->noteDescription;
    }

    /**
     * @param Collection $notes
     * @return KualiJournalVoucher
     */
    public function setNoteDescription(Collection $notes): KualiJournalVoucher
    {
        $this->noteDescription = $notes;
        return $this;
    }

    public function toJson(bool $encrypt = false): string
    {
        $payload = $this->collect()->toJson();
        if ($encrypt) {
            $payload = app('sucipher')->encrypt($payload);
            abort_if(!$payload,500,"Failed to encrypt the payload.");
        }
        return $payload;
    }

    /**
     * @param String $principalUserName
     * @return KualiJournalVoucher
     */
    public function principalUserName(string $principalUserName): KualiJournalVoucher
    {
        $this->principalUserName = $principalUserName;
        return $this;
    }

    /**
     * @return String
     */
    public function getPrincipalUserName(): string
    {
        return $this->principalUserName;
    }

    /**
     * @param String $vc
     * @return KualiJournalVoucher
     */
    public function vc(string $vc): KualiJournalVoucher
    {
        $this->vc = $vc;
        return $this;
    }

    /**
     * @return String
     */
    public function getVc(): string
    {
        return $this->vc;
    }

    /**
     * @param String $description
     * @return KualiJournalVoucher
     */
    public function description(string $description): KualiJournalVoucher
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return String
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param String $orgDocNbr
     * @return KualiJournalVoucher
     */
    public function orgDocNbr(string $orgDocNbr): KualiJournalVoucher
    {
        $this->orgDocNbr = $orgDocNbr;
        return $this;
    }

    /**
     * @return String
     */
    public function getOrgDocNbr(): string
    {
        return $this->orgDocNbr;
    }

    /**
     * @param String $explanation
     * @return KualiJournalVoucher
     */
    public function explanation(string $explanation): KualiJournalVoucher
    {
        $this->explanation = $explanation;
        return $this;
    }

    /**
     * @return String
     */
    public function getExplanation(): string
    {
        return $this->explanation;
    }

    /**
     * @param String $fiscalYear
     * @return KualiJournalVoucher
     */
    public function fiscalYear(string $fiscalYear): KualiJournalVoucher
    {
        $this->fiscalYear = $fiscalYear;
        return $this;
    }

    /**
     * @param String $fiscalYear
     * @return KualiJournalVoucher
     */
    public function setFiscalYear(string $fiscalYear): KualiJournalVoucher
    {
        $this->fiscalYear = $fiscalYear;
        return $this;
    }

    /**
     * @return String
     */
    public function getFiscalYear(): string
    {
        return $this->fiscalYear;
    }

    /**
     * @param String $accPeriodCode
     * @return KualiJournalVoucher
     */
    public function accPeriodCode(string $accPeriodCode): KualiJournalVoucher
    {
        $this->accPeriodCode = $accPeriodCode;
        return $this;
    }

    /**
     * @return String
     */
    public function getAccPeriodCode(): string
    {
        return $this->accPeriodCode;
    }

    /**
     * @param String $balanceTypeCode
     * @return KualiJournalVoucher
     */
    public function balanceTypeCode(string $balanceTypeCode): KualiJournalVoucher
    {
        $this->balanceTypeCode = $balanceTypeCode;
        return $this;
    }

    /**
     * @return String
     */
    public function getBalanceTypeCode(): string
    {
        return $this->balanceTypeCode;
    }

    /**
     * @return Collection
     */
    public function collect(): Collection
    {
        return collect(get_object_vars($this));
    }
}