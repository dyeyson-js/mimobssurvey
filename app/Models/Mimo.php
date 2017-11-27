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
}
