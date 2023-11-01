@extends('layouts.admin')

@section('content')
    <div class="container h-23vh w-100 admin__index pt-5">
        <div class="d-flex justify-content-around align-center h-100 w-100 align-center flex_mobile">
            <a href="{{ route('admin.showBooking') }}" class="btn__catalog_in_cart  btn btn-success  ">Бронирование</a>
            <a href="{{ route('admin.orders') }}" class="btn__catalog_in_cart  btn btn-success ">Заказы</a>
            <a href="{{ route('admin.products') }}" class="btn__catalog_in_cart btn btn-primary ">Товары</a>
            <a href="{{ route('admin.category') }}" class="btn__catalog_in_cart btn btn-danger ">Категории</a>
            <a href="{{ route('admin.users') }}" class="btn__catalog_in_cart text-white btn btn-info ">Пользователи</a>
        </div>
    </div>
@endsection