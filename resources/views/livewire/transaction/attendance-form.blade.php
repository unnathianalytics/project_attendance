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
                            <form wire:submit.prevent="save">
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <input type="date" class="form-control form-control-sm" wire:model="date">
                                        @error('date')
                                            <div id="" role="alert" class="invalid-feedback">{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <select class="form-control form-control-sm" wire:model="site_id">
                                            <option value="">Select Site</option>
                                            @foreach (\App\Models\Site::all() as $site)
                                                <option value="{{ $site->id }}">{{ $site->name }}
                                                    ({{ $site->customer->name }})
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('site_id')
                                            <div id="" role="alert" class="invalid-feedback">{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-12">
                                        <table class="table table-sm-table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Labor</th>
                                                    <th>Days</th>
                                                    <th>Salary</th>
                                                    <th>Payable</th>
                                                    <th>Note</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($attendances as $index => $att)
                                                    <tr>
                                                        <td>
                                                            <select class="form-control form-control-sm"
                                                                wire:model.live="attendances.{{ $index }}.user_id"
                                                                wire:change="updateUserId({{ $index }})">
                                                                <option value="">Select Labor</option>
                                                                @foreach (\App\Models\Labor::all() as $labor)
                                                                    <option value="{{ $labor->id }}">
                                                                        {{ $labor->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error("attendances.$index.user_id")
                                                                <div id="" role="alert" class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </td>
                                                        <td>
                                                            <input type="number" class="form-control form-control-sm"
                                                                wire:model.live="attendances.{{ $index }}.salary_per_unit"
                                                                placeholder="Basic Salary">
                                                            @error("attendances.$index.salary_per_unit")
                                                                <div id="" role="alert" class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </td>
                                                        <td>
                                                            <select class="form-control form-control-sm"
                                                                wire:model.live="attendances.{{ $index }}.attendance_unit">
                                                                <option value="">Select Days</option>
                                                                <option value="0.5">Half Day</option>
                                                                <option value="1">Full Day</option>
                                                                <option value="1.5">One and Half Day</option>
                                                                <option value="2">Two Days</option>
                                                                <option value="2.5">Two and Half Days</option>
                                                                <option value="3">Three Days</option>
                                                            </select>
                                                            @error("attendances.$index.attendance_unit")
                                                                <div id="" role="alert" class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </td>
                                                        <td>
                                                            <input type="number" class="form-control form-control-sm"
                                                                wire:model="attendances.{{ $index }}.payable"
                                                                placeholder="Payable">
                                                            @error("attendances.$index.payable")
                                                                <div id="" role="alert" class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control form-control-sm"
                                                                wire:model="attendances.{{ $index }}.note"
                                                                placeholder="Note">
                                                            @error("attendances.$index.note")
                                                                <div id="" role="alert" class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-danger btn-sm"
                                                                wire:click="removeAttendance({{ $index }})"><i
                                                                    class="bi bi-x"></i></button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        @error('attendances')
                                            <div id="" role="alert" class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div class="row mb-3">
                                            <div class="col-lg-12">
                                                <button type="button" class="btn btn-info btn-sm"
                                                    wire:click="addAttendance">Add Attendance</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <button class="btn btn-primary btn-sm" type="submit">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                </div>
            </div>
        </div>
    </div>
</div>
