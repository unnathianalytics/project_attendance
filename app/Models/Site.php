<?php

namespace App\Models;

use App\Services\GeoService;
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

    //Grok recommends this
    public static function getSitesWithinDistance($userLat, $userLon, $distance = 100)
    {
        $sites = self::all(); // Fetch all sites
        $nearbySites = [];

        foreach ($sites as $site) {
            $distanceToSite = GeoService::calculateDistance($userLat, $userLon, $site->latitude, $site->longitude);
            if ($distanceToSite <= $distance) {
                $nearbySites[] = [
                    'site' => $site,
                    'distance' => round($distanceToSite, 2),
                ];
            }
        }

        // Sort by distance
        usort($nearbySites, fn($a, $b) => $a['distance'] <=> $b['distance']);

        return $nearbySites;
    }
    // public static function getSitesWithinDistance($userLat, $userLon, $distance = 100)
    // {
    //     $sites = self::all();
    //     $nearbySites = [];
    //     foreach ($sites as $site) {
    //         $distanceToSite = GeoService::calculateDistance($userLat, $userLon, $site->latitude, $site->longitude);
    //         if ($distanceToSite <= $distance) {
    //             $nearbySites[] = [
    //                 'site' => $site,
    //                 'distance' => round($distanceToSite, 2),
    //             ];
    //         }
    //     }
    //     return $nearbySites;
    // }

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
