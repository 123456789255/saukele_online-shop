@extends('layouts.app')

@section('content')
    <div class="auth__login">
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="col-md-8 mt-5 mb-5 border login_registration__panel">
                    <div class="row">
                        <div class="col-md-6 p-5">
                            <h1><strong>Вход</strong></h1>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="row mb-3 mt-3">
                                    <label for="login"
                                        class="col-md-2 col-form-label text-md-start">{{ __('Логин') }}</label>

                                    <div class="col-md-10">
                                        <input id="login" type="login"
                                            class="form-control @error('login') is-invalid @enderror" name="login"
                                            value="{{ old('login') }}" required autocomplete="login" autofocus>

                                        @error('login')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password"
                                        class="col-md-2 col-form-label text-md-start">{{ __('Пароль') }}</label>

                                    <div class="col-md-10">
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6 w-100 d-flex">
                                        <div class="form-check col-md-5">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                                {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                {{ __('Запомнить меня') }}
                                            </label>
                                        </div>
                                        <div class="password_reset col-md-6 ms-auto d-flex justify-content-end">
                                            @if (Route::has('password.request'))
                                                <a class="btn btn-link text-end p-0 text-red forgot_password"
                                                    href="{{ route('password.request') }}">
                                                    {{ __('Забыли пароль?') }}
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <button type="submit" class="btn btn-saukele">
                                        {{ __('Войти') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6 red-bg p-5 align-center d-flex flex-column justify-content-center">
                            <h2 class="text-white"><strong>Еще не зарегистрировался?</strong></h2>
                            <a href="{{ url('/register') }}"
                                class="btn__catalog_in_cart btn__auth btn btn-outline-light btn-register text-30px text-white w-100">Зарегистрироваться</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection