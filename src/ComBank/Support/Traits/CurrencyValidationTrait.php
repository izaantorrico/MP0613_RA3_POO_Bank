<?php namespace ComBank\Support\Traits;


use ComBank\Exceptions\InvalidArgsException;
use ComBank\Exceptions\ZeroAmountException;


trait CurrencyValidationTrait
{
    /**
     * @param string $currency
     * @throws InvalidArgsException
     * @throws ZeroAmountException
     */
    
        private function validateCurrency(string $currency): void
{
    if (!$currency = '$' || !$currency = '€') {
        throw new InvalidArgsException('The currency is wrong');
    }
}


    

}