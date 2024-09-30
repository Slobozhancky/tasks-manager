@extends('layouts.main')

@section('title', 'Login page')

@section('login')
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <h1>Login</h1>

    <div class="row">
        <div class="col">

            @if ($errors->any())
                <div class="alert alert-danger mb-0">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


{{--            TODO 19. при створенні стоірнки для логіну, слід попроберати всі поля  з виводом помилок, як це наприклад зроблено для реєстрації--}}
            <form action="{{ route('loginAuth') }}" method="post">
                @csrf

                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="floatingInputEmail" placeholder="name@example.com" name="email" value="{{ old('email') }}">
                    <label for="floatingInputEmail">Email address</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
                    <label for="floatingPassword">Password</label>
                </div>
                <div class="form-check mb-2">
{{--                    TODO 20. тут буду атрибут value його слід прибрати, бо пуде передавати значення як null--}}
                    <input class="form-check-input" type="checkbox" id="flexCheckDefault" name="remember">
                    <label class="form-check-label" for="flexCheckDefault">
                        Remember me?
                    </label>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('user.create') }}" class="ms-2">Don`t have account?</a>
                <a href="{{ route('password.request') }}" class="ms-2">Forgot password?</a>
            </form>
        </div>
    </div>
@endsection
