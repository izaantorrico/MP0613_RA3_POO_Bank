<?php
namespace ComBank\Bank;
 
use ComBank\Exceptions\BankAccountException;
use ComBank\Exceptions\InvalidArgsException;
use ComBank\Exceptions\ZeroAmountException;
use ComBank\OverdraftStrategy\NoOverdraft;
use ComBank\Bank\Contracts\BankAccountInterface;
use ComBank\Exceptions\FailedTransactionException;
use ComBank\Exceptions\InvalidOverdraftFundsException;
use ComBank\OverdraftStrategy\Contracts\OverdraftInterface;
use ComBank\Support\Traits\AmountValidationTrait;
use ComBank\Transactions\Contracts\BankTransactionInterface;
use ComBank\Support\Traits\CurrencyValidationTrait;
class BankNationalAccount extends BankAccount implements BankAccountInterface{

private string $currency ='';
private float $balance;
use CurrencyValidationTrait;
 public function __construct(float $balance, string $currency)
    {
        parent::__construct($balance);
        $this->currency = $currency;
        
    }

public function getCurrency(): string
    {
        return $this->currency;
    }
 
    public function setCurrency(string $currency):void
    {
        $this->validateCurrency($currency);
        $this->currency = $currency;
    }
    public function getFormattedBalance(string $currency , float $balance): string{
        
        return $this->balance;
        return $this->currency;
        
    }
    











}