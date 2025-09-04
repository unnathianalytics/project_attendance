<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    protected $fillable = [
        'user_id',
        'description',
        'amount',
        'date',
        'settlement_via',
    ];

    public function labor()
    {
        return $this->belongsTo(Labor::class, 'user_id');
    }
}
