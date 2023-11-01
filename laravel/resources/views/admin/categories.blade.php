@extends('layouts.admin')

@section('content')
    <div class="container admin__category z-index-1 pt-3 pb-1">
        <div class="row cart__items">
            <div class="col-md-4 left">
                <h1 class="mb-3 text-30px">Добавить Категорию</h1>
                <form action="{{ route('admin.addCategory') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="text-25px" for="name">Название категории:</label>
                        <input type="text" name="name" id="name" class="form-control mb-2 text-25px">
                    </div>
                    <button type="submit" class="btn btn-primary text-25px mt-3">Добавить</button>
                </form>
            </div>
            <div class="col-md-7 right ms-5">
                @foreach ($categories as $category)
                    <div class="p-3 busket-card row white-bg br-15px mb-4 me-4 w-100">
                        <div class="d-flex justify-content-">
                            <p class="text-25px me-3 mt-3 w-100"><strong>№{{ $category->id }}</strong>
                            <label for="category_name{{ $category->id }}"
                                class="text-25px text24px400 mt-3 name__category">Название категории: </label></p>
                        </div>
                        <div class="d-md-flex">
                            <form method="post" action="{{ route('admin.updateCategories', $category->id) }}"
                                enctype="multipart/form-data" class="d-flex subcategory__form">
                                @csrf
                                @method('PUT')

                                <div class="form-group w-100">
                                    <input type="text" class="form-control mb-2 text-30px"
                                        id="category_name{{ $category->id }}" name="category_name{{ $category->id }}"
                                        value="{{ $category->name_category }}">
                                </div>


                                <div class="d-flex align-center flex_mobile ms-md-1 ms-1">
                                    <button type="submit" class="btn btn-primary text-25px">Изменить</button>
                                </div>
                            </form>
                            <div class="d-md-flex align-center flex_mobile ms-1 h-auto d-none">
                                <form action="{{ route('admin.deleteCategories', ['id' => $category->id]) }}" method="POST"
                                    style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger text-25px"
                                        onclick="return confirm('Вы уверены?')">Удалить</button>
                                </form>
                            </div>
                            <div class="d-md-none d-flex w-100 justify-content-end category__mobile__remove">
                                <form action="{{ route('admin.deleteCategories', ['id' => $category->id]) }}" method="POST"
                                    style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger text-25px"
                                        onclick="return confirm('Вы уверены?')">Удалить</button>
                                </form>
                            </div>
                        </div>
                        <p class="mt-4 text-25px">Подкатегории:</p>
                        @foreach ($subcategories as $sub)
                            @if ($sub->category_id == $category->id)
                                <div class="d-md-flex w-100 mb-2">
                                    <div class="d-flex align-center">
                                        <p class="me-3 m-0"><strong>№{{ $sub->id }}</strong>
                                        <label for="edit_subcategory_name{{ $sub->id }}">Название
                                            подкатегории</label></p>
                                    </div>
                                    <div class="d-md-flex">
                                        <form method="post" action="{{ route('admin.updateSubcategory', $sub->id) }}"
                                            enctype="multipart/form-data" class="d-flex w-100 subcategory__form">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group d-flex w-100">
                                                <input type="text" class="form-control mb-2"
                                                    id="edit_subcategory_name{{ $sub->id }}"
                                                    name="edit_subcategory_name{{ $sub->id }}"
                                                    value="{{ $sub->name }}">
                                            </div>
                                            <div class="d-flex align-center flex_mobile ms-md-1 ms-1">
                                                <button type="submit" class="btn btn-primary text-25px">Изменить</button>
                                            </div>
                                        </form>
                                        <div class="d-md-flex align-center flex_mobile ms-1 d-none">
                                            <form action="{{ route('admin.deleteSubcategories', ['id' => $sub->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger text-25px"
                                                    onclick="return confirm('Вы уверены?')">Удалить</button>
                                            </form>
                                        </div>
                                        <div class="d-md-none d-flex w-100 justify-content-end subcategory__mobile__remove">
                                            <form action="{{ route('admin.deleteSubcategories', ['id' => $sub->id]) }}" method="POST"
                                                style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger text-25px"
                                                    onclick="return confirm('Вы уверены?')">Удалить</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        <form action="{{ route('admin.addSubcategory') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label class="text-25px" for="subcategory_name{{ $category->id }}">Добавить подкатегорию:</label>
                                <input type="text" name="subcategory_name{{ $category->id }}"
                                    id="subcategory_name{{ $category->id }}" class="form-control mb-2 text-25px">
                                <input type="text" name="sub_cat" id="sub_cat"
                                    class="form-control mb-2 text-25px d-none" value="{{ $category->id }}">
                            </div>
                            <button type="submit" class="btn btn-primary text-25px mt-1">Добавить</button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection