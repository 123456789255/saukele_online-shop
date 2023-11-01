@extends('layouts.admin')
@section('content')
    <div class="container admin__category z-index-1 pb-1 pt-3">
        <h1 class="mb-3 text-30px">Все пользователи</h1>
        @if (session('success'))
            <div class="alert alert-success">Пользователь удален!</div>
        @endif
        <script>
            @if (session()->has('success'))
                var dialog = document.querySelector('.alert-success');
                dialog.classList.add('show');
                const displayTime = 3000; // 5 секунд
                // Через заданный интервал времени скрываем диалоговое окно
                setTimeout(() => {
                    dialog.classList.remove('show');
                }, displayTime);
            @endif
        </script>
        @foreach ($users as $user)
            <div class="users">
                <p>ID: {{ $user->id }}</p>
                <p>ФИО: <strong>{{ $user->surname }} {{ $user->name }} {{ $user->patronymic }}</strong></p>
                <p>Логин: {{ $user->login }}</p>
                <p>E-mail: {{ $user->email }}</p>
                <div class="">
                    <p>Роль:</p>
                    <form class="d-flex mobile_d-block ms-3" method="post" action="{{ route('admin.updateUser', $user->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <select name="role" class="form-control form-category col-md-2" id="role">
                            @if ($user->role == '2')
                                <option value="2">Администратор</option>
                                <option value="1">Пользователь</option>
                            @else
                                <option value="1">Пользователь</option>
                                <option value="2">Администратор</option>
                            @endif

                        </select>

                        <button type="submit" class="btn btn-primary col-md-2 desktop-ms-5 mobile-mt-3">Сохранить</button>
                    </form>
                </div>
                {{-- <form action="{{ route('admin.deleteUser', $id = $user->id) }}" method="POST" class="mt-3">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"
                        onclick="return confirm('Вы уверены?')" id="delete_user">Удалить</button>
                </form> --}}
            </div>
        @endforeach
    </div>
@endsection