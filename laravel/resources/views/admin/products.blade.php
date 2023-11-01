@extends('layouts.admin')

@section('content')
    <div class="container admin_products pt-5 z-index-1">
        <div class="row cart__items">
            <div class="col-md-3 left">
                <h1>Товары</h1>
                <form action="{{ route('admin.addProduct') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="name">Наименование товара</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="description">Описание товара</label>
                        <textarea name="description" id="description" class="form-control" required>{{ old('description') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="price">Цена товара</label>
                        <input type="number" name="price" id="price" class="form-control" value="{{ old('price') }}"
                            required>
                    </div>

                    <div class="form-group  ">
                        <label for="rent_or_buy">Цена аренды</label>
                        <input type="number" name="rent_or_buy" id="rent_or_buy" class="form-control"
                            value="{{ old('rent_or_buy') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="gender">Пол</label>
                        <select name="gender" class="form-control form-category" id="gender" required>
                            <option value="">Выбор</option>
                            <option value="Мужской">Мужской</option>
                            <option value="Женский">Женский</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="category">Категория</label>
                        <select class="form-control" id="category" name="category" required>
                            <option value="">Выберите категорию</option>
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
                            <option value="">Выберите подкатегорию</option>
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
                        <input type="quantity" name="quantity" id="quantity" class="form-control"
                            value="{{ old('quantity') }}" required>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="size">Размер от</label>
                        <input type="number" name="min_size" id="min_size" class="form-control"
                            value="{{ old('size') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="size">Размер до</label>
                        <input type="number" name="max_size" id="max_size" class="form-control"
                            value="{{ old('size') }}" required>
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


                    <div class="form-group">
                        <label for="image">Изображение товара 1</label>
                        <input type="file" name="image" id="image" class="form-control-file" accept="image/*"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="image">Изображение товара 2</label>
                        <input type="file" name="image_2" id="image_2" class="form-control-file" accept="image/*">
                    </div>
                    <div class="form-group">
                        <label for="image">Изображение товара 3</label>
                        <input type="file" name="image_3" id="image_3" class="form-control-file" accept="image/*">
                    </div>
                    <div class="form-group">
                        <label for="image">Изображение товара 4</label>
                        <input type="file" name="image_4" id="image_4" class="form-control-file" accept="image/*">
                    </div>
                    <div class="form-group">
                        <label for="image">Изображение товара 5</label>
                        <input type="file" name="image_5" id="image_5" class="form-control-file" accept="image/*">
                    </div>

                    <button type="submit" class="btn__catalog_in_cart btn btn-success mt-4">Добавить товар</button>
                </form>
            </div>
            <div class="col-md-9 right">
                @foreach ($products as $product)
                    <div class="busket-card row white-bg br-15px mb-4 me-4 w-100">
                        <div class="col-md-6 p-3 cart__left">
                            <img src="/img/{{ $product->image }}" alt="{{ $product->image }}"
                                class="w-100 cart__photo">
                        </div>
                        <div class="col-md-6 p-3 text-black cart__right">
                            <div class="d-flex">
                                <p class="text-30px mt-3 me-auto"><strong>№{{ $product->id }}
                                        {{ $product->name }}</strong></p>
                            </div>
                            <div class="d-flex">
                                <p><strong>{{ $product->rent_or_buy }}</strong></p>
                            </div>
                            <div class="d-flex">
                                <p>{{ $product->description }}</p>
                            </div>
                            <div class="d-flex  ">
                                <p class="cart__price mt-1 mt-2">{{ intval($product->price) }} руб. или {{$product->rent_or_buy}} руб.
                                </p>
                            </div>
                            <div class="d-flex">
                                <p class="cart__price mt-1 mt-2">{{ intval($product->price) }} руб.
                                </p>
                            </div>
                            <div class="quantity">
                                <div class="d-flex quantity_buttons text24px weight700">
                                    Количество : <p class="m-0 ms-3">{{ $product->quantity }} шт.</p>
                                </div>
                            </div>
                            <div class="d-flex mt-4 mb-3">
                                <p class="cart__product__size  mt-2 text24px400">Размер:
                                    <strong
                                        class="text-black ms-3">{{ $product->min_size }}-{{ $product->max_size }}</strong>
                                </p>
                            </div>
                            <div class="btn-group d-flex">
                                <form action="{{ route('admin.deleteProduct', $product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="z-index-1 btn btn-danger"
                                        onclick="return confirm('Вы уверены?')">Удалить</button>
                                </form>
                                <a href="{{ route('admin.editProduct', $product->id) }}"
                                    class="z-index-1 text-white btn btn-primary ms-2">Редактировать</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection