<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Company extends Model
{
    //
    use HasFactory, LogsActivity;
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logAll();
    }
    protected static $recordEvents = ['created', 'updated', 'deleted'];
    protected $fillable = [
        'name',
        'address',
        'city',
        'state_id',
        'country',
        'pincode',
        'phone',
        'email',
        'website',
        'gstin',
        'pan',
        'cin',
        'logo',
        'currency',
        'currency_symbol',
    ];
    protected $casts = [
        'status' => 'boolean',
    ];
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
