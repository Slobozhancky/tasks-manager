@extends('layouts.main')

@section('show-tasks')
    @if(session('success') and session('role'))
        <div class="alert alert-secondary" role="alert">
            <p>Hello, {{ session('success') }}</p>
            <p>Your role: {{ session('role') }}</p>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @section('dashboard')
        <h2 class="text-center">{{ $category->title }}</h2>

        <div class="row" style="width: 100%">
            <div class="col-2">
                <x-categories :categories="$categories"/>
            </div>

            <div class="col-10">
                <div class="row">
                    <x-tasks :tasks="$tasks" :categories="$categories" :category="$category" :statuses="$statuses"/>
                    <x-create_tasks :statuses="$statuses" :categories="$categories"/>
                </div>
            </div>
        </div>
    @endsection
@endsection
