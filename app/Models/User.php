<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{

    use HasFactory, Notifiable, LogsActivity, HasRoles;
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logAll();
    }
    protected $guard_name = ['web'];

    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile',
        'op_balance',
        'cr_dr',
        'basic_salary',
        'image',
        'company_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
