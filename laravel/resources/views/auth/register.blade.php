@extends('layouts.app')

@section('content')
    <div class="auth__login">
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="col-md-8 mt-5 mb-5 border login_registration__panel">
                    <div class="row">
                        <div class="col-md-6 p-5">
                            <h1><strong>Регистрация</strong></h1>
                            <div class="card-body pt-3">
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="row mb-2">
                                        <label for="surname"
                                            class="col-md-3 p-0 col-form-label text-md-start">{{ __('Фамилия ') }}</label>
                                        <div class="col-md-9">
                                            <input id="surname" type="text"
                                                class="form-control @error('surname') is-invalid @enderror" name="surname"
                                                value="{{ old('surname') }}" required autocomplete="Last name" autofocus>

                                            @error('surname')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <label for="name"
                                            class="col-md-3 p-0 col-form-label text-md-start">{{ __('Имя') }}</label>

                                        <div class="col-md-9">
                                            <input id="name" type="text"
                                                class="form-control @error('name') is-invalid @enderror" name="name"
                                                value="{{ old('name') }}" required autocomplete="First name" autofocus>

                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <label for="patronymic"
                                            class="col-md-3 p-0 col-form-label text-md-start">{{ __('Отчество') }}</label>
                                        <div class="col-md-9">
                                            <input id="patronymic" type="text"
                                                class="form-control @error('patronymic') is-invalid @enderror"
                                                name="patronymic" value="{{ old('patronymic') }}" autocomplete="Patronymic"
                                                autofocus>
                                            @error('patronymic')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <label for="login"
                                            class="col-md-3 p-0 col-form-label text-md-start">{{ __('Логин') }}</label>
                                        <div class="col-md-9">
                                            <input id="login" type="text"
                                                class="form-control @error('login') is-invalid @enderror" name="login"
                                                value="{{ old('login') }}" required autocomplete="login" autofocus>
                                            @error('login')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <label for="email"
                                            class="col-md-3 p-0 col-form-label text-md-start">{{ __('E-mail ') }}</label>
                                        <div class="col-md-9">
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" required autocomplete="email">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <label for="password"
                                            class="col-md-3 p-0 col-form-label text-md-start">{{ __('Пароль') }}</label>
                                        <div class="col-md-9">
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                required autocomplete="new-password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <label for="password-confirm"
                                            class="col-md-3 p-0 col-form-label text-md-start">{{ __('Повторите пароль') }}</label>
                                        <div class="col-md-9">
                                            <input id="password-confirm" type="password" class="form-control"
                                                name="password_confirmation" required autocomplete="new-password">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                                {{ old('rules') ? 'checked' : '' }} required>
                                            <label class="form-check-label" for="remember">
                                                {{ __('Согласие на обработку персональных данных') }}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row mb-0">
                                        <button type="submit" class="btn btn-saukele">
                                            {{ __('Зарегистрироваться') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6 red-bg p-5 align-center d-flex flex-column justify-content-center">
                            <h2 class="text-white"><strong>Уже зарегистрирован?</strong></h2>
                            <a href="{{ url('/login') }}"
                                class="btn__catalog_in_cart btn__auth btn btn-outline-light btn-register text-30px text-white w-100">Вход</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection