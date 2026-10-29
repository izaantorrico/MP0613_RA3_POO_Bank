<?php namespace ComBank\Transactions;

/**
 * Created by VS Code.
 * User: JPortugal
 * Date: 7/28/24
 * Time: 1:22 PM
 */

use ComBank\Bank\Contracts\BankAccountInterface;
use ComBank\Exceptions\InvalidOverdraftFundsException;
use ComBank\Transactions\Contracts\BankTransactionInterface;

class WithdrawTransaction implements BankTransactionInterface
{

    private $amount;
    
    public function __construct($amount) {
        $this->amount = $amount;
    }

    public function applyTransaction(BankAccountInterface $account): float{
        
        return $account->getBalance() - $this->amount;
    }
    $newBalance = $bankAccount -> getBalance() - $this -> amount;
    if(!$bankAccount -> getOverdarft()->isOverdraft()->isGrantOverdraftFunds($newBalance)){
        throw new InvalidOverdraftFundsException(('Your withdraw has reach the max overdraft funds');
        
        return $newBalance;)
    }

    
    

    public function getAmount(): float{
        return $this->amount;
    }
   
}