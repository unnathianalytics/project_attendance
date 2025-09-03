<div>
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0 d-none">Attendance Form</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a wire:navigate href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Attendance Form
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-10">
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <div class="card-title">Attendance Form</div>
                            <div class="card-tools">
                                <a wire:navigate class="btn btn-sm btn-secondary btn-flat float-end"
                                    href="{{ route('attendance.index') }}">Cancel</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div>
                                <h2>Mark Attendance</h2>

                                @if (session()->has('message'))
                                    <div class="alert alert-success">
                                        {{ session('message') }}
                                    </div>
                                @endif

                                @if (session()->has('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                <!-- Location Status -->
                                <div class="mb-3">
                                    @if ($locationFetched)
                                        <div class="alert alert-success">
                                            <i class="fas fa-map-marker-alt"></i> Location detected
                                            <button wire:click="refreshLocation"
                                                class="btn btn-sm btn-outline-primary float-end">
                                                Refresh Location
                                            </button>
                                        </div>
                                    @else
                                        <div class="alert alert-warning">
                                            <i class="fas fa-spinner fa-spin"></i> Detecting location...
                                            <button wire:click="refreshLocation"
                                                class="btn btn-sm btn-outline-primary float-end">
                                                Refresh Location
                                            </button>
                                        </div>
                                    @endif
                                </div>

                                <!-- Site Selection -->
                                <div class="mb-3">
                                    <label class="form-label">Select Site:</label>
                                    <select wire:model.live="selectedSiteId" class="form-control"
                                        @if (!$locationFetched) disabled @endif>
                                        <option value="">Select a site</option>
                                        @foreach ($nearbySites as $siteData)
                                            <option value="{{ $siteData['site']->id }}">
                                                {{ $siteData['site']->name }} ({{ $siteData['distance'] }} meters away)
                                            </option>
                                        @endforeach
                                    </select>
                                    @if (!$locationFetched)
                                        <small class="text-muted">Waiting for location to load sites...</small>
                                    @elseif(empty($nearbySites))
                                        <small class="text-warning">No sites found within 1000 meters of your
                                            location.</small>
                                    @endif
                                </div>

                                <!-- Proximity Status -->
                                @if ($selectedSiteId && $selectedSiteDistance !== null)
                                    <div class="mb-3">
                                        @if ($isWithinRange)
                                            <div class="alert alert-success">
                                                <i class="fas fa-check-circle"></i>
                                                You are within range! Distance: {{ $selectedSiteDistance }}m
                                            </div>
                                        @else
                                            <div class="alert alert-danger">
                                                <i class="fas fa-exclamation-triangle"></i>
                                                You are too far from the site. Distance: {{ $selectedSiteDistance }}m
                                                (Required: ≤{{ $proximityThreshold }}m)
                                            </div>
                                        @endif
                                    </div>
                                @endif

                                <!-- Submit Button -->
                                <button wire:click="submitAttendance" @if (!$isWithinRange || !$locationFetched || !$selectedSiteId) disabled @endif
                                    class="btn btn-primary mt-3">
                                    @if (!$locationFetched)
                                        <i class="fas fa-spinner fa-spin"></i> Waiting for Location...
                                    @elseif(!$selectedSiteId)
                                        Select a Site
                                    @elseif(!$isWithinRange)
                                        <i class="fas fa-ban"></i> Out of Range
                                    @else
                                        <i class="fas fa-check"></i> Submit Attendance
                                    @endif
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        let watchId = null;
        let locationUpdateCount = 0;

        document.addEventListener('livewire:initialized', () => {
            initializeGeolocation();
        });

        // Listen for manual refresh requests
        Livewire.on('refreshGeolocation', () => {
            if (watchId) {
                navigator.geolocation.clearWatch(watchId);
            }
            initializeGeolocation();
        });

        function initializeGeolocation() {
            if (!navigator.geolocation) {
                alert('Geolocation is not supported by this browser.');
                return;
            }

            // First, get current position immediately
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    @this.updateLocation(position.coords.latitude, position.coords.longitude);
                },
                (error) => {
                    console.error('Geolocation error:', error);
                    handleGeolocationError(error);
                }, {
                    enableHighAccuracy: true,
                    timeout: 15000,
                    maximumAge: 0
                }
            );

            // Then set up watch position with throttling
            watchId = navigator.geolocation.watchPosition(
                (position) => {
                    // Throttle updates - only update every 10 seconds or significant movement
                    locationUpdateCount++;
                    if (locationUpdateCount % 5 === 0) { // Update every 5th callback
                        @this.updateLocation(position.coords.latitude, position.coords.longitude);
                    }
                },
                (error) => {
                    console.error('Geolocation watch error:', error);
                    handleGeolocationError(error);
                }, {
                    enableHighAccuracy: true,
                    timeout: 15000,
                    maximumAge: 60000 // Accept cached location up to 1 minute old
                }
            );
        }

        function handleGeolocationError(error) {
            let errorMessage = 'Location error: ';
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    errorMessage += 'Location access denied. Please enable location services and reload the page.';
                    break;
                case error.POSITION_UNAVAILABLE:
                    errorMessage += 'Location information unavailable. Please check your GPS settings.';
                    break;
                case error.TIMEOUT:
                    errorMessage += 'Location request timed out. Please try refreshing your location.';
                    break;
                default:
                    errorMessage += 'An unknown error occurred.';
                    break;
            }
            alert(errorMessage);
        }

        // Clean up on page unload
        window.addEventListener('beforeunload', () => {
            if (watchId) {
                navigator.geolocation.clearWatch(watchId);
            }
        });
    </script>
@endpush
