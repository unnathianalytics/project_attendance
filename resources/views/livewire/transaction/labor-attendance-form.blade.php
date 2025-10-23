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
        //from https://grok.com/share/c2hhcmQtMg%3D%3D_83fe4af6-faad-4f4b-8314-e0997d6df4b0
        (function() {
            // Encapsulate in IIFE to avoid globals
            let watchId = null;
            let lastUpdateTime = 0;
            const THROTTLE_MS = 10000; // 10s throttle for updates
            const MIN_DISTANCE_METERS = 10; // Optional: Skip if <10m movement (requires Haversine calc)
            let lastLat = null;
            let lastLng = null;

            // Custom event dispatcher for errors (Livewire-friendly)
            function dispatchError(code, message) {
                Livewire.emit('geolocationError', {
                    code,
                    message
                });
                console.error('Geolocation error:', {
                    code,
                    message
                });
            }

            // Optional: Simple distance calculator (Haversine formula)
            function calculateDistance(lat1, lng1, lat2, lng2) {
                if (!lat1 || !lng1 || !lat2 || !lng2) return Infinity;
                const R = 6371e3; // Earth's radius in meters
                const φ1 = lat1 * Math.PI / 180;
                const φ2 = lat2 * Math.PI / 180;
                const Δφ = (lat2 - lat1) * Math.PI / 180;
                const Δλ = (lng2 - lng1) * Math.PI / 180;
                const a = Math.sin(Δφ / 2) * Math.sin(Δφ / 2) +
                    Math.cos(φ1) * Math.cos(φ2) *
                    Math.sin(Δλ / 2) * Math.sin(Δλ / 2);
                const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
                return R * c;
            }

            function handleGeolocationError(error) {
                let message = 'Location error: ';
                switch (error.code) {
                    case error.PERMISSION_DENIED:
                        message += 'Location access denied. Please enable location services and reload the page.';
                        break;
                    case error.POSITION_UNAVAILABLE:
                        message += 'Location information unavailable. Please check your GPS settings.';
                        break;
                    case error.TIMEOUT:
                        message += 'Location request timed out. Please try refreshing your location.';
                        break;
                    default:
                        message += 'An unknown error occurred.';
                        break;
                }
                dispatchError(error.code, message);
            }

            function shouldUpdatePosition(currentTime, lat, lng) {
                const timeElapsed = currentTime - lastUpdateTime;
                if (timeElapsed < THROTTLE_MS) return false;
                if (lastLat !== null && lastLng !== null) {
                    const distance = calculateDistance(lastLat, lastLng, lat, lng);
                    if (distance < MIN_DISTANCE_METERS) return false; // Skip minor movements
                }
                return true;
            }

            function updateLivewireLocation(lat, lng) {
                if (shouldUpdatePosition(Date.now(), lat, lng)) {
                    @this.updateLocation(lat, lng);
                    lastUpdateTime = Date.now();
                    lastLat = lat;
                    lastLng = lng;
                }
            }

            async function checkPermissions() {
                if ('permissions' in navigator) {
                    try {
                        const permission = await navigator.permissions.query({
                            name: 'geolocation'
                        });
                        if (permission.state === 'denied') {
                            dispatchError('PERMISSION_DENIED',
                                'Location access permanently denied. Please enable in browser settings.');
                            return false;
                        }
                    } catch (err) {
                        console.warn('Permission query failed (fallback to direct request):', err);
                    }
                }
                return true;
            }

            function initializeGeolocation() {
                if (!navigator.geolocation) {
                    dispatchError('UNSUPPORTED', 'Geolocation is not supported by this browser.');
                    return;
                }

                // Proactive permission check
                checkPermissions().then(hasPermission => {
                    if (!hasPermission) return;

                    // Get current position (align maximumAge with watch for consistency)
                    navigator.geolocation.getCurrentPosition(
                        (position) => updateLivewireLocation(position.coords.latitude, position.coords
                            .longitude),
                        handleGeolocationError, {
                            enableHighAccuracy: true,
                            timeout: 15000,
                            maximumAge: 60000
                        } // Consistent with watch
                    );

                    // Watch with throttled updates
                    watchId = navigator.geolocation.watchPosition(
                        (position) => updateLivewireLocation(position.coords.latitude, position.coords
                            .longitude),
                        handleGeolocationError, {
                            enableHighAccuracy: true,
                            timeout: 15000,
                            maximumAge: 60000
                        }
                    );
                });
            }

            // Event listeners
            document.addEventListener('livewire:initialized', initializeGeolocation);
            Livewire.on('refreshGeolocation', () => {
                if (watchId) {
                    navigator.geolocation.clearWatch(watchId);
                    watchId = null;
                }
                // Reset state for fresh start
                lastUpdateTime = 0;
                lastLat = null;
                lastLng = null;
                initializeGeolocation();
            });

            // Cleanup
            window.addEventListener('beforeunload', () => {
                if (watchId) {
                    navigator.geolocation.clearWatch(watchId);
                }
            });
        })();
    </script>
@endpush
