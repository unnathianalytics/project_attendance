@extends('layouts.app')
@section('content')
    @livewire('transaction.expense-form', ['expense' => $expense])
@endsection
