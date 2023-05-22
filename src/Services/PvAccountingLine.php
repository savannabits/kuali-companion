<?php

namespace Savannabits\KualiCompanion\Services;

use Illuminate\Support\Collection;
use Savannabits\KualiCompanion\Enums\DebitCreditCode;

class PvAccountingLine
{
    private string $chartCode = 'SU';
    private string $accountNumber;
    private ?string $subAccountNumber = '';
    private string $objectCode;
    private ?string $subObjectCode = '';
    private ?string $projectCode = '';
    private DebitCreditCode $debitCredit;
    private float $amount;
    private ?string $orgRefId = '';

    public static function make(
        string $chartCode,
        string $accountNumber,
        string $objectCode,
        float $amount,
        DebitCreditCode $debitCredit,
        ?string $subAccountNumber = '',
        ?string $subObjectCode = '',
        ?string $projectCode = '',
        ?string $orgRefId = ''
    ): PvAccountingLine
    {
        return (new self())
            ->chartCode($chartCode)
            ->accountNumber($accountNumber)
            ->objectCode($objectCode)
            ->amount($amount)
            ->debitCredit($debitCredit)
            ->subAccountNumber($subAccountNumber)
            ->projectCode($projectCode)
            ->subObjectCode($subObjectCode)
            ->orgRefId($orgRefId);
    }
    /**
     * @param string $chartCode
     * @return PvAccountingLine
     */
    public function chartCode(string $chartCode): PvAccountingLine
    {
        $this->chartCode = $chartCode;
        return $this;
    }

    /**
     * @param string $accountNumber
     * @return PvAccountingLine
     */
    public function accountNumber(string $accountNumber): PvAccountingLine
    {
        $this->accountNumber = $accountNumber;
        return $this;
    }

    /**
     * @param string|null $subAccountNumber
     * @return PvAccountingLine
     */
    public function subAccountNumber(?string $subAccountNumber = ''): PvAccountingLine
    {
        $this->subAccountNumber = $subAccountNumber;
        return $this;
    }

    /**
     * @param string $objectCode
     * @return PvAccountingLine
     */
    public function objectCode(string $objectCode): PvAccountingLine
    {
        $this->objectCode = $objectCode;
        return $this;
    }

    /**
     * @param string|null $subObjectCode
     * @return PvAccountingLine
     */
    public function subObjectCode(?string $subObjectCode = ''): PvAccountingLine
    {
        $this->subObjectCode = $subObjectCode;
        return $this;
    }

    /**
     * @param string|null $projectCode
     * @return PvAccountingLine
     */
    public function projectCode(?string $projectCode = ""): PvAccountingLine
    {
        $this->projectCode = $projectCode;
        return $this;
    }

    /**
     * @param DebitCreditCode $debitCredit
     * @return PvAccountingLine
     */
    public function debitCredit(DebitCreditCode $debitCredit): PvAccountingLine
    {
        $this->debitCredit = $debitCredit;
        return $this;
    }

    /**
     * @param float $amount
     * @return PvAccountingLine
     */
    public function amount(float $amount): PvAccountingLine
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @param string|null $orgRefId
     * @return PvAccountingLine
     */
    public function orgRefId(?string $orgRefId = ""): PvAccountingLine
    {
        $this->orgRefId = $orgRefId;
        return $this;
    }

    /**
     * @return string
     */
    public function getChartCode(): string
    {
        return $this->chartCode;
    }

    /**
     * @return string
     */
    public function getAccountNumber(): string
    {
        return $this->accountNumber;
    }

    /**
     * @return string
     */
    public function getSubAccountNumber(): string
    {
        return $this->subAccountNumber ?? '';
    }

    /**
     * @return string
     */
    public function getObjectCode(): string
    {
        return $this->objectCode;
    }

    /**
     * @return string
     */
    public function getSubObjectCode(): string
    {
        return $this->subObjectCode ?? '';
    }

    /**
     * @return string
     */
    public function getProjectCode(): string
    {
        return $this->projectCode ?? '';
    }

    /**
     * @return string
     */
    public function getDebitCredit(): string
    {
        return $this->debitCredit->value;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getOrgRefId(): string
    {
        return $this->orgRefId ?? '';
    }

    public function collect(): Collection
    {
        return collect([
            "chartCode"     => $this->getChartCode(),
            "accNbr"        => $this->getAccountNumber(),
            "subAccNbr"     => $this->getSubAccountNumber(),
            "objCode"       => $this->getObjectCode(),
            "subObjCode"    => $this->getSubObjectCode(),
            "projectCode"   => $this->getProjectCode(),
            "creditDebit"   => $this->getDebitCredit(),
            "amount"        => $this->getAmount(),
            "orgRefId"      => $this->getOrgRefId(),
        ]);
    }

    public function toJson(): string
    {
        return $this->collect()->toJson();
    }
}