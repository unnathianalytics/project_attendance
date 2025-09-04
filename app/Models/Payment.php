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
        'payment_method',
    ];

    public function labor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
