<?php

use Illuminate\Database\Seeder;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currencies = include base_path('/vendor/torann/currency/resources/currencies.php');
        
        foreach($currencies as $code => $currency) {
            $currency['code'] = $code;
            Currency::create($currency);
        }

    }
}
