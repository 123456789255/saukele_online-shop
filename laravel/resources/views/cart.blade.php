@extends('layouts.app')

@section('content')
    <div class="container cart pt-3">
        @if (session()->has('error'))
            <div class="error-dialog">
                <span class="error-message">{{ session('error') }}</span>
            </div>
        @endif
        <script>
            @if (session()->has('error'))
                var dialog = document.querySelector('.error-dialog');
                dialog.classList.add('show');
                const displayTime = 5000; // 5 секунд
                // Через заданный интервал времени скрываем диалоговое окно
                setTimeout(() => {
                    dialog.classList.remove('show');
                }, displayTime);
            @endif
        </script>
        @if (session()->has('error_cart'))
            <div class="error-dialog">
                <span class="error-message">Вы добавили в корзину больше товара чем есть на складе. На складе сейчас имеется
                    {{ session('error_cart') }} ед. товара.</span>
            </div>
        @endif
        <script>
            @if (session()->has('error_cart'))
                var dialog = document.querySelector('.error-dialog');
                dialog.classList.add('show');
                const displayTime = 5000; // 5 секунд
                // Через заданный интервал времени скрываем диалоговое окно
                setTimeout(() => {
                    dialog.classList.remove('show');
                }, displayTime);
            @endif
        </script>
        @if ($carts->isEmpty())
            <div class="card-header ms-5">
                <h1 class="mt-3 text-30px">Корзина</h1>
            </div>
            <div class="alert alert-info mb-5" role="alert">
                <h2 class="ms-5">Ой... похоже что ваша корзина пуста.</h2>
            </div>
        @else
            <div class="row cart__items">
                <div class="col-md-4 left">
                    <div class="card-header mt-3">
                        <h1 class="text-30px">Корзина</h1>
                    </div>
                    <p class="m-0 text-25px">Количество предметов в корзине: <strong>{{ $count }} шт.</strong></p>
                    <p class="m-0 text-25px">Общая стоимость:
                        <strong>{{ $carts->sum(function ($cart) {return $cart->product->price * $cart->quantity;}) }}
                            руб.</strong>
                    </p>
                    {{-- <p class="m-0 text-25px"><br>Для того чтобы оформить заказ введите свой номер телефона:</p> --}}
                    @if ($user->phone == null)
                        <form method="POST" action="{{ route('orders.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="phone"
                                    class="col-md-5 col-form-label text-md-right">{{ __('Номер телефона') }}</label>

                                <div class="col-md-6">
                                    <input id="phone" type="tel"
                                        class="form-control @error('phone') is-invalid @enderror" name="phone"
                                        value="{{ old('phone') }}" required autocomplete="phone" autofocus>

                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0 mt-3">
                                <div>
                                    <button type="submit" class="btn__catalog_in_cart btn btn-primary w-100">
                                        {{ __('Оформить заказ') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    @else
                        <form method="POST" action="{{ route('orders.store') }}">
                            @csrf
                            <div class="form-group row mb-0 mt-3">
                                <div>
                                    <button type="submit" class="btn__catalog_in_cart btn btn-primary w-100">
                                        {{ __('Оформить заказ') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    @endif
                    <p class="m-0 text-25px"><br>Наш менеджер в скором времени свяжется с вами!</p>
                </div>
                <div class="col-md-8 right">
                    <div class="d-none-desktop me-auto">
                        <h2 class="mt-5 mb-0">Содержимое корзины:</h2>
                    </div>
                    @foreach ($carts as $cart)
                        <div class="busket-card row white-bg br-15px mb-4 me-4 w-100">
                            <div class="col-md-6 p-3 cart__left">
                                <a href="{{ route('product', $cart->product->id) }}">
                                    <img src="/img/{{ $cart->product->image }}" alt="black-blue" class="w-100 cart__photo">
                                </a>
                            </div>
                            <div class="col-md-6 p-3 text-black cart__right">
                                <div class="d-flex">
                                    <p class="text-30px mt-3 me-auto"><strong>{{ $cart->Product->name }}</strong></p>
                                    <a href="{{ route('cart.remove.all', ['cartId' => $cart->id]) }}"
                                        class="mt-3 close-button" onclick="return confirm('Вы уверены?')">
                                        <img class="" src="img/close.svg" alt="">
                                    </a>
                                </div>
                                <div class="d-flex mt-4 mb-3">
                                    <p class="cart__product__size  mt-2 text24px400">Размер:
                                        <strong class="text-black ms-3">{{ $cart->size }}</strong>
                                    </p>
                                </div>
                                <div class="quantity">
                                    <p class="mt-2 text24px400">Количество :</p>
                                    <div class="d-flex quantity_buttons text24px weight700">
                                        <a href="/remove-from-card/{{ $cart->product_id }}" class="btn  minus me-3">-</a>
                                        <p class="m-0">{{ $cart->quantity }} шт.</p>
                                        <a href="/add-on-cart/{{ $cart->product_id }}" class="btn btn-primary plus ms-3"
                                            id="add-to-cart-btn">+</a>
                                    </div>
                                </div>
                                <p class="cart__price mt-5 mt-2">{{ intval($cart->Product->price) * $cart->quantity }} руб.
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
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
                                    <p class="price text-25px w-100 text-center bg-light">
                                        <strong>{{ $product->price }} руб.<br>{{ $product->rent_or_buy }}
                                            руб./сутки</strong>
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
