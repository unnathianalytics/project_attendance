<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    //
    protected $fillable = [
        'customer_id',
        'description',
        'amount',
        'date',
        'payment_method',
    ];
}
