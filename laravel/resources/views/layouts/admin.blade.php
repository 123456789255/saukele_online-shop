<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

{{-- <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Saukele' }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">


    <!-- Scripts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <link href="{{ secure_asset('css/style.css') }}" rel="stylesheet dns-prefetch">
    <link rel="shortcut icon" href="{{ secure_asset('img/radius-logo.svg') }}" type="image/x-icon">

</head> --}}

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Saukele' }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="/img/icons/radius-logo.svg" type="image/x-icon">
</head>

<body id="body">
    <div id="app" class="bg-white app">
        <div class="container p-0 header" id="header">
            <nav class="navbar navbar-expand-md navbar-light bg-white">
                <div class="w-100 flex-column">
                    <div class="d-flex w-100 align-center justify-content-around">
                        <div class="phone-div d-flex align-center justify-content-center">
                            <div class="phone-text text-center">
                                <a href="tel:+79088058925" class="text-black decoration-none">+7(962)047-39-00</a>
                                <a href="tel:+79088058925" class="text-black">Обратная связь</a>
                            </div>
                        </div>
                        <div class="img-toggler d-flex justify-content-around">
                            <a class="d-none phone" href="tel:+79088058925"><img src="/img/icons/phone.svg"
                                    alt="phone"></a>
                            <a class="navbar-brand me-0 p-3" href="{{ url('/') }}">
                                <img class="logo" src="/img/icons/logo.svg" alt="Logo">
                            </a>
                            <div class="hamb">
                                <div class="hamb__field" id="hamb">
                                    <span class="bar"></span>
                                    <span class="bar"></span>
                                    <span class="bar"></span>
                                </div>
                            </div>
                        </div>
                        <div class="collapse navbar-collapse top_collapse d-none-mobile" id="navbarSupportedContent">
                            <!-- Right Side Of Navbar -->
                            <div class="navbar-nav gap-3px">
                                <div class="nav-item">
                                    <a class="nav-link p-0" href="https://vk.com/saukele_omsk">
                                        <img class="vk w-53px" src="/img/icons/vk.png" alt="">
                                    </a>
                                </div>
                                <div class="nav-item">
                                    <a class="nav-link p-0" href="/cart">
                                        <img class="busket w-53px" src="/img/icons/busket.png" alt="">
                                    </a>
                                </div>
                                <!-- Authentication Links -->
                                @guest
                                    @if (Route::has('login'))
                                        <div class="nav-item like_at_login align-center d-flex">
                                            <a class="nav-link btn person-btn h-100 p-0" href="{{ route('login') }}"><img
                                                    class="auth w-54px" src="/img/icons/person.png" alt="{{ __('Login') }}"></a>
                                        </div>
                                    @endif
                                @else
                                    <div class="nav-item dropdown align-center d-flex">
                                        <a class="btn person-btn p-0" id="person_btn">
                                            <img class="w-54px" src="/img/icons/person.png" alt="logo">
                                        </a>
                                        <div class="dropdown-menu" id="person_btn__dropdown">
                                            @if (Auth::user()->role == 2)
                                                <a class="dropdown-item" href="/admin">Админка</a>
                                            @endif
                                            <a class="dropdown-item" href="/profile">Профиль</a>
                                            <a class="dropdown-item" href="/orders">Заказы</a>
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">Выход</a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                @endguest
                            </div>
                        </div>
                    </div>
                    <ul class="menu justify-content-around" id="menu">
                        <li class="top_collapse justify-content-center d-none-desktop ul_person align-center"
                            id="navbarSupportedContent">
                            @guest
                                @if (Route::has('login'))
                                    <a class="nav-link p-0" href="https://vk.com/saukele_omsk">
                                        <img class="vk" src="/img/icons/vk.png" alt="">
                                    </a>
                                    <a class="nav-link  p-0" href="/cart">
                                        <img class="busket" src="/img/icons/busket.png" alt="">
                                    </a>
                                    <a class="nav-link btn person-btn h-100" href="{{ route('login') }}"><img
                                            class="auth" src="/img/icons/person.png" alt="{{ __('Login') }}"></a>
                                @endif
                            @elseif(Auth::user()->role == 2)
                                <a class="nav-link" href="{{ url('/admin') }}">
                                    <img class="vk" src="/img/icons/admin.svg" alt="">
                                </a>
                                <a class="nav-link" href="/cart">
                                    <img class="busket" src="/img/icons/busket.svg" alt="">
                                </a>
                                <a href="{{ url('/orders') }}"><img src="/img/order.svg" alt=""></a>
                                <a class="dropdown-item" href="/profile"><img class="vk" src="/img/icons/person.png"
                                        alt=""></a>
                            @else
                                <a class="nav-link p-0" href="https://vk.com/saukele_omsk">
                                    <img class="vk" src="/img/icons/vk.png" alt="">
                                </a>
                                <a class="nav-link p-0" href="/cart">
                                    <img class="busket" src="/img/icons/busket.png" alt="">
                                </a>
                                <a href="{{ url('/orders') }}"><img src="/img/order.svg" alt=""></a>
                                <a class="dropdown-item" href="/profile"><img class="vk" src="/img/icons/person.png"
                                        alt=""></a>
                            @endguest
                        </li>
                        <li class="active text-15px p-0  ">
                            <a class="nav-link text-black text-black_link mobile-text-black"
                                href="{{ url('/') }}">Главная</a>
                        </li>
                        <li class="active text-15px p-0  ">
                            <a class="nav-link text-black text-black_link mobile-text-black"
                                href="{{ url('/admin/booking') }}">Бронирование</a>
                        </li>
                        <li class="active text-15px p-0">
                            <a class="nav-link text-black text-black_link mobile-text-black"
                                href="{{ url('/admin/orders') }}">Заказы</a>
                        </li>
                        <li class="text-15px p-0">
                            <a class="nav-link text-white text-white_link mobile-text-black"
                                href="{{ url('/admin/products') }}">Товары</a>
                        </li>
                        <li class="text-15px p-0">
                            <a class="nav-link text-white text-white_link mobile-text-black"
                                href="{{ url('/admin/category') }}">Категории</a>
                        </li>
                        <li class="text-15px p-0">
                            <a class="nav-link text-white text-white_link mobile-text-black"
                                href="{{ url('/admin/users') }}">Пользователи</a>

                        </li>

                    </ul>
                </div>
            </nav>
            <div class="popup blure" id="popup"></div>
        </div>

        <main class="z-index-1">
            @yield('content')
        </main>
        <footer>
            <div class="container footer z-index-1 p-relative">
                <div class="d-none-mobile d-flex justify-content-around footer-partners">
                    <div class="d-flex justify-content-center">
                        <a class="partner1" href="https://podpiska.pochta.ru/press/%D0%9F%D0%A0779">
                            <img src="/img/icons/omby-kazaktar-mini.svg" width="210px" height="113px" alt="Спонсор">
                        </a>
                    </div>
                    <div class="justify-content-center mb-4 logo-d-none-mobile">
                        <a href="http://www.saukele.ru">
                            <img src="/img/icons/logo.svg" alt="Лого" class="logo">
                        </a>
                    </div>
                    <div class="d-flex justify-content-around mobile_w-100 partner2-div">
                        <a class="d-none d-none-mobile w-mobile partner1-mobile" href="https://vk.com/kazahi_omska">
                            <img src="/img/icons/omby-kazaktar-mini.svg" alt="Спонсор">
                        </a>
                        <a class="w-mobile partner2" href="https://vk.com/kazahi_omska">
                            <img src="/img/icons/KO-mini.svg" width="210px" height="113px" alt="Спонсор">
                        </a>
                    </div>
                </div>
                <div class="footer-menu d-flex flex-wrap justify-content-around">
                    <div class="row w-100">
                        <div class="d-flex col-md-6 justify-content-around">
                            <ul class="list-none ps-0">
                                <li><a href="{{ route('about') }}"
                                        class="text-black text-black_link none-underline">Главная</a></li>
                                <li><a href="{{ route('catalog') }}"
                                        class="text-black text-black_link none-underline">Каталог</a></li>
                                <li class="d-none-desktop justify-content-start"><a href="{{ url('/#about') }}"
                                        class="text-black text-black_link none-underline">О нас</a></li>
                                <li class="d-none-desktop justify-content-start"><a href="{{ url('/#contacts') }}"
                                        class="text-black text-black_link none-underline">Контакты</a></li>
                            </ul>
                            <ul class="list-none ps-0 d-none-mobile d-block-desktop">
                                <li><a href="{{ url('/#about') }}"
                                        class="text-black text-black_link none-underline">О нас</a></li>
                                <li><a href="{{ url('/#contacts') }}"
                                        class="text-black text-black_link none-underline">Контакты</a></li>
                            </ul>
                            <ul class="list-none ps-0">
                                <li><a href="{{ route('cart.show') }}"
                                        class="text-black text-black_link mobile-text-white_link none-underline">Корзина</a>
                                </li>
                                <li><a href="{{ route('orders.index') }}"
                                        class="text-black text-black_link mobile-text-white_link none-underline">Заказы</a>
                                </li>
                                <li class="d-none-desktop justify-content-start"><a href="{{ route('profile') }}"
                                        class="mobile-text-white_link none-underline">Профиль</a></li>
                                <li class="d-none-desktop justify-content-start  "><a
                                        href="{{ url('/orders#booking') }}"
                                        class="mobile-text-white_link none-underline">Бронирование</a></li>
                            </ul>
                        </div>
                        <div class="d-flex ps-0 col-md-6 justify-content-around">
                            <ul class="d-none-mobile d-block-desktop list-none">
                                <li><a href="{{ route('profile') }}"
                                        class="text-white text-white_link none-underline">Профиль</a></li>
                                <li class=" "><a href="{{ url('/orders#booking') }}"
                                        class="text-white text-white_link none-underline">Бронирование</a></li>
                            </ul>
                            <ul class="list-none ps-0">
                                <li>
                                    <a href="tel:+79088058925"
                                        class="text-white text-white_link mobile-text-black_link none-underline">+7
                                        (908) 805-89-25</a>
                                </li>
                                <li><a href="mailto:kuho007@mail.ru?subject=Вопрос с сайта Saukele-Omsk.ru&body=Здравствуйте, "
                                        class="text-white text-white_link mobile-text-black_link none-underline">kuho007@mail.ru</a>
                                </li>
                            </ul>
                            <ul class="list-none ps-0">
                                <li><a href="https://yandex.ru/maps/?um=constructor%3A008028625d0b227fc446a2cac6528f4ba88129d7f470e99485874cb0a81eb245&amp;source=constructorLink"
                                        class="text-white text-white_link none-underline">Ул.Ленина
                                        38 оф.401</a></li>
                                <li><a href="https://vk.com/saukele_omsk"
                                        class="text-white text-white_link none-underline">Вконтакте</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="d-flex">
                    <p class="w-50 text-end text-black mb-0">Saukele</p>
                    <p class="w-50 text-start text-white mb-0"> Omsk 2023</p>
                </div>
            </div>
        </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- jQuery UI -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="{{ asset('/js/script.js') }}"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script> --}}
</body>

</html>