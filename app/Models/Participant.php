<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $fillable = [
        'first_name', 'last_name', 'email', 'phone_num', 'city', 'birth_date', 'currency'
    ];

    protected $dates = [
        'birth_date',
        'created_at',
        'updated_at'
    ];

    public function mimo()
    {
        return $this->hasOne('App\Models\Mimo');
    }

    public function pbs()
    {
        return $this->hasOne('App\Models\BalanceSheet');
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getBirthDateFormattedAttribute()
    {
        return $this->birth_date->format('m/d/Y');
    }

    public function getAgeAttribute()
    {
        return $this->birth_date->age;
    }
    
}
