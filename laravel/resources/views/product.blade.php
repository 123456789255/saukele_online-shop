@extends('layouts.app')

@section('content')
    <div class="container product_index pt-3 pb-5 z-index-1">
        {{-- 1 --}}
        @if (session()->has('error_catalog'))
            <div class="error-dialog">
                <span class="error-message">{{ session('error_catalog') }}</span>
            </div>
        @endif
        <script>
            @if (session()->has('error_catalog'))
                var dialog = document.querySelector('.error-dialog');
                dialog.classList.add('show');
                const displayTime = 5000; // 5 секунд
                // Через заданный интервал времени скрываем диалоговое окно
                setTimeout(() => {
                    dialog.classList.remove('show');
                }, displayTime);
            @endif
        </script>

        {{-- 2 --}}
        @if (session()->has('cart_success'))
            <div class="alert-success">
                <span class="error-message">{{ session('cart_success') }}</span>
            </div>
        @endif
        <script>
            @if (session()->has('cart_success'))
                var dialog = document.querySelector('.alert-success');
                dialog.classList.add('show');
                const displayTime = 5000; // 5 секунд
                // Через заданный интервал времени скрываем диалоговое окно
                setTimeout(() => {
                    dialog.classList.remove('show');
                }, displayTime);
            @endif
        </script>

        {{-- 3 --}}
        @if (session()->has('error_booking'))
            <div class="error-dialog">
                <span class="error-message">{{ session('error_booking') }}</span>
            </div>
        @endif
        <script>
            @if (session()->has('error_booking'))
                var dialog = document.querySelector('.error-dialog');
                dialog.classList.add('show');
                const displayTime = 5000; // 5 секунд
                // Через заданный интервал времени скрываем диалоговое окно
                setTimeout(() => {
                    dialog.classList.remove('show');
                }, displayTime);
            @endif
        </script>

        {{-- 4 --}}
        @if (session()->has('booking_success'))
            <div class="alert-success">
                <span class="error-message">{{ session('booking_success') }}</span>
            </div>
        @endif
        <script>
            @if (session()->has('booking_success'))
                var dialog = document.querySelector('.alert-success');
                dialog.classList.add('show');
                const displayTime = 5000; // 5 секунд
                // Через заданный интервал времени скрываем диалоговое окно
                setTimeout(() => {
                    dialog.classList.remove('show');
                }, displayTime);
            @endif
        </script>

        <div class="row">
            <div class="col-md-7">
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active justify-content-center">
                            <img src="/img/{{ $product->image }}" alt="{{ $product->name }}"
                                class="img-thumbnail product_product_img p-0">
                        </div>
                        @if ($product->image_2 !== null)
                            <div class="carousel-item justify-content-center">
                                <img src="/img/{{ $product->image_2 }}" class="img-thumbnail product_product_img p-0">
                            </div>
                        @else
                            <div class="carousel-item justify-content-center">
                                <img src="/img/{{ $product->image }}" alt="{{ $product->name }}"
                                    class="img-thumbnail product_product_img p-0">
                            </div>
                        @endif
                        @if ($product->image_3 !== null)
                            <div class="carousel-item justify-content-center">
                                <img src="/img/{{ $product->image_3 }}" class="img-thumbnail product_product_img p-0">
                            </div>
                        @else
                            <div class="carousel-item justify-content-center">
                                <img src="/img/{{ $product->image }}" alt="{{ $product->name }}"
                                    class="img-thumbnail product_product_img p-0">
                            </div>
                        @endif
                        @if ($product->image_4 !== null)
                            <div class="carousel-item justify-content-center">
                                <img src="/img/{{ $product->image_4 }}" class="img-thumbnail product_product_img p-0">
                            </div>
                        @else
                            <div class="carousel-item justify-content-center">
                                <img src="/img/{{ $product->image }}" alt="{{ $product->name }}"
                                    class="img-thumbnail product_product_img p-0">
                            </div>
                        @endif
                        @if ($product->image_5 !== null)
                            <div class="carousel-item justify-content-center">
                                <img src="/img/{{ $product->image_5 }}" class="img-thumbnail product_product_img p-0">
                            </div>
                        @else
                            <div class="carousel-item justify-content-center">
                                <img src="/img/{{ $product->image }}" alt="{{ $product->name }}"
                                    class="img-thumbnail product_product_img p-0">
                            </div>
                        @endif
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col-md-5 red-bg">
                <div class="poduct__right">
                    <h1 class="text-36px text-white mt-5">{{ $product->name }}</h1>
                    <p class="product__price text-xs-center text-25px text-red mt-4 mb-5 w-100  ">
                        {{ $product->price }} руб.
                        или
                        {{ $product->rent_or_buy }} руб./сутки.</p>
                    <p class="product__size mt-4 text-25px text-white">Размеры: <strong
                            class="ms-2">{{ $product->min_size }} - {{ $product->max_size }}</strong></p>

                    <div class="mt-5 w-100 text-red">
                        @if ($product->quantity == '0')
                            <p class="login__booking">Нет в наличии</p>
                        @else
                            @guest
                                @if (Route::has('login'))
                                    <a href="{{ url('/login') }}" class="login__booking">Авторизоваться</a>
                                @endif
                            @else
                                @if ($product->quantity == '0')
                                    <p class="login__booking">Нет в наличии</p>
                                @else
                                    <div class="container  ">
                                        <div class="d-flex w-100 justify-content-around">
                                            <a class="btn__in_cart p-3 none-underline text-center align-center d-flex me-1"
                                                data-bs-toggle="offcanvas" href="#in_cart" role="button"
                                                aria-controls="in_cart">
                                                Добавить в корзину
                                            </a>
                                            <a class="btn__in_cart p-3 none-underline text-center align-center d-flex ms-1"
                                                data-bs-toggle="offcanvas" href="#booking" role="button"
                                                aria-controls="booking">
                                                Забронировать
                                            </a>
                                        </div>
                                        <div class="offcanvas offcanvas-start p-4" tabindex="-1" id="booking"
                                            aria-labelledby="booking">
                                            <div class="offcanvas-header p-0 d-none-desktop justify-content-between">
                                                <h2 class="offcanvas-title" id="offcanvasExampleLabel">Забронировать</h2>
                                                <button type="button" class="btn-close text-reset"
                                                    data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <img src="/img/{{ $product->image }}" alt="{{ $product->name }}"
                                                        class="img-thumbnail w-100">
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="offcanvas-header p-0 d-none-mobile">
                                                        <h2 class="offcanvas-title" id="offcanvasExampleLabel">Забронировать
                                                        </h2>
                                                        <button type="button" class="btn-close text-reset"
                                                            data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                                    </div>
                                                    <div class="mt-2">
                                                        <p>Название товара: {{ $product->name }}</p>
                                                        <p>Цена бронирования товара: {{ $product->rent_or_buy }}руб./сутки.</p>
                                                    </div>
                                                    <form action="/bookings" method="post"
                                                        class="d-flex flex-column pe-5 mt-2">
                                                        @csrf
                                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                        <label for="size" class="text-black col-form-label">Выберите
                                                            размер:</label>
                                                        <input type="number" name="size" max="{{ $product->max_size }}"
                                                            min="{{ $product->min_size }}" required class="form-control ">
                                                        <label for="date" class="text-black col-form-label">Дата
                                                            бронирования:</label>
                                                        <input type="date" name="date" id="date" required
                                                            min="{{ now()->format('Y-m-d') }}" class="form-control ">


                                                        <script>
                                                            // Получаем занятые даты из базы данных
                                                            var occupiedDates = {!! json_encode($occupiedDates) !!}; // Замените $occupiedDates на фактический список занятых дат

                                                            // Обработчик изменения значения инпута
                                                            document.getElementById("date").addEventListener("change", function() {
                                                                var selectedDate = this.value;
                                                                var isDateOccupied = occupiedDates.includes(selectedDate);

                                                                // Проверяем, выбрана ли занятая дата
                                                                if (isDateOccupied) {
                                                                    alert("Эта дата уже занята. Выберите другую дату.");
                                                                    this.value = ""; // Сбрасываем выбранную дату
                                                                }
                                                            });
                                                        </script>


                                                        @if ($user->phone == null)
                                                            <div class="form-group row">
                                                                <label for="phone"
                                                                    class="col-form-label text-md-right text-black">{{ __('Номер телефона:') }}</label>
                                                                <div class="">
                                                                    <input id="phone" type="tel"
                                                                        class="form-control @error('phone') is-invalid @enderror"
                                                                        name="phone" value="{{ old('phone') }}" required
                                                                        autocomplete="phone" autofocus>
                                                                    @error('phone')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        @endif

                                                        <button type="submit"
                                                            class="btn__in_cart mt-3">Забронировать</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="offcanvas offcanvas-start  p-4" tabindex="-1" id="in_cart"
                                            aria-labelledby="in_cart">
                                            <div class="offcanvas-header p-0 d-none-desktop justify-content-between">
                                                <h2 class="offcanvas-title" id="offcanvasExampleLabel">Добавить в корзину</h2>
                                                <button type="button" class="btn-close text-reset"
                                                    data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <img src="/img/{{ $product->image }}" alt="{{ $product->name }}"
                                                        class="img-thumbnail w-100">
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="offcanvas-header p-0 d-none-mobile">
                                                        <h2 class="offcanvas-title" id="offcanvasExampleLabel">Добавить в
                                                            корзину</h2>
                                                        <button type="button" class="btn-close text-reset"
                                                            data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                                    </div>
                                                    <div class="mt-2">
                                                        <p>Название товара: {{ $product->name }}</p>
                                                        <p>Цена товара: {{ $product->price }}руб.</p>
                                                    </div>
                                                    <form action="{{ route('cart.add', $product->id) }}" method="POST"
                                                        class="d-flex flex-column pe-5">
                                                        @csrf
                                                        <label for="size" class="text-black col-form-label">Выберите
                                                            размер:</label>
                                                        <input type="number" name="size" max="{{ $product->max_size }}"
                                                            min="{{ $product->min_size }}" required class="form-control ">
                                                        <button type="submit" class="btn__in_cart mt-3">В корзину</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endguest
                        @endif
                    </div>
                    <p class="text-25px mt-5 text-white">Описание:<br>{{ $product->description }}</p>
                </div>
            </div>
        </div>
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
                                <a href="{{ route('product', $product->id) }}"
                                    class="text-black none-underline product_link p-relative h-100">
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