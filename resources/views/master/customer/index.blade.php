@extends('layouts.app')
@section('content')
    <div class="app-content-header">
        <flux:heading size="xl" level="3">Customer</flux:heading>
       <div class="breadcrumbs text-sm flex justify-between">
            <ul>
                <li><a>Home</a></li>
                <li><a>Customer</a></li>
                <li>List</li>
            </ul>
            <a class="btn btn-sm btn-primary" wire:navigate href="{{ route('customer.create') }}">New Customer</a>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9">
                    <div class="card card-outline card-success">

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-xs table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Opening Balance</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (\App\Models\Customer::all() as $customer)
                                            <tr>
                                                <td>{{ $customer->name }}</td>
                                                <td>{{ $customer->email }}</td>
                                                <td class="text-end">{{ $customer->op_balance }}
                                                    <small>{{ $customer->cr_dr }}</small>
                                                </td>
                                                <td>
                                                    <a href="{{ route('customer.edit', $customer) }}"
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
