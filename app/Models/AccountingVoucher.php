<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class AccountingVoucher extends Model
{
    use HasFactory, LogsActivity;
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logAll();
    }
    protected static $recordEvents = ['created', 'updated', 'deleted'];

    protected $fillable = [
        'voucher_series_id',
        'transaction_date',
        'transaction_time',
        'voucher_number',
        'accounting_type_id',
        'voucher_notes',
        'user',
    ];

    public function accountingType(): BelongsTo
    {
        return $this->belongsTo(AccountingType::class);
    }

    public function debit_items_amount()
    {
        // return $this->accountingVoucherItems()->where('cr_dr', 'dr')->sum('amount');
    }

    public function credit_items_amount()
    {
        // return $this->accountingVoucherItems()->where('cr_dr', 'cr')->sum('amount');
    }
}
