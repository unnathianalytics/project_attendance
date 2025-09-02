<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'user_id',
        'site_id',
        'attendance_unit',
        'salary_per_unit',
        'payable',
        'note',
    ];

    public function labor(): BelongsTo
    {
        return $this->belongsTo(Labor::class, 'user_id');
    }
    public function site(): BelongsTo
    {
        return $this->belongsTo(Site::class, 'site_id');
    }
}
