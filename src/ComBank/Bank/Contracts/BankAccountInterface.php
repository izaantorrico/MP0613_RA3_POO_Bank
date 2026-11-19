<?php namespace ComBank\Bank\Contracts;

/**
 * Created by VS Code.
 * User: JPortugal
 * Date: 7/27/24
 * Time: 7:26 PM
 */

use ComBank\Exceptions\BankAccountException;
use ComBank\Exceptions\FailedTransactionException;
use ComBank\OverdraftStrategy\Contracts\OverdraftInterface;
use ComBank\Transactions\Contracts\BankTransactionInterface;

interface BankAccountInterface
{
    const STATUS_OPEN = 'OPEN';
    const STATUS_CLOSED = 'CLOSED';

   public function getBalance();

    public function closeAccount();

    public function reopenAccount();

    public function transaction(BankTransactionInterface $bankTransaction):void;
    public function getStatus();
        public function applyOverdraft(OverdraftInterface $overdraft): void;

    public function getOverdraft(): OverdraftInterface;

    public function getEmail(): string;
    public function isOpen(): bool;

    public function setEmail(string $email): void;

}

