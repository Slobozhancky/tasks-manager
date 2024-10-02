@extends('layouts.main')

@section('dashboard')
    @if(session('success'))
        <div class="alert alert-secondary" role="alert">
            Hello, {{ session('success')['name'] }}!!!
        </div>
    @endif
@endsection
