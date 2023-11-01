@extends('layouts.app')

@section('content')
    <div class="container pt-3">
        @if (session()->has('profile_password'))
            <div class="error-dialog">
                <span class="error-message">{{ session('profile_password') }}</span>
            </div>
        @endif
        <script>
            @if (session()->has('profile_password'))
                var dialog = document.querySelector('.error-dialog');
                dialog.classList.add('show');
                const displayTime = 5000; // 5 секунд
                // Через заданный интервал времени скрываем диалоговое окно
                setTimeout(() => {
                    dialog.classList.remove('show');
                }, displayTime);
            @endif
        </script>
        <div class="profile_title d-flex">
            <h1>Профиль</h1>
            <div class="d-flex align-center ms-auto">
                <a class="btn btn-danger align-center d-flex" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">Выход
                    из профиля</a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
        <div>
            <p>Логин: <strong>{{ $user->login }}</strong></p>
        </div>
        <form action="{{ route('profile.update') }}" method="post" class=" mt-3">
            @csrf
            <div class="form-group">
                <label for="surname">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
            </div>

            <div class="form-group">
                <label for="surname">Фамилия</label>
                <input type="text" class="form-control" id="surname" name="surname" value="{{ $user->surname }}">
            </div>

            <div class="form-group mt-3">
                <label for="name">Имя</label>
                <input type="text" class="form-control mt-1" id="name" name="name" value="{{ $user->name }}">
            </div>

            <div class="form-group mt-3">
                <label for="patronymic">Отчество</label>
                <input type="text" class="form-control mt-1" id="patronymic" name="patronymic"
                    value="{{ $user->patronymic }}">
            </div>

            <div class="form-group mt-3">
                <label for="patronymic">Номер телефона</label>
                <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror"
                    name="phone" value="{{ $user->phone }}" required autocomplete="phone" autofocus>
            </div>

            <button type="submit" class="btn btn-primary btn__catalog_in_cart mt-3">Изменить</button>
        </form>

        <form action="{{ route('profile.update-password') }}" method="post">
            @csrf
            <div class="form-group mt-3">
                <label for="password">Новый пароль</label>
                <input type="password" class="form-control mt-1" id="password" name="password">
            </div>

            <div class="form-group mt-3">
                <label for="password_confirmation">Повторите новый пароль</label>
                <input type="password" class="form-control mt-1" id="password_confirmation" name="password_confirmation">
            </div>

            <button type="submit" class="btn btn-primary btn__catalog_in_cart mt-3">Изменить пароль</button>
        </form>
    </div>
    {{-- Слайдер с товарами --> --}}
    <div class="index__catalog_items mt-5 mb-5">
        <div class="container">
            <div class="row">
                @if ($products->isEmpty())
                    <h2 class="text-start ms-5 mb-3 text-36px index__catalog_title w-90"><strong>Наши новинки</strong></h2>
                    <div class="alert alert-danger m-0" role="alert">
                        <h2 class="m-0 p-0">Каталог пуст.</h2>
                    </div>
                @else
                    <h2 class="text-start ms-5 mb-5 text-36px index__catalog_title"><strong>Наши новинки</strong></h2>
                    <div class="d-flex justify-content-between flex-mobile-column flex-wrap">
                        @foreach ($products as $product)
                            <div class="product mobile-product mt-sm-3">
                                <a href="{{ route('product', $product->id) }}" class="text-black none-underline product_link p-relative h-100">
                                    <img src="/img/{{ $product->image }}" alt="{{ $product->name }}" class="h-100">
                                    <h3 class="mt-3 text-white text-25px w-250px text-center">{{ $product->name }}</h3>
                                    <p class="price text-25px w-100 text-center bg-light  "><strong>{{ $product->price }} руб.<br>{{ $product->rent_or_buy }} руб./сутки</strong>
                                    </p>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <a class="w-100 text-center mt-5 text-black text-black_link" href="{{ url('/catalog') }}">Перейти к
                        каталогу</a>
                @endif
            </div>
        </div>
    </div>
@endsection