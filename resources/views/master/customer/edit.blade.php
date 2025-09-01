@extends('layouts.app')
@section('content')
    @livewire('master.customer-form', ['customer' => $customer])
@endsection
