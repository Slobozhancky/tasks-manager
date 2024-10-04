@extends('layouts.admin-main')

@section('admin-index')
    <h1>Hello {{ auth()->user()->name }}</h1>
@endsection
