@extends('layouts.auth')

@section('content')
    <form
        class="login-form"
        method="post"
        action="{{ route('login.check') }}"
    >
        @if(Session::get('fail'))
            <div class="alert alert-danger" data-test-id="error-alert">
                {{Session::get('fail')}}
            </div>
        @endif

        @csrf

        <div class="form-group mb-2">
            <input
                class="form-control"
                id="username"
                maxlength="100"
                placeholder="Ел. почта"
                name="email"
                value="{{ old('email') }}"
            >
            <span class="text-danger" data-test-id="invalid-email-message">@error('email'){{ $message }} @enderror</span>
        </div>
        <div class="form-group password">
            <input
                type="password"
                class="form-control"
                maxlength="50"
                id="password"
                placeholder="Пароль"
                name="password"
                value="{{ old('password') }}"
            >
            <button id="eyeBtn"><i class="fas fa-eye" id="eyeIcon"></i></button>
            <span class="text-danger" data-test-id="wrong-password">@error('password'){{ $message }} @enderror</span>
        </div>
        <div>
            <button type="submit" id="login" class="btn btn-light">Ввойти</button>
        </div>
        <div class="newaccount-link">
            <a href="{{ route('signup') }}" data-test-id="signup-link">У меня нет аккаунта</a>
        </div>
    </form>
@endsection
