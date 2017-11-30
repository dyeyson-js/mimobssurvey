<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mimo extends Model
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

    public function getLifeStageAgeArrayAttribute()
    {
        return [
            21 => 0,
            22 => 1,
            23 => 3,
            24 => 6,
            25 => 10,
            26 => 12,
            27 => 14,
            28 => 16,
            29 => 18,
            30 => 20,
            31 => 22,
            32 => 24,
            33 => 26,
            34 => 28,
            35 => 30,
            36 => 32,
            37 => 34,
            38 => 36,
            39 => 38,
            40 => 40,
            41 => 42,
            42 => 44,
            43 => 46,
            44 => 48,
            45 => 50,
            46 => 52.5,
            47 => 55,
            48 => 57.5,
            49 => 60,
            50 => 62.5,
            51 => 65,
            52 => 67.5,
            53 => 70,
            54 => 72.5,
            55 => 75,
            56 => 77.5,
            57 => 80,
            58 => 82.5,
            59 => 85,
            60 => 87.5,
            61 => 90,
            62 => 92.5,
            63 => 95,
            64 => 97.5,
            65 => 100
        ];
    }

    /**
     * Active Income Attributes
     */

    public function getActiveIncomeDefaultArrayAttribute()
    {
        return $this->content['active_income_default'];
    }

    public function getTotalActiveIncomeDefaultAttribute()
    {
        $total = 0;

        foreach($this->active_income_default_array as $income) {
            $total += floatval($income['value']);
        }

        return $total;
    }

    public function getActiveIncomeAddonArrayAttribute()
    {
        return $this->content['active_income_addon'];
    }

    public function getTotalActiveIncomeAddonAttribute()
    {
        $total = 0;

        foreach($this->active_income_addon_array as $income) {
            $total += floatval($income['value']);
        }

        return $total;
    }

    /**
     * Total Active Income Attribute
     */

    public function getTotalActiveIncomeAttribute()
    {
        return $this->total_active_income_default + $this->total_active_income_addon;
    }

    /**
     * Passive Income Attributes
     */

    public function getPassiveIncomeDefaultArrayAttribute()
    {
        return $this->content['passive_income_default'];
    }

    public function getTotalPassiveIncomeDefaultAttribute()
    {
        $total = 0;

        foreach($this->passive_income_default_array as $income) {
            $total += floatval($income['value']);
        }

        return $total;
    }

    public function getPassiveIncomeAddonArrayAttribute()
    {
        return $this->content['passive_income_addon'];
    }

    public function getTotalPassiveIncomeAddonAttribute()
    {
        $total = 0;

        foreach($this->passive_income_addon_array as $income) {
            $total += floatval($income['value']);
        }

        return $total;
    }

    /**
     * Total Passive Income Attribute
     */

    public function getTotalPassiveIncomeAttribute()
    {
        return $this->total_passive_income_default + $this->total_passive_income_addon;
    }

    /**
     * Total Income Attribute
     */

    public function getTotalIncomeAttribute()
    {
        return $this->total_active_income + $this->total_passive_income;
    }

    /**
     * Regular Expenses Attributes
     */

    public function getRegularExpensesDefaultArrayAttribute()
    {
        return $this->content['regular_expenses_default'];
    }

    public function getTotalRegularExpensesDefaultAttribute()
    {   
        $total = 0;

        foreach($this->regular_expenses_default_array as $expense) {
            $total += floatval($expense['value']);
        }

        return $total;
    }

    public function getRegularExpensesAddonArrayAttribute()
    {
        return $this->content['regular_expenses_addon'];
    }

    public function getTotalRegularExpensesAddonAttribute()
    {
        $total = 0;

        foreach($this->regular_expenses_addon_array as $expense) {
            $total += floatval($expense['value']);
        }

        return $total;
    }

    /**
     * Total Regular Expenses Attribute
     */

    public function getTotalRegularExpensesAttribute()
    {
        return $this->total_regular_expenses_default + $this->total_regular_expenses_addon;
    }

    /**
     * Occassional Expenses Attributes
     */

    public function getOccassionalExpensesAddonArrayAttribute()
    {
        return $this->content['occassional_expenses_addon'];
    }

    public function getTotalOccassionalExpensesAttribute()
    {
        $total = 0;

        foreach($this->occassional_expenses_addon_array as $expense) {
            $total_value = $expense['frequency']['operation'] === "*" ? 
                floatval($expense['value']) * floatval($expense['frequency']['base']) :
                floatval($expense['value']) === 0 ?
                    floatval($expense['value']) / floatval($expense['frequency']['base']) : 0; 
        }

        return $total;
    }

    /**
     * Total Expenses Attribute 
     */

    public function getTotalExpensesAttribute()
    {
        return $this->total_regular_expenses + $this->total_occassional_expenses;
    }

    /**
     * Life Stage Percentage Attribute
     */

    public function getLifeStagePercentageAttribute()
    {
        return $this->total_passive_income > 0 && $this->total_expenses > 0 ?
            $this->total_passive_income / $this->total_expenses : 0;
    }

    /**
     * Life Stage Attribute
     */
    public function getLifeStageAttribute()
    {
        $percentage = $this->life_stage_percentage;

        if($percentage <= 0)
            return 'Start Up Stage';
        else if($percentage >= 1 && $percentage < 10)
            return 'Independence Stage';
        else if($percentage >= 11 && $percentage < 50)
            return 'Growth Stage';
        else if($percentage >= 51 && $percentage < 99)
            return 'Stabilization State';
        else
            return 'Freedom Stage';
    }

    public function getActualLifeStageAgeAttribute()
    {
        $percentage = $this->life_stage_percentage;
        
        foreach($this->life_stage_age_array as $key => $value) {
            if($percentage <= $value)
                return $key;
        }

        return 65;
    }

    public function getLifeStageAgeDifferenceAttribute()
    {
        $age = $this->participant->age >= 21 ? $this->participant->age : 21;
        return $this->actual_life_stage_age - $age; 
    }
}
