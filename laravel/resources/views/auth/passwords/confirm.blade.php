@extends('layouts.app')

@section('content')
    <div class="auth__login">
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="col-md-8 mt-5 mb-5 border login_registration__panel">
                    <div class="row">
                        <div class="col-md-12 p-5">
                            <h1 class="mb-4"><strong>{{ __('Подтвердите пароль') }}</strong></h1>
                            {{ __('Пожалуйста, подтвердите свой пароль, прежде чем продолжить.') }}

                            <form method="POST" action="{{ route('password.confirm') }}">
                                @csrf

                                <div class="row mb-3">
                                    <label for="password"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Пароль') }}</label>

                                    <div class="col-md-6">
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

                                <div class="row mb-0">
                                    <div class="col-md-8 offset-md-4 ms-20p">
                                        <button type="submit" class="btn__catalog_in_cart btn btn-primary">
                                            {{ __('Подтвердите пароль') }}
                                        </button>

                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Забыли пароль?') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection