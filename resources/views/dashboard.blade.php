@extends('layouts.main')

@section('title', 'Dashboard')

@section('dashboard')
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <h1>Dashboard</h1>
@endsection
