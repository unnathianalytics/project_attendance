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
                                <div class="col-md-3">
                                    <label for="from_date" class="form-label">From Date</label>
                                    <input type="date" wire:model.live="from_date" id="from_date"
                                        class="form-control form-control-sm @error('from_date') is-invalid @enderror"
                                        max="{{ $to_date }}" />
                                    @error('from_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="to_date" class="form-label">To Date</label>
                                    <input type="date" wire:model.live="to_date" id="to_date"
                                        class="form-control form-control-sm @error('to_date') is-invalid @enderror"
                                        min="{{ $from_date }}" max="{{ now()->format('Y-m-d') }}" />
                                    @error('to_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    @if (session()->has('warning'))
                                        <div class="alert alert-warning alert-dismissible fade show mt-4"
                                            role="alert">
                                            {{ session('warning') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                        </div>
                                    @endif
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
                                                <td>{{ \Carbon\Carbon::parse($attendance->date)->format('d M Y') }}</td>
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
