<?php namespace ComBank\Transactions;

use ComBank\Bank\Contracts\BankAccountInterface;
use ComBank\Exceptions\InvalidOverdraftFundsException;
use ComBank\Transactions\Contracts\BankTransactionInterface;

class WithdrawTransaction extends BaseTransaction implements BankTransactionInterface
{

    public function applyTransaction(BankAccountInterface $account): float
    {
        $newBalance = $account->getBalance() - $this->amount;

        if (!$account->getOverdraft()->isGrantOverdraftFunds($newBalance)) {
            throw new InvalidOverdraftFundsException('Your withdraw has reached the max overdraft allowed.');
        }

        return $newBalance;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

      public function getTransactionInfo(): string
    {
        return "WITHDRAW_TRANSACTION";
    }
}