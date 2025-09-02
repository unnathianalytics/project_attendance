@extends('layouts.app')
@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0 d-none">Labor List</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a wire:navigate href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Labor List
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
                            <div class="card-title">Labor List</div>
                            <div class="card-tools">
                                <a wire:navigate class="btn btn-sm btn-secondary btn-flat float-end"
                                    href="{{ route('labor.create') }}">New
                                    Labor</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Salary</th>
                                            <th>Opening Balance</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (\App\Models\Labor::all() as $labor)
                                            <tr>
                                                <td>{{ $labor->name }}</td>
                                                <td>{{ $labor->email }}</td>
                                                <td class="text-end">{{ rupees($labor->basic_salary) }}</td>
                                                <td class="text-end">{{ rupees($labor->op_balance) }}
                                                    <small>{{ $labor->cr_dr }}</small>
                                                </td>
                                                <td>
                                                    <a href="{{ route('labor.edit', $labor) }}"
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
