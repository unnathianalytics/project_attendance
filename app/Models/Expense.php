<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_id',
        'description',
        'amount',
        'date',
        'payment_method',
    ];

    public function site(): BelongsTo
    {
        return $this->belongsTo(Site::class);
    }
}