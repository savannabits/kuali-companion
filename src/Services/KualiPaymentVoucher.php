<?php

namespace Savannabits\KualiCompanion\Services;

use Illuminate\Support\Collection;

class KualiPaymentVoucher
{
    private string $paymentDescription;
    private string $paymentExplanation;
    private ?string $paymentType = 'CODE';
    private Collection $accountingLines;
    private Collection $paymentEntries;
    public function __construct()
    {
        $this->accountingLines = collect();
        $this->paymentEntries = collect();
    }
    public static function init(): KualiPaymentVoucher
    {
        return new static();
    }

    /**
     * @param PvAccountingLine $accountingLine
     * @return KualiPaymentVoucher
     */
    public function addAccountingLine(PvAccountingLine $accountingLine): KualiPaymentVoucher
    {
        $this->accountingLines->push($accountingLine->collect());
        return $this;
    }

    /**
     * @param Collection<PvAccountingLine> $accountingLines
     * @return KualiPaymentVoucher
     */
    public function setAccountingLines(Collection $accountingLines): static
    {
        $this->accountingLines = $accountingLines->map(fn(PvAccountingLine $line) => $line->collect());
        return $this;
    }

    /**
     * @return Collection
     */
    public function getAccountingLines(): Collection
    {
        return $this->accountingLines;
    }
    public function addPaymentEntry(KualiPaymentEntry $paymentEntry): static
    {
        $this->paymentEntries->push($paymentEntry->collect());
        return $this;
    }

    /**
     * @return Collection
     */
    public function getPaymentEntries(): Collection
    {
        return $this->paymentEntries;
    }

    /**
     * @param Collection<KualiPaymentEntry> $paymentEntries
     * @return KualiPaymentVoucher
     */
    public function setPaymentEntries(Collection $paymentEntries): KualiPaymentVoucher
    {
        $this->paymentEntries = $paymentEntries->map(fn(KualiPaymentEntry $entry) => $entry->collect());
        return $this;
    }

    /**
     * @param string|null $paymentType
     * @return KualiPaymentVoucher
     */
    public function paymentType(?string $paymentType = 'CODE'): KualiPaymentVoucher
    {
        $this->paymentType = $paymentType;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPaymentType(): ?string
    {
        return $this->paymentType;
    }

    /**
     * @param string $paymentExplanation
     * @return KualiPaymentVoucher
     */
    public function paymentExplanation(string $paymentExplanation): KualiPaymentVoucher
    {
        $this->paymentExplanation = $paymentExplanation;
        return $this;
    }

    /**
     * @return string
     */
    public function getPaymentExplanation(): string
    {
        return $this->paymentExplanation;
    }

    /**
     * @param string $paymentDescription
     * @return KualiPaymentVoucher
     */
    public function paymentDescription(string $paymentDescription): KualiPaymentVoucher
    {
        $this->paymentDescription = $paymentDescription;
        return $this;
    }

    /**
     * @return string
     */
    public function getPaymentDescription(): string
    {
        return $this->paymentDescription;
    }

    /**
     * @return Collection
     */
    public function collect(): Collection
    {
        return collect([
            "paymentDesc" => $this->getPaymentDescription(),
            "paymentExplanation" => $this->getPaymentExplanation(),
            "paymentType" => $this->getPaymentType(),
            "payments" => $this->getPaymentEntries(),
            "accountingLines" => $this->getAccountingLines()
        ]);
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
}