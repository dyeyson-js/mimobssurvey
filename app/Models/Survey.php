<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $dates = [
        'created_at',
        'updated_at'
    ];   

    public function participant() {
        return $this->belongsTo('App\Models\Participant');
    }
}
