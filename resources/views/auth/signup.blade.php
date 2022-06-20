@extends('layouts.auth')

@section('content')
    <form class="signup-form" method="post" action="{{ route('signup.save') }}">
        @csrf
        @if(Session::get('success'))
            <div class="alert alert-success" data-test-id="created-user-alert">
                {{Session::get('success')}}
            </div>
        @endif

        @if(Session::get('fail'))
            <div class="alert alert-success">
                {{Session::get('fail')}}
            </div>
        @endif
        <div class="form-group mb-2">
            <input
                class="form-control"
                id="signupEmail"
                aria-describedby="emailHelp"
                placeholder="Почта пользователя"
                name="email"
                value="{{ old('email') }}"
            >
            <span class="text-danger" data-test-id="wrong-mail">@error('email'){{ $message }} @enderror</span>
        </div>
        <div class="form-group mb-2">
            <input
                type="text"
                class="form-control"
                id="signupUsername"
                aria-describedby="emailHelp"
                placeholder="Имя пользователя"
                maxlength="100"
                name="name"
                value="{{ old('name') }}"
            >
            <span class="text-danger" data-test-id="wrong-username">@error('name'){{ $message }} @enderror</span>
        </div>
        <div class="form-group password">
            <input
                type="password"
                class="form-control"
                id="password"
                placeholder="Пароль"
                maxlength="50"
                name="password"
                value="{{ old('password') }}"
            >
            <button id="eyeBtn"><i class="fas fa-eye"></i></button>
            <span class="text-danger" data-test-id="wrong-password"> @error('password'){{ $message }} @enderror</span>
        </div>
        <div>
            <button type="submit" class="btn btn-light">Зарегистрироваться</button>
        </div>
        <div class="newaccount-link">
            <a href="{{ route('login') }}" data-test-id="login-link">У меня есть аккаунт</a>
        </div>
    </form>
@endsection
