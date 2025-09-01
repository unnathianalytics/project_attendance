<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class AccountingType extends Model
{
    use HasFactory, LogsActivity;
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logAll();
    }
    protected static $recordEvents = ['created', 'updated', 'deleted'];
    protected $fillable = [
        'name',
        'slug',
        'bg_color',
        'acc_value',
        'order',
    ];

    public function accountingVouchers(): HasMany
    {
        return $this->hasMany(AccountingVoucher::class);
    }
    public function getRouteKeyName(): string
    {
        return 'slug'; // or 'code' if you're using a different column
    }
}
