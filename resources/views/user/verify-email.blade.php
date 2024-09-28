@extends('layouts.main')

@section('title', 'Registaration page')

{{--тут створили розмітку для з інфою, що лист відправлено на пошту, а у разі якщо не прийшло, щоб можна було відправити повторно--}}
{{-- TODO тут приклад того, як кастомізувати шаблони для відправки листів: https://laravel.com/docs/11.x/mail#customizing-the-components --}}

@section('verify-email')
    <div class="alert alert-info" role="alert">
        Thanks! Sent confirmation for register to email
    </div>

    <div>
        Didn`t recieve the link?
        <form action="{{ route('verification.send') }}" method="post">
            @csrf
            <button type="submit" class="btn btn-link ps-0">Send link</button>
        </form>
    </div>
@endsection
