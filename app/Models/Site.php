<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Site extends Model
{
    use HasFactory;
    protected $fillable = [
        'account_id',
        'name',
        'address',
        'longitude',
        'latitude',
        'status',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'account_id');
    }

    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class);
    }

    public function siteStatus(): string
    {
        return match ($this->status) {
            'in_progress' => 'In Progress',
            'pending_payment' => 'Pending Payment',
            'completed' => 'Completed',
            default => 'Unknown',
        };
    }
}
