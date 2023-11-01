@extends('layouts.app')

@section('content')
    <div class="auth__login">
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="col-md-8 mt-5 mb-5 border login_registration__panel">
                    <div class="row">
                        <div class="col-md-12 p-5">
                            <h1 class="mb-4"><strong>{{ __('Проверьте свой адрес электронной почты') }}</strong></h1>
                            {{ __('Пожалуйста, подтвердите свой пароль, прежде чем продолжить.') }}

                            @if (session('resent'))
                                <div class="alert alert-success" role="alert">
                                    {{ __('На ваш адрес электронной почты отправлена новая ссылка для подтверждения.') }}
                                </div>
                            @endif

                            {{ __('Прежде чем продолжить, проверьте свою электронную почту на наличие ссылки для подтверждения.') }}
                            {{ __('Если вы не получили письмо') }},
                            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                @csrf
                                <button type="submit"
                                    class="btn btn-link p-0 m-0 align-baseline">{{ __('нажмите здесь, чтобы запросить другой') }}</button>.
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection