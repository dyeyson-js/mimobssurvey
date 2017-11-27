<?php

namespace App\Services;

use Currency;

class CurrencyService
{
    public function all()
    {
        $currencies = Currency::getCurrencies();
        
        uasort($currencies, function ($item1, $item2) {
            return $item1['name'] <=> $item2['name'];
        });

        return $currencies;
    }

    public function getCurrency($code = null) 
    {
        $currency = Currency::getCurrency($code);
        return $currency;
    }
}