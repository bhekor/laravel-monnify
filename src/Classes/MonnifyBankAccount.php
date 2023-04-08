<?php
/**
 * Created By: Ibidapo Adeolu
 * Project: laravel-monnify
 * Class Name: MonnifyBankAccount.php
 * Date Created: 7/14/20
 * Time Created: 5:23 PM
 */

namespace Bhekor\LaravelMonnify\Classes;


use Bhekor\LaravelMonnify\Exceptions\MonnifyInvalidParameterException;

class MonnifyBankAccount
{

    private $accountNumber;
    private $bankCode;
    private $accountName;

    /**
     * MonnifyBankAccount constructor.
     * @param string $accountName
     * @param string $accountNumber
     * @param string $bankCode
     * @throws MonnifyInvalidParameterException
     */
    public function __construct(string $accountNumber, string $bankCode, string $accountName = '')
    {
        $accountNumber = trim($accountNumber);
        $bankCode = trim($bankCode);

        if (empty($accountNumber))
            throw new MonnifyInvalidParameterException('Account Number can\'t be empty');
        else if (preg_match('#[^0-9]#', $accountNumber))
            throw new MonnifyInvalidParameterException('Account Number must be numeric');
        else if (strlen("{$accountNumber}") !== 10)
            throw new MonnifyInvalidParameterException('Account Number must be exactly 10 digits');

        if (empty($bankCode))
            throw new MonnifyInvalidParameterException('Bank Code can\'t be empty');
        else if (preg_match('#[^0-9]#', $bankCode))
            throw new MonnifyInvalidParameterException('Bank Code must be numeric');
        else if (strlen("{$bankCode}") !== 3)
            throw new MonnifyInvalidParameterException('Bank Code must be exactly 3 digits');

        $this->accountName = trim($accountName);
        $this->accountNumber = trim($accountNumber);
        $this->bankCode = trim($bankCode);
    }


    public function getBankCodeAndAccountNumber(): array
    {
        return [
            "accountNumber" => $this->accountNumber,
            "bankCode" => $this->bankCode,
        ];
    }

    public function getAccountName(): string
    {
        return $this->accountName;
    }

    public function getAccountNumber(): string
    {
        return $this->accountNumber;
    }


    public function getBankCode(): string
    {
        return $this->bankCode;
    }

    public function __toString(): string
    {
        return "{$this->getAccountNumber()}-{$this->getBankCode()}-{$this->getAccountName()}";
    }


}
