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
    public $proximityThreshold = 20; // Max distance in meters for attendance

    public function mount()
    {
        // Initialize with empty values; geolocation will be fetched via JavaScript
        $this->userLat = null;
        $this->userLon = null;
    }

    public function updateLocation($lat, $lon)
    {
        $this->userLat = $lat;
        $this->userLon = $lon;

        // Fetch nearby sites (within 100 meters)
        $this->nearbySites = Site::getSitesWithinDistance($lat, $lon, 500);

        // Check if selected site is within 10-20 meters
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
            $this->isWithinRange = $distance <= $this->proximityThreshold;
        } else {
            $this->isWithinRange = false;
        }
    }

    public function submitAttendance()
    {
        if ($this->isWithinRange) {
            // Logic to save attendance
            // Example: Attendance::create([...]);
            session()->flash('message', 'Attendance submitted successfully!');
        } else {
            session()->flash('error', 'You are not within the required proximity to the selected site.');
        }
    }
}
