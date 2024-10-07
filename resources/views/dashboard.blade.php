@extends('layouts.main')

@section('dashboard')
    @if(session('success') and session('role'))
        <div class="alert alert-secondary" role="alert">
            <p>Hello, {{ session('success') }}</p>
            <p>Your role: {{ session('role') }}</p>
        </div>
    @endif


@endsection
