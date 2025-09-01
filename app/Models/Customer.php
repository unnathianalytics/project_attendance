<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Account
{
    protected $table = 'accounts'; // Use the same table as Account

    protected static function booted()
    {
        parent::booted();

        // Automatically set group_id to 16 when creating
        static::creating(function ($customer) {
            $customer->group_id = 16;
        });

        // Global scope to only fetch customers (group_id = 16)
        static::addGlobalScope('customer', function ($builder) {
            $builder->where('group_id', 16);
        });
    }

    // Override the customers method to be more efficient
    public static function customers()
    {
        return self::all(); // Since we already have the global scope
    }
    public function sites(): HasMany
    {
        return $this->hasMany(Site::class, 'account_id');
    }
}
