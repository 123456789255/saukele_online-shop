@extends('layouts.admin')

@section('content')
    <div class="container pt-3 pb-5 z-index-1">
        <h1>Бронирования пользователей</h1>
        <form action="{{ route('admin.showBooking') }}" method="GET">
            <div class="form-group">
                <label for="status">Статус:</label>
                <select name="status" id="status" class="form-control mt-2 mb-2">
                    <option value=""
                        {{ $status !== 'Новый' && $status !== 'Подтвержден' && $status === 'Отменен' ? 'selected' : '' }}>
                        Все</option>
                    <option value="Новый" {{ $status === 'Новый' ? 'selected' : '' }}>Новый</option>
                    <option value="Подтвержден" {{ $status === 'Подтвержден' ? 'selected' : '' }}>
                        Подтвержденный</option>
                    <option value="Отменен" {{ $status === 'Отменен' ? 'selected' : '' }}>Отмененный
                    </option>
                </select>
            </div>
            <button type="submit" class="btn__catalog_in_cart btn btn-primary">Фильтр</button>
        </form>
        @if ($bookings->isEmpty())
            <div class="alert alert-info mb-5" role="alert">
                <h2 class="ms-5">Забронированные товары отсутствуют</h2>
            </div>
        @else
            @foreach ($bookings as $booking)
                <div class="bookings ms-0 w-100 row mt-2 mb-3">
                    <div class="col-md-2">
                        <a href="{{ route('product', $booking->product->id) }}" class="text-white">
                            <img src="/img/{{ $booking->product->image }}" alt="black-blue" class="w-100 cart__photo">
                        </a>
                    </div>
                    <div class="col-md-6 mobile_mt-3">
                        <h3>№{{$booking->id}}</h3>
                        <h3>Было забронированно:</h3>
                        <p>Пользователем: <strong>{{ $user->name }} {{ $user->surname }} {{ $user->patronymic }}</strong>
                        </p>
                        @if ($user->phone == null)
                            <p>Номер телефона пользователя: <strong><a class="text-black"
                                        href="tel:{{ $booking->phone }}">{{ $booking->phone }}</a></strong></p>
                        @else
                            <p>Номер телефона пользователя: <strong><a class="text-black"
                                        href="tel:{{ $user->phone }}">{{ $user->phone }}</a></strong></p>
                        @endif
                        <p class="">Статус
                            @if ($booking->status == 'Подтвержден')
                                <strong class="btn btn-success m-auto text-25px">{{ $booking->status }}</strong>
                            @elseif($booking->status == 'Отменен')
                                <strong class="btn btn-danger m-auto text-25px">{{ $booking->status }}</strong>
                            @elseif($booking->status !== 'Отменен' && $booking->status !== 'Подтвержден')
                                <strong class="btn btn-primary m-auto text-25px">Новый</strong>
                            @endif
                        </p>
                        <p>Название: <strong><a class="text-black none-underline"
                                    href="{{ route('product', $booking->product->id) }}">{{ $booking->product->name }}</a></strong>
                        </p>
                        <p>Размер: <strong><a class="text-black none-underline"
                                    href="{{ route('product', $booking->product->id) }}">{{ $booking->size }}</a></strong>
                        </p>
                        <p>Дата: <strong>{{ $booking->date }}</strong> (ГГГГ-ММ-ДД)</p>
                        <div class="d-flex mobile_none_d-flex mobile_gap-8px">
                            <form method="POST" action="{{ route('admin.cancelBooking', $booking->id) }}"
                                class="mobile_ms-0">
                                @csrf
                                <button type="submit" class="btn btn-danger text-25px">Отменить</button>
                            </form>
                            <form method="POST" action="{{ route('admin.confirmBooking', $booking->id) }}"
                                class="mobile_ms-0 ms-3">
                                @csrf
                                <button type="submit" class="btn btn-success text-25px">Подтвердить</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection