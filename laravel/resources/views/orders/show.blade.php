@extends('layouts.app')

@section('content')
    <div class="container pt-3">
        <h1>Заказ {{ $order->id }}</h1>
        <p>Дата создания заказа: {{ $order->created_at }} (+0 GMT)</p>
        <p>Статус заказа: {{ $order->status }}</p>
        @if ($order->user_phone == null)
            <p>Номер телефона: <a href="tel:{{ $user->phone }}" class="text-black none-underline">{{ $user->phone }}</a></p>
        @else
            <p>Номер телефона: <a href="tel:{{ $order->user_phone }}"
                    class="text-black none-underline">{{ $order->user_phone }}</a></p>
        @endif
        <p><strong>В ближайшее время с вами свяжется менеджер!</strong></p>
        <table class="table">
            <thead>
                <tr>
                    <th>Название</th>
                    <th>Количество</th>
                    <th>Размер</th>
                    <th>Цена за единицу</th>
                    <th>Итоговая стоимость</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $item)
                    <tr>
                        <td><a href="/product/{{$item->product->id}}" class="text-black none-underline"><strong>{{ $item->product->name }}</strong></a></td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->size }}</td>
                        <td>{{ $item->price }}</td>
                        <td>{{ $item->quantity * $item->price }}руб.</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="">
                    <td colspan="4">Общая стоимость: <strong class="ms-2">
                            {{ $order->items->sum(function ($cart) {return $cart->product->price * $cart->quantity;}) }}
                            руб.
                        </strong></td>
                    <td>
                        @if ($order->status == 'Новый')
                            <form action="{{ route('orders.destroy', $order->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                            </form>
                        @endif
                    </td>
                </tr>
            </tfoot>
        </table>
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