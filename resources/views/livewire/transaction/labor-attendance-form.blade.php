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

                                <div>
                                    <label>Select Site:</label>
                                    <select wire:model="selectedSiteId" class="form-control">
                                        <option value="">Select a site</option>
                                        @foreach ($nearbySites as $site)
                                            <option value="{{ $site['site']->id }}">
                                                {{ $site['site']->name }} ({{ $site['distance'] }} meters)
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <button wire:click="submitAttendance" @if (!$isWithinRange) disabled @endif
                                    class="btn btn-primary mt-3">
                                    Submit Attendance
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
    <div x-data>
        @this.on('low-accuracy-warning', (event) => {
        alert(`Location accuracy is too low (${event.accuracy.toFixed(2)} meters). Please move to an open area for
        better GPS signal.`);
        });
    </div>
</div>
@push('scripts')
    <script>
        document.addEventListener('livewire:initialized', () => {
            if (navigator.geolocation) {
                navigator.geolocation.watchPosition(
                    (position) => {
                        if (position.coords.accuracy <= 20) {
                            @this.updateLocation(position.coords.latitude, position.coords.longitude);
                        } else {
                            @this.dispatch('low-accuracy-warning', {
                                accuracy: position.coords.accuracy
                            });
                        }
                    },
                    (error) => {
                        console.error('Geolocation error:', error);
                        let message = 'Please enable location services to mark attendance.';
                        if (error.code === 1) {
                            message =
                                'Location access denied. Please allow location permissions in your browser settings.';
                        } else if (error.code === 2) {
                            message =
                                'Location unavailable. Ensure GPS is enabled and try again in an open area.';
                        } else if (error.code === 3) {
                            message = 'Location request timed out. Please try again.';
                        }
                        alert(message);
                    }, {
                        enableHighAccuracy: true,
                        timeout: 10000,
                        maximumAge: 0
                    }
                );
            } else {
                alert(
                    'Geolocation is not supported by this browser. Please use a modern browser on a GPS-enabled device.'
                    );
            }
        });
    </script>
@endpush
