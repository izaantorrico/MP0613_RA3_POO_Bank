<?php namespace ComBank\Transactions;

use ComBank\Bank\Contracts\BankAccountInterface;
use ComBank\Exceptions\FailedTransactionException;
use ComBank\Exceptions\InvalidOverdraftFundsException;
use ComBank\Transactions\Contracts\BankTransactionInterface;

class TransferTransaction extends BaseTransaction implements BankTransactionInterface
{


    
        private BankAccountInterface $destinationAccount;

        
        public function __construct(float $amount,BankAccountInterface $destinationAccount)
        {
             parent::__construct($amount);
             $this->destinationAccount = $destinationAccount;
        }

            public function applyTransaction(BankAccountInterface $bankAccount): float
    {
        // No se puede transferir a la misma cuenta
        if ($bankAccount === $this->destinationAccount) {
            throw new FailedTransactionException("Cannot transfer to the same account");
        }
        // El destino tiene que estar abierto
        if (!$this->destinationAccount->isOpen()) {
            throw new FailedTransactionException("Destination account is closed");
        }
        // ¿Tiene fondos el origen? (igual que en Withdraw)
        $newBalance = $bankAccount->getBalance() - $this->amount;
        if (!$bankAccount->getOverdraft()->isGrantOverdraftFunds($newBalance)) {
            throw new InvalidOverdraftFundsException("Insufficient funds for transfer");
        }
        // Todo correcto: sumamos al destino
        $this->destinationAccount->setBalance($this->destinationAccount->getBalance() + $this->amount);
        // Devolvemos el saldo nuevo del origen (BankAccount lo guarda)
        return $newBalance;
    }
    public function getAmount(): float
    {
        return $this->amount;
    }

      public function getTransactionInfo(): string
    {
        return "TRANSFER_TRANSACTION";
    }
}