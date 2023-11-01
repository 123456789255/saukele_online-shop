@extends('layouts.admin')

@section('content')
    <div class="container pt-3">
        <h1>Редактировать Категорию</h1>

        <form method="post" action="{{ route('admin.updateCategories', $category->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name" class="text-25px">Название категории</label>
                <input type="text" class="form-control mb-2 text-30px" id="name" name="name" value="{{ $category->name_category }}">
            </div>

            <button type="submit" class="btn btn-primary text-25px">Сохранить</button>
        </form>
    </div>
@endsection