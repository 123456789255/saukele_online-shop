@extends('layouts.app')
@section('content')
    <div class="container catalog mb-5 pt-5 pb-5 z-index-1">
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
        <h1 class="text-36px ms-5">Каталог товаров</h1>
        <div class="row">
            <div class="col-md-2 left">
                {{-- <button class="btn__catalog_in_cart btn btn-primary catalog__mobile__filter d-md-none" type="button"
                    data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBackdrop" aria-controls="offcanvasWithBackdrop"
                    id="filter_bnt">Фильтр</button> --}}

                {{-- <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasWithBackdrop"
                    aria-labelledby="offcanvasWithBackdropLabel">
                    <div class="offcanvas-header">
                        <h2 class="offcanvas-title" id="offcanvasWithBackdropLabel">Фильтр</h2>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body" class="filter" id="filter"></div>
                </div> --}}



                {{-- <a class="btn__catalog_in_cart btn btn-primary catalog__mobile__filter d-md-none" data-bs-toggle="offcanvas"
                    href="#offcanvasExample" role="button" aria-controls="offcanvasExample" id="filter_bnt">
                    Фильтр
                </a>
                <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample"
                    aria-labelledby="offcanvasExampleLabel">
                    <div class="offcanvas-header">
                        <h2 class="offcanvas-title" id="offcanvasWithBackdropLabel">Фильтр</h2>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body" class="filter" id="filter"></div>
                </div> --}}


                {{-- <div class="filters d-none-mobile" id="desctop_filter"> --}}
                <div class="filters" id="desctop_filter">
                    <form action="{{ route('catalog') }}" method="GET" id="form">
                        <div class="form-group mb-3">
                            <label for="gender">Пол:</label>
                            <select name="gender" class="form-control form-category pointer" id="gender">
                                <option value="" {{ request()->input('gender') == '' ? 'selected' : '' }}>Выбор
                                </option>
                                <option value="Мужской" {{ request()->input('gender') == 'Мужской' ? 'selected' : '' }}>
                                    Мужской</option>
                                <option value="Женский" {{ request()->input('gender') == 'Женский' ? 'selected' : '' }}>
                                    Женский</option>
                                {{-- <option value="Унисекс" {{ request()->input('gender') == 'Унисекс' ? 'selected' : '' }}>
                                    Унисекс</option> --}}
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="category">Категория:</label>
                            <select name="category" class="form-control form-category pointer" id="category">
                                <option value="">Все категории</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" data-gender="{{ $category->id }}"
                                        {{ request()->input('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name_category }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="category">Подкатегория:</label>
                            <select name="subcategory" class="form-control form-category pointer" id="subcategory">
                                <option value="">Все подкатегории</option>
                                @foreach ($subcategories as $subcategory)
                                    <option value="{{ $subcategory->id }}" data-gender="{{ $subcategory->category_id }}"
                                        {{ request()->input('subcategory') == $subcategory->id ? 'selected' : '' }}>
                                        {{ $subcategory->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="size">Размер:</label>
                            <select name="size" class="form-control form-category pointer" id="size">
                                <option value="">Все размеры</option>
                                @foreach ($sizes as $size)
                                    <option value="{{ $size }}"
                                        {{ request()->input('size') == $size ? 'selected' : '' }}>
                                        {{ $size }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex flex-column mb-3">
                            <label>Сортировка:</label>
                            <div class="ms-2 form-check">
                                <input class="form-check-input pointer" type="radio" name="sort_by" id="sort_by_name"
                                    value="name" {{ request()->input('sort_by') == 'name' ? 'checked' : '' }}>
                                <label class="form-check-label" for="sort_by_name">
                                    По наименованию
                                </label>
                            </div>
                            <div class="ms-2 form-check">
                                <input class="form-check-input pointer" type="radio" name="sort_by" id="sort_by_price"
                                    value="price" {{ request()->input('sort_by') == 'price' ? 'checked' : '' }}>
                                <label class="form-check-label" for="sort_by_price">
                                    По цене за покупку
                                </label>
                            </div>
                            <div class="ms-2 form-check">
                                <input class="form-check-input pointer" type="radio" name="sort_by"
                                    id="sort_by_rent_or_buy" value="rent_or_buy"
                                    {{ request()->input('sort_by') == 'rent_or_buy' ? 'checked' : '' }}>
                                <label class="form-check-label" for="sort_by_rent_or_buy">
                                    По цене за аренду
                                </label>
                            </div>
                            <div class="ms-2 form-check">
                                <input class="form-check-input pointer" type="radio" name="sort_by"
                                    id="sort_by_created_at" value="created_at"
                                    {{ request()->input('sort_by') == 'created_at' ? 'checked' : '' }}>
                                <label class="form-check-label" for="sort_by_created_at">
                                    По новизне
                                </label>
                            </div>
                            <label>Сортировка по:</label>
                            <div class="ms-2 form-check">
                                <input class="form-check-input pointer" type="radio" name="sort_direction"
                                    id="sort_direction_asc" value="asc"
                                    {{ request()->input('sort_direction') == 'asc' ? 'checked' : '' }}>
                                <label class="form-check-label" for="sort_direction_asc">
                                    По возрастанию
                                </label>
                            </div>
                            <div class="ms-2 form-check">
                                <input class="form-check-input pointer" type="radio" name="sort_direction"
                                    id="sort_direction_desc" value="desc"
                                    {{ request()->input('sort_direction') == 'desc' ? 'checked' : '' }}>
                                <label class="form-check-label" for="sort_direction_desc">
                                    По убыванию
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn__catalog_in_cart btn btn-primary">Применить</button>
                    </form>
                    <script>
                        // Получаем элементы селекторов
                        var genderSelect = document.getElementById('category');
                        var categorySelect = document.getElementById('subcategory');

                        // Слушаем изменения выбора пола
                        genderSelect.addEventListener('change', function() {
                            var selectedGender = genderSelect.value;

                            // Фильтруем категории на основе выбранного пола
                            for (var i = 0; i < categorySelect.options.length; i++) {
                                var option = categorySelect.options[i];
                                var categoryGender = option.getAttribute('data-gender');

                                if (selectedGender === '' || categoryGender === selectedGender) {
                                    option.style.display = 'block';
                                } else {
                                    option.style.display = 'none';
                                }
                            }
                        });

                        // Инициализируем фильтрацию категорий на основе текущего выбора пола
                        genderSelect.dispatchEvent(new Event('change'));
                    </script>
                </div>
            </div>
            <div class="col-md-10 right">
                <div class="products">
                    @if ($products->isEmpty())
                        <div class="alert alert-danger w-100 m-0" role="alert">
                            <h2 class="m-0 p-0">Товаров по данной категории не найдено.</h2>
                        </div>
                    @else
                        @foreach ($products as $product)
                            @if ($product->quantity == '0')
                                <div class="product flex-column product_quantity_0">
                                    <a href="{{ route('product', $product->id) }}"
                                        class="text-black none-underline product_link p-relative h-100">
                                        <p class="catalog__rent_or_buy quantity_null  z-index-1">Нет в наличии</p>
                                        <img src="/img/{{ $product->image }}" alt="{{ $product->name }}"
                                            class="w-100 h-100">
                                        <h3 class="mt-3 text-red text-center"><strong>{{ $product->name }}</strong>
                                        </h3>
                                        <p class="price w-100 text-center text-25px m-0 p-0">
                                            {{ $product->price }}
                                            руб.<br>{{ $product->rent_or_buy }} руб./сутки.</p>
                                        <button class="btn__catalog_in_cart btn btn-primary w-100 mt-3 text-25px ">Нет
                                            в наличии</button>
                                    </a>
                                </div>
                            @else
                                <div class="product flex-column">
                                    <a href="{{ route('product', $product->id) }}"
                                        class="text-black none-underline product_link p-relative h-100">
                                        <img src="/img/{{ $product->image }}" alt="{{ $product->name }}"
                                            class="w-100 h-100">
                                        <h3 class="mt-3 text-red text-center"><strong>{{ $product->name }}</strong>
                                        </h3>
                                        <p class="price w-100 text-center text-25px m-0 p-0  ">{{ $product->price }}
                                            руб.<br>{{ $product->rent_or_buy }} руб./сутки.</p>
                                        <button
                                            class="btn__catalog_in_cart btn btn-primary w-100 mt-3 text-25px ">Подробнее</button>
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
