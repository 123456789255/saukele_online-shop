@extends('layouts.app')
@section('content')
    @if (session()->has('profile_password'))
        <div class="error-dialog">
            <span class="error-message">{{ session('profile_password') }}</span>
        </div>
    @endif
    <script>
        @if (session()->has('profile_password'))
            var dialog = document.querySelector('.error-dialog');
            dialog.classList.add('show');
            const displayTime = 5000; // 5 секунд
            // Через заданный интервал времени скрываем диалоговое окно
            setTimeout(() => {
                dialog.classList.remove('show');
            }, displayTime);
        @endif
    </script>
    <section class="index__start_window z-index-1 p-relative">
        <!-- Стартовое окно -->
        <div class="container start-window start-window-height">
            <div class="row">
                <div class="col-md-8">
                    <img src="/img/icons/salta-start.svg" alt="start_img" class="w-100">
                </div>
                <div class="col-md-4">
                    <div class="d-flex flex-column justify-content-between">
                        <h1 class="mt-5 text-white text-36px"><strong>Магазин казахских товаров - для почтения
                                культуры</strong></h1>
                        <ul class="mt-5 text-yellow line_height-150 text-30px start_window_ul_ms">
                            <li class="mt-0">Традиционная и современная одежда</li>
                            <li class="mt-3">Национальные украшения</li>
                            <li class="mt-3">Фотосессии</li>
                            <li class="mt-3">Подарки</li>
                        </ul>
                        <div class="arrow margin-arrow ms-auto p-relative text-white start_window_ul_ms">
                            <a href="/catalog"><img src="img/Arrow.svg" alt=""></a>
                            <a href="/catalog" class="text-white text-white_link text18px uline">
                                <p>Перейти к каталогу</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Слайдер с товарами -->
    <section class="index__catalog_items mt-5 mb-5">
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
    </section>
    {{-- О нас --}}
    <section class="index__about mb-5" id="about">
        <div class="container red-bg">
            <div class="row">
                <div class="col-md-4 left">
                    <h3 class="text-center text-36px mt-4 text-white"><strong>О Саукеле Омск</strong></h3>
                    <p class="ms-3 text-25px mt-4 text-yellow">Национальные наряды (женские и мужские костюмы, детские
                        платья, головные
                        уборы и жилетки) в ПРОКАТ!<br><br>НАЦИОНАЛЬНАЯ фотосессия под ключ Lovestory в казахском
                        стиле.<br><br>Все для казахских обрядов - қырқынан шығару, тұсау кесер, қыз ұзату.<br><br>Здесь вы
                        узнаете о новых поступлениях бижутерии, аксессуаров, казахских сувениров и подарков, всегда
                        заберете свежий номер "Омбы Казактары" и можете оставить заявку на ОТАУ ТВ.</p>
                </div>
                <div class="col-md-8 right p-5 d-flex">
                    <img src="/img/icons/arukiz.svg" alt="" class="ms-auto">
                </div>
            </div>
        </div>
    </section>
    {{-- Партнеры --}}
    <section class="index__partners mb-5">
        <div class="container">
            <h2 class="text-36px ms-5 mb-5">Наши спонсоры</h2>
            <div class="row">
                <div class="col-md-6">
                    <a href="https://podpiska.pochta.ru/press/%D0%9F%D0%A0779"><img src="/img/icons/omby-kazaktar-mini.svg"
                            alt="" class="w-100"></a>
                </div>
                <div class="col-md-6 red-bg">
                    <a href="https://vk.com/kazahi_omska"><img src="/img/icons/KO.svg" alt="" class="w-100"></a>
                </div>
            </div>
        </div>
    </section>
    {{-- Контакты --}}
    <section class="index__contacts mb-5" id="contacts">
        <div class="container">
          <h2 class="text-36px ms-5 mb-1">Контакты</h2>
          <div class="contact_list">
            <a href="https://vk.com/saukele_omsk" class="text-25px text-black text-black_link mt-3">
              <img src="/img/icons/vk-red.svg" alt="" class="me-3">
              <strong id="outputa"></strong>Вконтакте
            </a>
            <a href="https://kazahiomska.wixsite.com/website" class="text-25px text-black text-black_link mt-3">
              <img src="/img/icons/ru.svg" alt="" class="me-3">
              <strong id="outputb"></strong>kazahiomska.ru
            </a>
            <a href="tel:+79088058925" class="text-25px text-black text-black_link mt-3">
              <img src="/img/icons/phone.svg" alt="" class="me-3">
              <strong id="outputc"></strong>+7 (908) 805-89-25
            </a>
            <a href="mailto:kuho007@mail.ru?subject=Вопрос с сайта Saukele-Omsk.ru&body=Здравствуйте, "
              class="text-25px text-black text-black_link mt-3">
              <img src="/img/icons/mail.svg" alt="" class="me-3">
              <strong id="outputd"></strong>kuho007@mail.ru
            </a>
          </div>
        </div>
      </section>


    {{-- Карта --}}
    <section class="index__map mb-5">
        <div class="container map">
            <script type="text/javascript" charset="utf-8" async
                src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Acdea4dad2e0eea5c58974520c7f4d394fa484ca4fa82b2e33c420db8349eda2b&amp;lang=ru_RU&amp;scroll=falce">
            </script>
        </div>
    </section>
@endsection