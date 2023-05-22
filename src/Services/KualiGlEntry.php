<?php

namespace Savannabits\KualiCompanion\Services;

use Carbon\Carbon;
use Savannabits\KualiCompanion\Enums\DebitCreditCode;
use Savannabits\KualiCompanion\Enums\EncumbranceUpdateCode;

class KualiGlEntry
{
    public function __construct(
        private string $chartOfAccountsCode,
        private string $accountNumber,
        private string $objectCode,
        private string $documentTypeCode,
        private string $systemOriginationCode,
        private string $financialDocumentNumber,
        private string $transactionDescription,
        private float $transactionAmount,
        private DebitCreditCode $debitCreditCode,
        private Carbon $transactionDate,
        private ?string $fiscalYear = null,
        private ?string $subAccountNumber = null,
        private ?string $subObjectCode = null,
        private ?string $balanceTypeCode = null,
        private ?string $objectTypeCode = null,
        private ?string $fiscalPeriodCode = null,
        private ?string $entrySequenceNumber = null,
        private ?string $organizationDocumentNumber = null,
        private ?string $projectCode = null,
        private ?string $organizationReferenceId = null,
        private ?string $referenceDocumentTypeCode = null,
        private ?string $referenceOriginationCode = null,
        private ?string $referenceDocumentNumber = null,
        private ?Carbon $reversalDate = null,
        private ?EncumbranceUpdateCode $encumbranceUpdateCode = null,
    )
    {
    }
    public static function make(
        string $chartOfAccountsCode,
        string $accountNumber,
        string $objectCode,
        string $documentTypeCode,
        string $systemOriginationCode,
        string $financialDocumentNumber,
        string $transactionDescription,
        float $transactionAmount,
        DebitCreditCode $debitCreditCode,
        Carbon $transactionDate,
        ?string $fiscalYear = null,
        ?string $subAccountNumber = null,
        ?string $subObjectCode = null,
        ?string $balanceTypeCode = null,
        ?string $objectTypeCode = null,
        ?string $fiscalPeriodCode = null,
        ?string $entrySequenceNumber = null,
        ?string $organizationDocumentNumber = null,
        ?string $projectCode = null,
        ?string $organizationReferenceId = null,
        ?string $referenceDocumentTypeCode = null,
        ?string $referenceOriginationCode = null,
        ?string $referenceDocumentNumber = null,
        ?Carbon $reversalDate = null,
        ?EncumbranceUpdateCode $encumbranceUpdateCode = null,
    ): KualiGlEntry
    {
        return new self(
            $chartOfAccountsCode,
        $accountNumber,
        $objectCode,
        $documentTypeCode,
        $systemOriginationCode,
        $financialDocumentNumber,
        $transactionDescription,
        $transactionAmount,
        $debitCreditCode,
        $transactionDate,
        $fiscalYear,
        $subAccountNumber,
        $subObjectCode,
        $balanceTypeCode,
        $objectTypeCode,
        $fiscalPeriodCode,
        $entrySequenceNumber,
        $organizationDocumentNumber,
        $projectCode,
        $organizationReferenceId,
        $referenceDocumentTypeCode,
        $referenceOriginationCode,
        $referenceDocumentNumber,
        $reversalDate,
        $encumbranceUpdateCode,
        );
    }

