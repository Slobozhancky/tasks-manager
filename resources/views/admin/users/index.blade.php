@extends('layouts.admin-main')

@section('users')

    <div class="container">

        {{-- Flash Message for Success --}}
        @if(session('success'))
            <div class="alert alert-secondary" role="alert">
                <p>Hello, {{ session('success') }}</p>
            </div>
        @endif

        {{-- Error Handling --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Button to Create User --}}
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('admin.users.create') }}" class="btn btn-success">Create User</a>
        </div>

        {{-- Users Table --}}
        <table class="table table-hover">
            <tbody>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Creat At</th>
                <th>Role</th>
                <th></th>
            </tr>

            @foreach($users as $user)
                <tr>
                    <td>{{ $user['id'] }}</td>
                    <td>{{ $user['name'] }}</td>
                    <td>{{ $user['email'] }}</td>
                    <td>{{ $user->created_at->setTimezone('Europe/Kyiv')->format('d.m.Y H:i') }}</td>
                    <td>{{ $user['role'] }}</td>
                    <td>
                        <div style="display: flex">
                            <form action="{{ route('admin.users.edit', [ 'id' => $user['id']]) }}" method="get">
                                @csrf
                                <button type="submit" class="nav-link" style="background: none; border: none; color: inherit; cursor: pointer;">
                                    <img src="{{ asset('images/icons/edit.ico') }}" alt="edit" style="width: 20px">
                                </button>
                            </form>

                            <form action="{{ route('admin.users.destroy', [ 'id' => $user['id']]) }}" method="post">
                                @csrf
                                <button type="submit" class="nav-link ml-1" style="background: none; border: none; color: inherit; cursor: pointer;">
                                    <img src="{{ asset('images/icons/delete.ico') }}" alt="edit" style="width: 20px">
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>

@endsection
