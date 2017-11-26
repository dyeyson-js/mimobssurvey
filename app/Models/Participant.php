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
}