    /**
     * @param string|null $fiscalYear
     * @return KualiGlEntry
     */
    public function fiscalYear(?string $fiscalYear): KualiGlEntry
    {
        $this->fiscalYear = $fiscalYear;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFiscalYear(): ?string
    {
        return $this->fiscalYear;
    }

    /**
     * @param string $chartOfAccountsCode
     * @return KualiGlEntry
     */
    public function chartOfAccountsCode(string $chartOfAccountsCode): KualiGlEntry
    {
        $this->chartOfAccountsCode = $chartOfAccountsCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getChartOfAccountsCode(): string
    {
        return $this->chartOfAccountsCode;
    }

    /**
     * @param string $accountNumber
     * @return KualiGlEntry
     */
    public function accountNumber(string $accountNumber): KualiGlEntry
    {
        $this->accountNumber = $accountNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getAccountNumber(): string
    {
        return $this->accountNumber;
    }

    /**
     * @param string|null $subAccountNumber
     * @return KualiGlEntry
     */
    public function subAccountNumber(?string $subAccountNumber): KualiGlEntry
    {
        $this->subAccountNumber = $subAccountNumber;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSubAccountNumber(): ?string
    {
        return $this->subAccountNumber;
    }

    /**
     * @param string $objectCode
     * @return KualiGlEntry
     */
    public function objectCode(string $objectCode): KualiGlEntry
    {
        $this->objectCode = $objectCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getObjectCode(): string
    {
        return $this->objectCode;
    }

    /**
     * @param string|null $subObjectCode
     * @return KualiGlEntry
     */
    public function subObjectCode(?string $subObjectCode): KualiGlEntry
    {
        $this->subObjectCode = $subObjectCode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSubObjectCode(): ?string
    {
        return $this->subObjectCode;
    }

    /**
     * @param string|null $balanceTypeCode
     * @return KualiGlEntry
     */
    public function balanceTypeCode(?string $balanceTypeCode): KualiGlEntry
    {
        $this->balanceTypeCode = $balanceTypeCode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getBalanceTypeCode(): ?string
    {
        return $this->balanceTypeCode;
    }

    /**
     * @param string|null $objectTypeCode
     * @return KualiGlEntry
     */
    public function objectTypeCode(?string $objectTypeCode): KualiGlEntry
    {
        $this->objectTypeCode = $objectTypeCode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getObjectTypeCode(): ?string
    {
        return $this->objectTypeCode;
    }

    /**
     * @param string|null $fiscalPeriodCode
     * @return KualiGlEntry
     */
    public function fiscalPeriodCode(?string $fiscalPeriodCode): KualiGlEntry
    {
        $this->fiscalPeriodCode = $fiscalPeriodCode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFiscalPeriodCode(): ?string
    {
        return $this->fiscalPeriodCode;
    }

    /**
     * @param string $documentTypeCode
     * @return KualiGlEntry
     */
    public function documentTypeCode(string $documentTypeCode): KualiGlEntry
    {
        $this->documentTypeCode = $documentTypeCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getDocumentTypeCode(): string
    {
        return $this->documentTypeCode;
    }

    /**
     * @param string $systemOriginationCode
     * @return KualiGlEntry
     */
    public function systemOriginationCode(string $systemOriginationCode): KualiGlEntry
    {
        $this->systemOriginationCode = $systemOriginationCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getSystemOriginationCode(): string
    {
        return $this->systemOriginationCode;
    }

    /**
     * @param string $financialDocumentNumber
     * @return KualiGlEntry
     */
    public function financialDocumentNumber(string $financialDocumentNumber): KualiGlEntry
    {
        $this->financialDocumentNumber = $financialDocumentNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getFinancialDocumentNumber(): string
    {
        return $this->financialDocumentNumber;
    }

    /**
     * @param string|null $entrySequenceNumber
     * @return KualiGlEntry
     */
    public function entrySequenceNumber(?string $entrySequenceNumber): KualiGlEntry
    {
        $this->entrySequenceNumber = $entrySequenceNumber;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEntrySequenceNumber(): ?string
    {
        return $this->entrySequenceNumber;
    }

    /**
     * @param string $transactionDescription
     * @return KualiGlEntry
     */
    public function transactionDescription(string $transactionDescription): KualiGlEntry
    {
        $this->transactionDescription = $transactionDescription;
        return $this;
    }

    /**
     * @return string
     */
    public function getTransactionDescription(): string
    {
        return $this->transactionDescription;
    }

    /**
     * @param float $transactionAmount
     * @return KualiGlEntry
     */
    public function transactionAmount(float $transactionAmount): KualiGlEntry
    {
        $this->transactionAmount = $transactionAmount;
        return $this;
    }

    /**
     * @return float
     */
    public function getTransactionAmount(): float
    {
        return $this->transactionAmount;
    }

    /**
     * @param DebitCreditCode $debitCreditCode
     * @return KualiGlEntry
     */
    public function debitCreditCode(DebitCreditCode $debitCreditCode): KualiGlEntry
    {
        $this->debitCreditCode = $debitCreditCode;
        return $this;
    }

    /**
     * @return DebitCreditCode
     */
    public function getDebitCreditCode(): DebitCreditCode
    {
        return $this->debitCreditCode;
    }

    /**
     * @param Carbon $transactionDate
     * @return KualiGlEntry
     */
    public function transactionDate(Carbon $transactionDate): KualiGlEntry
    {
        $this->transactionDate = $transactionDate;
        return $this;
    }

    /**
     * @return Carbon
     */
    public function getTransactionDate(): Carbon
    {
        return $this->transactionDate;
    }

    /**
     * @param string|null $organizationDocumentNumber
     * @return KualiGlEntry
     */
    public function organizationDocumentNumber(?string $organizationDocumentNumber): KualiGlEntry
    {
        $this->organizationDocumentNumber = $organizationDocumentNumber;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getOrganizationDocumentNumber(): ?string
    {
        return $this->organizationDocumentNumber;
    }

    /**
     * @param string|null $projectCode
     * @return KualiGlEntry
     */
    public function projectCode(?string $projectCode): KualiGlEntry
    {
        $this->projectCode = $projectCode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getProjectCode(): ?string
    {
        return $this->projectCode;
    }

    /**
     * @param string|null $organizationReferenceId
     * @return KualiGlEntry
     */
    public function organizationReferenceId(?string $organizationReferenceId): KualiGlEntry
    {
        $this->organizationReferenceId = $organizationReferenceId;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getOrganizationReferenceId(): ?string
    {
        return $this->organizationReferenceId;
    }

    /**
     * @param string|null $referenceDocumentTypeCode
     * @return KualiGlEntry
     */
    public function referenceDocumentTypeCode(?string $referenceDocumentTypeCode): KualiGlEntry
    {
        $this->referenceDocumentTypeCode = $referenceDocumentTypeCode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getReferenceDocumentTypeCode(): ?string
    {
        return $this->referenceDocumentTypeCode;
    }

    /**
     * @param string|null $referenceOriginationCode
     * @return KualiGlEntry
     */
    public function referenceOriginationCode(?string $referenceOriginationCode): KualiGlEntry
    {
        $this->referenceOriginationCode = $referenceOriginationCode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getReferenceOriginationCode(): ?string
    {
        return $this->referenceOriginationCode;
    }

    /**
     * @param string|null $referenceDocumentNumber
     * @return KualiGlEntry
     */
    public function referenceDocumentNumber(?string $referenceDocumentNumber): KualiGlEntry
    {
        $this->referenceDocumentNumber = $referenceDocumentNumber;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getReferenceDocumentNumber(): ?string
    {
        return $this->referenceDocumentNumber;
    }

    /**
     * @param Carbon|null $reversalDate
     * @return KualiGlEntry
     */
    public function reversalDate(?Carbon $reversalDate): KualiGlEntry
    {
        $this->reversalDate = $reversalDate;
        return $this;
    }

    /**
     * @return Carbon|null
     */
    public function getReversalDate(): ?Carbon
    {
        return $this->reversalDate;
    }

    /**
     * @param EncumbranceUpdateCode|null $encumbranceUpdateCode
     * @return KualiGlEntry
     */
    public function encumbranceUpdateCode(?EncumbranceUpdateCode $encumbranceUpdateCode): KualiGlEntry
    {
        $this->encumbranceUpdateCode = $encumbranceUpdateCode;
        return $this;
    }

    /**
     * @return EncumbranceUpdateCode|null
     */
    public function getEncumbranceUpdateCode(): ?EncumbranceUpdateCode
    {
        return $this->encumbranceUpdateCode;
    }
}
