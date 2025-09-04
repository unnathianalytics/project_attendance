@extends('layouts.app')
@section('content')
    @livewire('transaction.payment-form', ['payment' => $payment])
@endsection
