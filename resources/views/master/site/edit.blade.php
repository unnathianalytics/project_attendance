@extends('layouts.app')
@section('content')
    @livewire('master.site-form', ['site' => $site])
@endsection
