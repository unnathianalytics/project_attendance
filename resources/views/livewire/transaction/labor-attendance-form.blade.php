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
</div>
@push('scripts')
    <script>
        document.addEventListener('livewire:initialized', () => {
            if (navigator.geolocation) {
                navigator.geolocation.watchPosition(
                    (position) => {
                        @this.updateLocation(position.coords.latitude, position.coords.longitude);
                    },
                    (error) => {
                        console.error('Geolocation error:', error);
                        alert('Please enable location services to mark attendance.');
                    }, {
                        enableHighAccuracy: true, // Requests GPS for higher accuracy
                        timeout: 10000, // Wait up to 10 seconds for a response
                        maximumAge: 0 // Do not use cached location data
                    }
                );
            } else {
                alert('Geolocation is not supported by this browser.');
            }
        });
    </script>
@endpush
