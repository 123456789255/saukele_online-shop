@extends('layouts.app')

@section('content')
    <div class="container pt-3">
        @if (session()->has('booking_delete'))
            <div class="alert-success">
                <span class="error-message">{{ session('booking_delete') }}</span>
            </div>
        @endif
        <script>
            @if (session()->has('booking_delete'))
                var dialog = document.querySelector('.alert-success');
                dialog.classList.add('show');
                const displayTime = 5000; // 5 секунд
                // Через заданный интервал времени скрываем диалоговое окно
                setTimeout(() => {
                    dialog.classList.remove('show');
                }, displayTime);
            @endif
        </script>
        @if (session()->has('order_delete'))
            <div class="alert-success">
                <span class="error-message">{{ session('order_delete') }}</span>
            </div>
        @endif
        <script>
            @if (session()->has('order_delete'))
                var dialog = document.querySelector('.alert-success');
                dialog.classList.add('show');
                const displayTime = 5000; // 5 секунд
                // Через заданный интервал времени скрываем диалоговое окно
                setTimeout(() => {
                    dialog.classList.remove('show');
                }, displayTime);
            @endif
        </script>
        <div class="col-md-12 d-flex">
            <h1><strong>Мои заказы</strong></h1>
        </div>
        @if (count($orders) > 0)
            @foreach ($orders as $order)
                <div class="orders mt-2 mb-3">
                    <p>{{ $order->created_at }} (+0 GMT)</p>
                    <p>ФИО: <strong>{{ $order->user->surname }} {{ $order->user->name }}
                            {{ $order->user->patronymic }}</strong>
                    </p>
                    <p class="">Статус
                        @if ($order->status == 'Подтвержден')
                            <strong class="  btn btn-success m-auto text-25px">{{ $order->status }}</strong>
                        @elseif($order->status == 'Отменен')
                            <strong class="  btn btn-danger m-auto text-25px">{{ $order->status }}</strong>
                        @elseif($order->status !== 'Отменен' && $order->status !== 'Подтвержден')
                            <strong class="btn__catalog_in_cart  btn btn-primary m-auto text-25px">Новый</strong>
                        @endif
                    </p>
                    <p>Количество товаров: {{ $order->items->sum('quantity') }}</p>
                    <p class="border_strong">Сумма:
                        <strong>{{ $order->items->sum(function ($cart) {return $cart->product->price * $cart->quantity;}) }}
                            руб.</strong>
                    </p>
                    @if ($order->status == 'Новый')
                        <div class="d-flex">
                            <a href="{{ route('orders.show', ['order' => $order->id]) }}"
                                class=" btn__catalog_in_cart btn btn-primary">
                                {{ __('Просмотреть') }}
                            </a>
                            <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="ms-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm h-100">Удалить</button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('orders.show', ['order' => $order->id]) }}"
                            class="btn__catalog_in_cart btn btn-primary">
                            {{ __('Просмотреть') }}
                        </a>
                    @endif
                </div>
            @endforeach
        @else
            <div class="alert alert-info" role="alert">
                У вас пока нет заказов
            </div>
        @endif
        <div class=" ">
            <h2 id="booking"><strong>Мои бронирования</strong></h2>
        </div>
        <div class=" ">
            @if (count($bookings) > 0)
                @foreach ($bookings as $booking)
                    <div class="bookings ms-0 w-100 row mt-2 mb-3">
                        <div class="col-md-2">
                            <a href="{{ route('product', $booking->product->id) }}" class="text-white">
                                <img src="/img/{{ $booking->product->image }}" alt="black-blue" class="w-100 cart__photo">
                            </a>
                        </div>
                        <div class="col-md-6 mobile_mt-3">
                            <h3>Было забронированно:</h3>
                            <p>Название: <strong><a class="text-black none-underline"
                                        href="{{ route('product', $booking->product->id) }}">{{ $booking->product->name }}</a></strong>
                            </p>
                            <p>Дата: <strong>{{ $booking->date }}</strong></p>
                            <p>Размер: <strong>{{ $booking->size }}</strong></p>
                            <p class="">Статус
                                @if ($booking->status == 'Подтвержден')
                                    <strong class="  btn btn-success m-auto text-25px">{{ $booking->status }}</strong>
                                @elseif($booking->status == 'Отменен')
                                    <strong class="  btn btn-danger m-auto text-25px">{{ $booking->status }}</strong>
                                @elseif($booking->status !== 'Отменен' && $booking->status !== 'Подтвержден')
                                    <strong class="btn__catalog_in_cart  btn btn-primary m-auto text-25px">Новый</strong>
                                @endif
                            </p>
                            @if ($booking->status == 'Новый')
                                <form action="{{ route('bookings.destroy', $booking) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm h-100">Удалить</button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            @else
                <div class="alert alert-info" role="alert">
                    У вас пока забронированных товаров
                </div>
            @endif
        </div>
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
                                    <p class="price text-25px w-100 text-center bg-light  ">
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