@extends('layouts.app')
@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0 d-none">Attendence List</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a wire:navigate href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Attendence List
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
                            <div class="card-title">Attendence List</div>
                            <div class="card-tools">
                                <a wire:navigate class="btn btn-sm btn-secondary btn-flat float-end"
                                    href="{{ route('attendance.create') }}">New
                                    Attendence</a>
                            </div>
                        </div>
                        <div class="card-body">
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
                                        @foreach (\App\Models\Attendance::all() as $attendance)
                                            <tr>
                                                <td>{{ $attendance->date }}</td>
                                                <td>{{ $attendance->labor->name }}</td>
                                                <td>{{ $attendance->site->name }}</td>

                                                <td class="text-end">{{ $attendance->attendance_unit }}
                                                    <small>{{ $attendance->cr_dr }}</small>
                                                </td>
                                                <td class="text-end">{{ rupees($attendance->payable) }}</td>
                                                <td>
                                                    <a href="{{ route('attendance.edit', $attendance) }}"
                                                        class="btn btn-sm btn-warning btn-flat">Edit</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">


                </div>
            </div>
        </div>
    </div>
@endsection
