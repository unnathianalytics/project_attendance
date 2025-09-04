<div>
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0 d-none">Attendance List</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a wire:navigate href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Attendance List
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9">
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <div class="card-title">Attendance List</div>
                            <div class="card-tools">
                                <a wire:navigate class="btn btn-sm btn-secondary btn-flat float-end"
                                    href="{{ route('attendance.create') }}">New
                                    Attendance</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="input-daterange input-group" id="datepicker">
                                        <input type="text" wire:model.live="from_date" class="input-sm form-control"
                                            name="start" />
                                        <span class="input-group-addon">to</span>
                                        <input type="text" wire:model.live="to_date" class="input-sm form-control"
                                            name="end" />
                                    </div>
                                    @error('to_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Labor</th>
                                            <th>Site</th>
                                            <th>Day/s</th>
                                            <th>Payable</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($this->attendances as $attendance)
                                            <tr wire:key="attendance-{{ $attendance->id }}">
                                                <td>{{ \Carbon\Carbon::parse($attendance->date)->format('d M Y') }}
                                                </td>
                                                <td>{{ $attendance->labor->name }}</td>
                                                <td>{{ $attendance->site->name }}</td>
                                                <td class="text-end">{{ $attendance->attendance_unit }}
                                                    <small>{{ $attendance->cr_dr }}</small>
                                                </td>
                                                <td class="text-end">{{ rupees($attendance->payable) }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('attendance.edit', $attendance) }}"
                                                        class="btn btn-sm btn-warning btn-flat">Edit</a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center text-muted">No attendance records
                                                    found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                {{ $this->attendances->links() }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <link rel="stylesheet" href="{{ asset('dist/css/bootstrap-datepicker.standalone.min.css') }}">
    <script src="{{ asset('dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script>
        // Try multiple event listeners for better compatibility
        document.addEventListener('DOMContentLoaded', function() {
            initializeDatepicker();
        });

        document.addEventListener('livewire:load', function() {
            initializeDatepicker();
        });

        // Re-initialize after Livewire updates
        Livewire.hook('message.processed', (message, component) => {
            initializeDatepicker();
        });

        function initializeDatepicker() {
            // Destroy existing datepicker instances to avoid conflicts
            $('.input-daterange').datepicker('destroy');

            $('.input-daterange').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
            }).on('changeDate', function(e) {
                let from_date = $('.input-daterange').find('input[name="start"]').val();
                let to_date = $('.input-daterange').find('input[name="end"]').val();

                @this.set('from_date', from_date);
                @this.set('to_date', to_date);
            });
        }
    </script>
@endpush
