<?php

namespace App\Livewire\Transaction;

use App\Models\Site;
use Livewire\Component;
use App\Models\Attendance;
use App\Services\GeoService;

class LaborAttendanceForm extends Component
{
    public $userLat;
    public $userLon;
    public $selectedSiteId;
    public $nearbySites = [];
    public $isWithinRange = false;
    public $proximityThreshold = 30; // Max distance in meters for attendance
    public $locationFetched = false; // Track if location has been fetched
    public $selectedSiteDistance = null; // Store distance to selected site

    public function mount()
    {
        // Initialize with empty values; geolocation will be fetched via JavaScript
        $this->userLat = null;
        $this->userLon = null;
        $this->locationFetched = false;
    }

    public function updateLocation($lat, $lon)
    {
        // Only update if location has significantly changed (to reduce constant refreshing)
        if ($this->userLat && $this->userLon) {
            $distanceFromLastLocation = GeoService::calculateDistance(
                $this->userLat,
                $this->userLon,
                $lat,
                $lon
            );

            // Only update if moved more than 5 meters
            if ($distanceFromLastLocation < 5) {
                return;
            }
        }

        $this->userLat = $lat;
        $this->userLon = $lon;
        $this->locationFetched = true;

        // Fetch nearby sites within a reasonable range (100-1000 meters for selection)
        $this->nearbySites = Site::getSitesWithinDistance($lat, $lon, 1000);

        // Recheck proximity for selected site
        $this->checkProximity();
    }

    public function updatedSelectedSiteId($value)
    {
        $this->selectedSiteId = $value;
        $this->checkProximity();
    }

    public function checkProximity()
    {
        if (!$this->selectedSiteId || !$this->userLat || !$this->userLon) {
            $this->isWithinRange = false;
            $this->selectedSiteDistance = null;
            return;
        }

        $site = Site::find($this->selectedSiteId);
        if ($site) {
            $distance = GeoService::calculateDistance(
                $this->userLat,
                $this->userLon,
                $site->latitude,
                $site->longitude
            );

            $this->selectedSiteDistance = round($distance, 2);
            $this->isWithinRange = $distance <= $this->proximityThreshold;
        } else {
            $this->isWithinRange = false;
            $this->selectedSiteDistance = null;
        }
    }

    public function refreshLocation()
    {
        // Method to manually refresh location if needed
        $this->dispatch('refreshGeolocation');
    }

    public function submitAttendance()
    {
        // Validate that location is available
        if (!$this->locationFetched || !$this->userLat || !$this->userLon) {
            session()->flash('error', 'Location not available. Please ensure location services are enabled.');
            return;
        }

        // Validate site selection
        if (!$this->selectedSiteId) {
            session()->flash('error', 'Please select a site.');
            return;
        }

        // Final proximity check
        $this->checkProximity();

        if ($this->isWithinRange) {
            // Logic to save attendance
            // Example:
            // Attendance::create([
            //     'site_id' => $this->selectedSiteId,
            //     'user_id' => auth()->id(),
            //     'latitude' => $this->userLat,
            //     'longitude' => $this->userLon,
            //     'distance_from_site' => $this->selectedSiteDistance,
            //     'check_in_time' => now(),
            // ]);

            session()->flash('message', 'Attendance submitted successfully!');

            // Optionally reset form
            // $this->reset(['selectedSiteId', 'isWithinRange']);
        } else {
            session()->flash('error', "You are not within the required proximity ({$this->proximityThreshold}m) to the selected site. Current distance: {$this->selectedSiteDistance}m");
        }
    }

    public function render()
    {
        return view('livewire.transaction.labor-attendance-form');
    }
}
