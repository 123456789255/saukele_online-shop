@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Редактировать товар</h1>

        <form method="post" action="{{ route('admin.updateProduct', $product->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Название товара</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}">
            </div>

            <div class="form-group">
                <label for="description">Описание товара</label>
                <textarea class="form-control" id="description" name="description" rows="5">{{ $product->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="price">Цена товара</label>
                <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}">
            </div>

            <div class="form-group  ">
                <label for="rent_or_buy">Покупка или аренда</label>
                <input type="number" class="form-control" id="rent_or_buy" name="rent_or_buy"
                    value="{{ $product->rent_or_buy }}">
            </div>

            <div class="form-group">
                <label for="gender">Пол</label>
                <select name="gender" class="form-control form-category" id="gender">
                    <option value="{{ $product->gender }}">{{ $product->gender }}</option>
                    @if ($product->gender == 'Женский')
                        <option value="Мужской">Мужской</option>
                        <option value="Унисекс">Унисекс</option>
                    @elseif($product->gender == 'Мужской')
                        <option value="Женский">Женский</option>
                        <option value="Унисекс">Унисекс</option>
                    @elseif($product->gender == 'Унисекс')
                        <option value="Мужской">Мужской</option>
                        <option value="Женский">Женский</option>
                    @endif
                </select>
            </div>

            <div class="form-group">
                <label for="category">Категория</label>
                <select class="form-control" id="category" name="category" required>
                    @foreach ($category as $cat)
                        <option value="{{ $cat->id }}"
                            {{ $cat->id == request()->query('category') ? 'selected' : '' }}>
                            {{ $cat->name_category }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="category">Подкатегория</label>
                <select class="form-control" id="subcategory" name="subcategory" required>
                    @foreach ($subcategories as $sub)
                        {{-- @if ($sub->category_id == $category->id) --}}
                        <option value="{{ $sub->id }}"
                            {{ $sub->id == request()->query('subcategory') ? 'selected' : '' }}>
                            {{ $sub->name }}</option>
                        {{-- @endif --}}
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="quantity">Колличество товара на складе</label>
                <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $product->quantity }}">
            </div>

            <div class="form-group">
                <label for="size">Размер от</label>
                <input type="number" name="min_size" id="min_size" class="form-control" value="{{ $product->min_size }}">
            </div>

            <div class="form-group">
                <label for="size">Размер до</label>
                <input type="number" name="max_size" id="max_size" class="form-control" value="{{ $product->max_size }}">
            </div>

            <script>
                var minSizeInput = document.getElementById('min_size');
                var maxSizeInput = document.getElementById('max_size');

                // Обработчик изменения значения в инпуте "Размер от"
                minSizeInput.addEventListener('change', function() {
                    var minValue = parseInt(this.value);
                    var maxValue = parseInt(maxSizeInput.value);

                    // Проверяем, если значение в инпуте "Размер от" больше значения в инпуте "Размер до",
                    // то устанавливаем значение в инпуте "Размер до" равным значению в инпуте "Размер от"
                    if (minValue > maxValue) {
                        maxSizeInput.value = minValue;
                    }
                });

                // Обработчик изменения значения в инпуте "Размер до"
                maxSizeInput.addEventListener('change', function() {
                    var minValue = parseInt(minSizeInput.value);
                    var maxValue = parseInt(this.value);

                    // Проверяем, если значение в инпуте "Размер до" меньше значения в инпуте "Размер от",
                    // то устанавливаем значение в инпуте "Размер от" равным значению в инпуте "Размер до"
                    if (maxValue < minValue) {
                        minSizeInput.value = maxValue;
                    }
                });
            </script>

            <div class="form-group mt-3">
                <label for="image">Изображение товара 1</label>
                <input type="file" name="image" id="image" class="form-control-file">
                @if ($product->image == null)
                @else
                        <div class="col-md-6 mt-2"><img src="/img/{{ $product->image }}" alt="Изображение товара 1 отсутствует" class="w-100px"></div>
                        <div class="col-md-6"><p class="mt-2">Фото 1</p></div>


                @endif
            </div>
            <div class="form-group mt-3">
                <label for="image">Изображение товара 2</label>
                <input type="file" name="image_2" id="image_2" class="form-control-file">
                @if ($product->image_1 == null)
                @else
                    <div class="col-md-6 mt-2"><img src="/img/{{ $product->image_1 }}" alt="Изображение товара 2 отсутствует" class="w-100px"></div>
                    <div class="col-md-6"><p class="mt-2">Фото 1</p></div>

                @endif
            </div>
            <div class="form-group mt-3">
                <label for="image">Изображение товара 3</label>
                <input type="file" name="image_3" id="image_3" class="form-control-file">
                @if ($product->image_2 == null)
                @else
                    <div class="col-md-6 mt-2"><img src="/img/{{ $product->image_2 }}" alt="Изображение товара 3 отсутствует" class="w-100px"></div>
                    <div class="col-md-6"><p class="mt-2">Фото 1</p></div>

                @endif
            </div>
            <div class="form-group mt-3">
                <label for="image">Изображение товара 4</label>
                <input type="file" name="image_4" id="image_4" class="form-control-file">
                @if ($product->image_3 == null)
                @else
                    <div class="col-md-6 mt-2"><img src="/img/{{ $product->image_3 }}" alt="Изображение товара 4 отсутствует" class="w-100px"></div>
                    <div class="col-md-6"><p class="mt-2">Фото 1</p></div>

                @endif
            </div>
            <div class="form-group mt-3">
                <label for="image">Изображение товара 5</label>
                <input type="file" name="image_5" id="image_5" class="form-control-file">
                @if ($product->image_4 == null)
                @else
                    <div class="col-md-6 mt-2"><img src="/img/{{ $product->image_4 }}" alt="Изображение товара 5 отсутствует" class="w-100px"></div>
                    <div class="col-md-6"><p class="mt-2">Фото 1</p></div>

                @endif
            </div>

            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>
@endsection