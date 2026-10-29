<?php

namespace ComBank\Bank;

/**
 * Created by VS Code.
 * User: JPortugal
 * Date: 7/27/24
 * Time: 7:25 PM
 */

use ComBank\Bank\Contracts\BankAccountInterface;
use ComBank\Exceptions\BankAccountException;
use ComBank\Exceptions\InvalidArgsException;
use ComBank\Exceptions\ZeroAmountException;
use ComBank\OverdraftStrategy\NoOverdraft;
use ComBank\Exceptions\FailedTransactionException;
use ComBank\Exceptions\InvalidOverdraftFundsException;
use ComBank\OverdraftStrategy\Contracts\OverdraftInterface;
use ComBank\Support\Traits\AmountValidationTrait;
use ComBank\Transactions\Contracts\BankTransactionInterface;



class BankAccount implements BankAccountInterface
{
   
    //overdaçraft


    // applyOverdrft(Overdraft)
        // this-> overdraft = Overdraft;

    // getOverdarft()
        // return overdraft;


        private float $balance;
    private bool $status;
    private OverdraftInterface $overdraft;
    private string $email;

    public function __construct(float $balance, string $email)
    {
        $this->balance = $balance;
        $this->status = true;
        $this->overdraft = new NoOverdraft();
        $this->setEmail($email);
    }
    /**
     * Get the value of balance
     */
    public function getBalance()
    {
        return $this->balance;
    }

    public function closeAcount()
    {
        return $this->status = false;
    }

    public function reopenAcount()
    {
        return $this->status = true;
    }

    public function transaction(BankTransactionInterface $bankTransaction): void
    {
        $this->balance = $bankTransaction->applyTransaction($this);
    }

    /**
     * Get the value of status
     */
    public function getStatus()
    {
        return $this->status;
    }
     public function applyOverdraft(OverdraftInterface $overdraft): void
    {
        $this->overdraft = $overdraft;
    }

    public function getOverdraft(): OverdraftInterface
    {
        return $this->overdraft;
    
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $email = trim($email);
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            throw new InvalidArgsException('Invalid email format');
        }
        $this->email = $email;
    }

}