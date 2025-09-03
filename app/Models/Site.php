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
    // Add this optimized method to your Site.php model
    public static function getSitesWithinDistance($userLat, $userLon, $distance = 100)
    {
        // Calculate rough bounding box to reduce database load
        $latRange = $distance / 111000; // Roughly 111km per degree latitude
        $lonRange = $distance / (111000 * cos(deg2rad($userLat))); // Longitude varies by latitude

        $sites = self::whereBetween('latitude', [$userLat - $latRange, $userLat + $latRange])
            ->whereBetween('longitude', [$userLon - $lonRange, $userLon + $lonRange])
            ->get();

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
