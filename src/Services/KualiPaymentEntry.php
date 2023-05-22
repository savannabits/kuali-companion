<?php

namespace Savannabits\KualiCompanion\Services;

use Illuminate\Support\Collection;

class KualiPaymentEntry
{
    private string $preFormat = '';
    private ?string $currency = 'KES';
    private ?string $description = null;
    private float $amount = 0.0;
    private ?string $bankAccount = '';
    private ?string $payeeId = null;

    public static function make(
        string  $preFormat,
        float   $amount,
        string  $description,
        ?string $currency = 'KES',
        ?string $bankAccount = '',
        ?string $payeeId = null,
    ): static
    {
        $class = new static();
        $class->preFormat($preFormat)
            ->amount($amount)
            ->description($description)
            ->currency($currency)
            ->bankAccount($bankAccount)
            ->payeeId($payeeId ?? $preFormat);
        return $class;
    }

    public function collect(): Collection {
        return collect([
            'preFormat' => $this->getPreFormat(),
            'currency' => $this->getCurrency(),
            'description' => $this->getDescription(),
            'amount' => $this->getAmount(),
            'bankAccNo' => $this->getBankAccount(),
            'payeeId' => $this->getPayeeId()
        ]);
    }
    public function toJson(): string
    {
        return $this->collect()->toJson();
    }

    /**
     * @return string
     */
    public function getPreFormat(): string
    {
        return $this->preFormat;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return string|null
     */
    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return string|null
     */
    public function getBankAccount(): ?string
    {
        return $this->bankAccount;
    }

    /**
     * @return string|null
     */
    public function getPayeeId(): ?string
    {
        return $this->payeeId;
    }

    /**
     * @param string $preFormat
     * @return KualiPaymentEntry
     */
    public function preFormat(string $preFormat): KualiPaymentEntry
    {
        $this->preFormat = $preFormat;
        return $this;
    }

    /**
     * @param string|null $currency
     * @return KualiPaymentEntry
     */
    public function currency(?string $currency): KualiPaymentEntry
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @param string|null $description
     * @return KualiPaymentEntry
     */
    public function description(?string $description): KualiPaymentEntry
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @param float $amount
     * @return KualiPaymentEntry
     */
    public function amount(float $amount): KualiPaymentEntry
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @param string|null $bankAccount
     * @return KualiPaymentEntry
     */
    public function bankAccount(?string $bankAccount): KualiPaymentEntry
    {
        $this->bankAccount = $bankAccount;
        return $this;
    }

    /**
     * @param string|null $payeeId
     * @return KualiPaymentEntry
     */
    public function payeeId(?string $payeeId): KualiPaymentEntry
    {
        $this->payeeId = $payeeId;
        return $this;
    }
}