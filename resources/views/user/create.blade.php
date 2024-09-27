@extends('layouts.main')

@section('title', 'Registaration page')

@section('registaration')
    <h1 class="mb-2">Registaration</h1>

    <div class="row">
        <div class="col">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif



            <form action="{{ route('user.store') }}" method="post">
                @csrf

                <div class="form-floating mb-3">
                    <input type="name" class="form-control @error('name') is-invalid @enderror" id="floatingInputLogin" placeholder="your name" name="name" value="{{ old('name') }}" >
                    <label for="floatingInputLogin">Login</label>
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="floatingInputEmail" placeholder="name@example.com" name="email" value="{{ old('email') }}">
                    <label for="floatingInputEmail">Email address</label>
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="floatingPassword" placeholder="Password" name="password">
                    <label for="floatingPassword">Password</label>
                    @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
{{--                за цим посиланням знаходиться правило, як ми мажємо підписувати поле, якщо його слід підтвердити з форми: https://laravel.com/docs/11.x/validation#rule-confirmed--}}
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="password_confirmation" placeholder="password_confirmation" name="password_confirmation">
                    <label for="password_confirmation">Confirm Password</label>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('login') }}" class="ms-2">Already register?</a>
            </form>
        </div>
    </div>
@endsection
