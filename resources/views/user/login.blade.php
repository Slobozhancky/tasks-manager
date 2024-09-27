@extends('layouts.main')

@section('title', 'Login page')

@section('login')
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <h1>Login</h1>
@endsection
