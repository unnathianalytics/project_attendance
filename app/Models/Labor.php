<?php

namespace App\Models;

use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class Labor extends User
{
    protected $table = 'users'; // Use the same table as User

    protected static function booted()
    {
        parent::booted();

        // Apply global scope to only show users with 'employee' role
        static::addGlobalScope('employee_only', function (Builder $builder) {
            $builder->whereHas('roles', function ($query) {
                $query->where('name', 'employee')->where('guard_name', 'web');
            });
        });

        // Automatically assign 'employee' role when creating
        static::creating(function ($labor) {
            if (Role::where('name', 'employee')->where('guard_name', '')->exists()) {
                $labor->assignRole('employee', ''); // Assign the 'employee' role with empty guard
            } else {
                Log::warning('Employee role with empty guard not found during Labor creation.');
            }
        });
    }

    // Fetch all labors (users with 'employee' role and empty guard)
    public static function labors()
    {
        return self::get(); // Now this will automatically filter by the global scope
    }

    // Alternative method without global scope (if you prefer not to use global scope)
    public static function laborsByRole()
    {
        return self::whereHas('roles', function ($query) {
            $query->where('name', 'employee')->where('guard_name', 'web');
        })->get();
    }

    // If you need to bypass the global scope sometimes
    public static function allLaborsIncludingWithoutRole()
    {
        return self::withoutGlobalScope('employee_only')->get();
    }
}
