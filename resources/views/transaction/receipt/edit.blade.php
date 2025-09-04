@extends('layouts.app')
@section('content')
    @livewire('transaction.receipt-form', ['receipt' => $receipt])
@endsection
