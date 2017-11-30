<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BalanceSheet extends Model
{
    protected $fillable = [
        'content'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'content' => 'array'
    ];

    public function participant()
    {
        return $this->belongsTo('App\Models\Participant');
    }

    /**
     * Net Worth Estimate Multiplier
     */

    public function getNetWorthEstimateMultiplierArrayAttribute()
    {
        return [
            21 => 1,
            22 => 2.5,
            23 => 3.5,
            24 => 5,
            25 => 6,
            26 => 7,
            27 => 8,
            28 => 10,
            29 => 11,
            30 => 12,
            31 => 14,
            32 => 17,
            33 => 19,
            34 => 22,
            35 => 24,
            36 => 26,
            37 => 29,
            38 => 31,
            39 => 35,
            40 => 36,
            41 => 40,
            42 => 43,
            43 => 47,
            44 => 50,
            45 => 54,
            46 => 58,
            47 => 61,
            48 => 65,
            49 => 68,
            50 => 72,
            51 => 77,
            52 => 82,
            53 => 86,
            54 => 91,
            55 => 96,
            56 => 101,
            57 => 106,
            58 => 110,
            59 => 115,
            60 => 120
        ];
    }

    /**
     * Current Assets Attributes
     */

    public function getCurrentAssetsDefaultArrayAttribute()
    {
        return $this->content['current_assets_default'];
    }

    public function getTotalCurrentAssetsDefaultAttribute()
    {   
        $total = 0;

        foreach($this->current_assets_default_array as $asset) {
            $total += floatval($asset['value']);
        }

        return $total;
    }

    public function getCurrentAssetsAddonArrayAttribute()
    {
        return $this->content['current_assets_addon'];
    }

    public function getTotalCurrentAssetsAddonAttribute()
    {   
        $total = 0;

        foreach($this->current_assets_addon_array as $asset) {
            $total += floatval($asset['value']);
        }

        return $total;
    }

    /**
     * Total Current Assets Attribute
     */

    public function getTotalCurrentAssetsAttribute()
    {   
        return $this->total_current_assets_default + $this->total_current_assets_addon; 
    }

    public function getCashBankAttribute()
    {
        return array_search('cash_bank', array_column($this->current_assets_default_array, 'name'));
    }

    public function getTimeDepositsAttribute()
    {
        return array_search('time_deposits', array_column($this->current_assets_default_array, 'name'));
    }

    public function getMoneyMarketAttribute()
    {
        return array_search('money_market_accounts', array_column($this->current_assets_default_array, 'name'));
    }

    /**
     * Longterm Assets Attributes
     */

    public function getLongtermAssetsDefaultArrayAttribute()
    {
        return $this->content['longterm_assets_default'];
    }

    public function getTotalLongtermAssetsDefaultAttribute()
    {
        $total = 0;

        foreach($this->longterm_assets_default_array as $asset) {
            $total += floatval($asset['value']);
        }

        return $total;
    }

    public function getLongtermAssetsAddonArrayAttribute()
    {
        return $this->content['longterm_assets_addon'];
    }

    public function getTotalLongtermAssetsAddonAttribute()
    {
        $total = 0;

        foreach($this->longterm_assets_addon_array as $asset) {
            $total += floatval($asset['value']);
        }

        return $total;
    }

    /**
     * Total Longterm Assets Attribute
     */

    public function getTotalLongtermAssetsAttribute()
    {
        return $this->total_longterm_assets_default + $this->total_longterm_assets_addon;
    }

    public function getHouseLotAttribute()
    {
        return array_search('house_lot', array_column($this->longterm_assets_default_array, 'name'));
    }

    public function getHouseLotValueAttribute()
    {
        return floatval($this->house_lot['value']);
    }

    /**
     * Current Liabilities Attributes
     */

    public function getCurrentLiabilitiesDefaultArrayAttribute()
    {
        return $this->content['current_liabilities_default'];
    }

    public function getTotalCurrentLiabilitiesDefaultAttribute()
    {
        $total = 0;

        foreach($this->current_liabilities_default_array as $liability) {
            $total += floatval($liability['value']);
        }

        return $total;
    }

    public function getCurrentLiabilitiesAddonArrayAttribute()
    {
        return $this->content['current_liabilities_addon'];
    }

    public function getTotalCurrentLiabilitiesAddonAttribute()
    {
        $total = 0;

        foreach($this->current_liabilities_addon_array as $liability) {
            $total += floatval($liability['value']);
        }

        return $total;
    }

    /**
     * Total CUrrent Liabilities Attribute
     */

    public function getTotalCurrentLiabilitesAttribute()
    {
        return $this->current_liabilities_default + $this->current_liabilities_addon;
    }

    /**
     * Longterm Liabilities Attributes
     */

    public function getLongtermLiabilitiesDefaultArrayAttribute()
    {
        return $this->content['longterm_liabilities_default'];
    }

    public function getTotalLongtermLiabilitiesDefaultAttribute()
    {
        $total = 0;

        foreach($this->longterm_liabilities_default_array as $liability) {
            $total += floatval($liability['value']);
        }

        return $total;
    }

    public function getLongtermLiabilitiesAddonArrayAttribute()
    {
        return $this->content['longterm_liabilities_addon'];
    }

    public function getTotalLongtermLiabilitiesAddonAttribute()
    {
        $total = 0;

        foreach($this->longterm_liabilities_addon_array as $liability) {
            $total += floatval($liability['value']);
        }

        return $total;
    }

    /**
     * Total Longterm Liabilities Attribute
     */

    public function getTotalLongtermLiabilitesAttribute()
    {
        return $this->longterm_liabilities_default + $this->longterm_liabilities_addon;
    }

    /**
     * Total Assets
     */

    public function getTotalAssetsAttribute()
    {
        return $this->total_current_assets + $this->total_longterm_assets;
    }

    /**
     * Total Liabilities
     */

    public function getTotalLiabilitiesAttribute()
    {
        return $this->total_current_liabilities + $this->total_longterm_assets;
    }

    /**
     * Net Worth Multiplier Attributes
     */
    
    public function getNetWorthAttribute()
    {
        return $this->total_assets - $this->total_liabilities;
    }

    public function getNetWorthMultiplierAttribute()
    {
        $net_worth_estimate_multiplier_array = $this->net_worth_estimate_multiplier_array;
        $age = $this->participant->age;
     
        if($age <= 20) {
            return $net_worth_estimate_multiplier_array[21];
        }

        foreach($net_worth_estimate_multiplier_array as $key => $multiplier) {
            if($key === $age) {
                return $multiplier;
            }
        }
        
        // $age >= 61
        return $net_worth_estimate_multiplier_array[$net_worth_estimate_multiplier_array.length - 1];
    }

    public function getNetWorthMultiplierAgeAttribute()
    {
        $net_worth_estimate_multiplier_array = $this->net_worth_estimate_multiplier_array;
        $net_worth = $this->net_worth;
        $monthly_income = $this->participant->mimo->total_income;
     
        $net_worth_multiplier = $net_worth > 0 && $monthly_income > 0 ? 
            $net_worth / $this->participant->mimo->total_income : 0;

        if($net_worth_multiplier < 1) {
            return array_search(1, $net_worth_estimate_multiplier_array);
        }

        foreach($net_worth_estimate_multiplier_array as $key => $multiplier) {
            if($net_worth_multiplier <= $multiplier) {
                return array_search($multiplier);
            }
        }
        
        // $net_worth > 120
        return 60;   
    }

    /**
     * Ideal Net Worth Attribute
     * Computation: monthly income (total income) * net worth multiplier
     */
    public function getIdealNetWorthAttribute()
    {
        $ideal_net_worth = $this->participant->mimo->total_income * $this->net_worth_multiplier;
        return $ideal_net_worth > 0 ? $ideal_net_worth : 1;
    }

    public function getNetWorthAgeDifferenceAttribute()
    {
        $age = $this->participant->age >= 21 ? $this->participant->age : 21;
        return $age - $this->net_worth_multiplier_age;
    }

    /**
     * House Budget Attributes
     * Computation: Monthly Income * 3 years' income (12 months/year * 3 years = 36 months)
     */

    public function getIdealHouseLotBudgetAttribute()
    {
        return $this->participant->mimo->total_income * 36;
    }

    public function getActualHouseLotBudgetAttribute()
    {
        return $this->house_lot_value - $this->ideal_house_lot;
    }

    /**
     * Emergency Savings Attributes
     */

    public function getActualEmergencySavingsAttribute()
    {
        return floatval($this->cash_bank['value']) + floatval($this->time_deposits['value']) + floatval($this->money_market['value']);
    }

    public function getEmergencySavingsAdequancyAttribute()
    {
        return $this->actual_emergency_savings -  $this->participant->mimo->total_expenses;
    }

}
