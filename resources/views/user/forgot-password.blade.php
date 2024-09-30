@extends('layouts.main')

@section('title', 'Registaration page')

{{--тут створили розмітку для з інфою, що лист відправлено на пошту, а у разі якщо не прийшло, щоб можна було відправити повторно--}}
{{-- TODO тут приклад того, як кастомізувати шаблони для відправки листів: https://laravel.com/docs/11.x/mail#customizing-the-components --}}

@section('verify-email')
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <h1>Reset password</h1>

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
            <form action="{{ route('password.email') }}" method="post">
                @csrf

                <div class="form-floating mb-3">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="floatingInputEmail" placeholder="name@example.com" name="email" value="{{ old('email') }}">
                    <label for="floatingInputEmail">Email address</label>
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Send link</button>
            </form>
        </div>
    </div>
@endsection
