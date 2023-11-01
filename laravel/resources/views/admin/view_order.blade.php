@extends('layouts.admin')

@section('content')
    <div class="container admin__view_order z-index-1 pt-3">
        <div class="row cart__items">
            <div class="col-md-3 left">
                <h1 class="mb-3 text-30px">Заказ №{{ $order->id }}</h1>
                <p>Дата заказа: {{ $order->created_at }} (+0 GMT)</p>
                <p>Статус: @if ($order->status == 'Подтвержден')
                        <a class="btn btn-success m-auto">{{ $order->status }}</a>
                    @elseif($order->status == 'Отменен')
                        <a class="btn btn-danger m-auto">{{ $order->status }}</a>
                    @elseif($order->status !== 'Отменен' && $order->status !== 'Подтвержден')
                        <a class="btn btn-primary m-auto">Новый</a>
                    @endif
                </p>
                <p>ФИО заказчика: <strong>{{ $order->user->surname }} {{ $order->user->name }}
                        {{ $order->user->patronymic }}</strong></p>

                @if ($order->user_phone == null)
                    <p>Номер телефона: <a href="tel:{{ $user->phone }}"
                            class="text-black none-underline"><strong>{{ $user->phone }}</strong></a></p>
                @else
                    <p>Номер телефона: <a href="tel:{{ $order->user_phone }}"
                            class="text-black none-underline"><strong>{{ $order->user_phone }}</strong></a></p>
                @endif
                <p>
                    <strong>Итого:
                        {{ $order->items->sum(function ($cart) {return $cart->product->price * $cart->quantity;}) }}
                        руб.</strong>
                </p>
                <div class="d-flex">
                    @if ($order->status == 'Новый')
                        <form method="POST" action="{{ route('admin.cancelOrder', $order->id) }}"
                            class="m-auto mobile_ms-0">
                            @csrf
                            <button type="submit" class="btn btn-danger text-25px">Отменить</button>
                        </form>
                        <form method="POST" action="{{ route('admin.confirmOrder', $order->id) }}"
                            class="m-auto mobile_ms-0">
                            @csrf
                            <button type="submit" class="btn btn-success text-25px">Подтвердить</button>
                        </form>
                    @endif
                </div>
            </div>
            <div class="col-md-8 right ms-5 order__cart_info">
                @foreach ($order->items as $item)
                    <div class="busket-card row white-bg br-15px mb-4 me-4 w-100">
                        <div class="col-md-6 p-0">
                            <img src="/img/{{ $item->product->image }}" alt="product-image-{{ $item->id }}"
                                class="w-100"></td>
                        </div>
                        <div class="col-md-6 d-flex flex-column right p-3">
                            <P class="border_strong text-25px">Название товара:</p>
                            <p class="strong">{{ $item->product->name }} </p>
                            <p class="border_strong text-25px">Цена:</p>
                            <p class="strong">{{ intval($item->price) }} руб.</p>
                            <p class="border_strong text-25px">Количество:</p>
                            <p class="strong">{{ $item->quantity }} шт.</p>
                            <p class="border_strong text-25px">Размер: </p>
                            <p class="strong">{{ $item->size }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection