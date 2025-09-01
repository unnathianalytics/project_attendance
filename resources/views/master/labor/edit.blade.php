@extends('layouts.app')
@section('content')
    @livewire('master.labor-form', ['labor' => $labor])
@endsection
