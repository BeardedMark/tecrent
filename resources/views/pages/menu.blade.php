@extends('layouts.app')
@section('title', 'Карта сайта')

@section('content')
    <div class="container">
        <div class="fib-section">
            {{-- <div class="row">
                <div class="col">
                    <div class="fib fib-col fib-gap-8 font-center">
                        <h2 class="font-size-1 font-bold">{{ $data['title'] }}</h2>
                        <p class="font-size-5">{{ $data['description'] }}</p>
                    </div>
                </div>
            </div> --}}

            <div class="row">
                <div class="col col-12 col-lg-4 col-xl-6">
                    <h2 class="font-size-2 font-bold">Основное</h2>
                    <ul class="fib fib-col fib-p-21 fib-gap-13">
                        <li class="fib fib-gap-8">
                            <span class="emoji font-size-2">🏠</span>
                            <a href="{{ route('pages.main') }}" class="link fib fib-col">
                                <span>Главная страница</span>
                                <span class="font-size-6 fib-px-8">краткая презентация того, что тут можно найти</span>
                            </a>
                        </li>

                        <li class="fib fib-gap-8">
                            <span class="emoji font-size-2">📜</span><a href="{{ route('pages.about') }}"
                                class="link fib fib-col">
                                <span>О нас и проекте</span>
                                <span class="font-size-6 fib-px-8">подробная информация о том, что тут происходит</span>
                            </a>
                        </li>

                        <li class="fib fib-gap-8">
                            <span class="emoji font-size-2">📝</span><a href="{{ route('pages.work') }}" class="link fib fib-col">
                                <span>Как мы работаем</span>
                                <span class="font-size-6 fib-px-8">акции, правила и условия которые по которым мы
                                    работаем</span>
                            </a>
                        </li>

                        <li class="fib fib-gap-8">
                            <span class="emoji font-size-2">🎮</span><a href="{{ route('pages.contacts') }}"
                                class="link fib fib-col">
                                <span>Для геймеров</span>
                                <span class="font-size-6 fib-px-8">обеспечим хорошим железом для качественной игры</span>
                            </a>
                        </li>

                        <li class="fib fib-gap-8">
                            <span class="emoji font-size-2">🖨️</span><a href="{{ route('pages.contacts') }}"
                                class="link fib fib-col">
                                <span>Для бизнеса</span>
                                <span class="font-size-6 fib-px-8">снабдим необходимой техникой для начала работы</span>
                            </a>
                        </li>

                        <li class="fib fib-gap-8">
                            <span class="emoji font-size-2">📞</span><a href="{{ route('pages.contacts') }}"
                                class="link fib fib-col">
                                <span>Контакты</span>
                                <span class="font-size-6 fib-px-8">контактные данные для удобной связи с нами</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="col col-12 col-lg-4 col-xl-6">
                    <h2 class="font-size-2 font-bold">Услуги</h2>
                    <ul class="fib fib-col fib-p-21 fib-gap-13">
                        <li class="fib fib-gap-8">
                            <span class="emoji font-size-2">🖥️</span>
                            <a href="{{ route('computers.index') }}" class="link fib fib-col">
                                <span>Аренда компьютеров</span>
                                <span class="font-size-6 fib-px-8">аренда компьютеров для временного использования</span>
                            </a>
                        </li>

                        <li class="fib fib-gap-8">
                            <span class="emoji font-size-2">🗄️</span>
                            <a href="{{ route('pages.servers') }}" class="link fib fib-col">
                                <span>Аренда серверов</span>
                                <span class="font-size-6 fib-px-8">возможность хостить игровые сервера или хранить
                                    файлы</span>
                            </a>
                        </li>

                        <li class="fib fib-gap-8">
                            <span class="emoji font-size-2">🧩</span>
                            <a href="{{ route('pages.assembly') }}" class="link fib fib-col">
                                <span>Сборка компьютера</span>
                                <span class="font-size-6 fib-px-8">услуга по сборке персонального компьютера по
                                    требованиям</span>
                            </a>
                        </li>

                        <li class="fib fib-gap-8 lock">
                            <span class="emoji font-size-2">📦</span>
                            <a href="#" class="link fib fib-col">
                                <span>Каталог товаров<span class="font-size-6 fib-px-8">(скоро)</span></span>
                                <span class="font-size-6 fib-px-8">полный список товаров в нашем ассортименте</span>

                            </a>
                        </li>
                    </ul>
                </div>

                <div class="col col-12 col-lg-4 col-xl-6">
                    <h2 class="font-size-2 font-bold">Полезное</h2>
                    <ul class="fib fib-col fib-p-21 fib-gap-13">
                        <li class="fib fib-gap-8">
                            <span class="emoji font-size-2">👾</span>
                            <a href="{{ route('games.index') }}" class="link fib fib-col">
                                <span>Игровые системные требования</span>
                                <span class="font-size-6 fib-px-8">информация о характеристиках компьютера
                                    для игр</span>
                            </a>
                        </li>

                        <li class="fib fib-gap-8 lock">
                            <span class="emoji font-size-2">📰</span>
                            <a href="#" class="link fib fib-col">
                                <span>Статьи нашего блога<span class="font-size-6 fib-px-8">(скоро)</span></span>
                                <span class="font-size-6 fib-px-8">полезная и интересная информация для
                                    посетителей</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="col col-12 col-lg-4 col-xl-6">
                    <h2 class="font-size-2 font-bold">Персональное</h2>
                    <ul class="fib fib-col fib-p-21 fib-gap-13">
                        <li class="fib fib-gap-8">
                            <span class="emoji font-size-2">🛒</span>
                            <a href="{{ route('basket.index') }}" class="link fib fib-col">
                                <span>Корзина заказов</span>
                                <span class="font-size-6 fib-px-8">список выбранных товаров для покупки</span>
                            </a>
                        </li>

                        <li class="fib fib-gap-8 lock">
                            <span class="emoji font-size-2">🔐</span>
                            <a href="{{ route('auth.login') }}" class="link fib fib-col">
                                <span>Личный кабинет<span class="font-size-6 fib-px-8">(скоро)</span></span>
                                <span class="font-size-6 fib-px-8">доступ к персональным данным и настройкам
                                    аккаунта</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <section class="bg-main">
        <div class="container">
            <div class="fib-section font-center">
                <div class="row justify-content-center">
                    <div class="col col-lg-6">
                        <div class="fib fib-col fib-gap-8">
                            <p class="font-size-4">{{ $data->content }}</p>

                            {{-- <div class="pos bg-contrast">
                                <p class="fib-p-13 bg-accent pos-w-min">sda</p>
                                <p class="fib-p-13 bg-accent">sda</p>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <section class="">
        <div class="container">
            <div class="fib-section font-center">
                <div class="row justify-content-center">
                    <div class="col col-lg-6">
                        <div class="fib fib-col fib-gap-8 fib-center">
                            <img width="256px"
                                src="https://sun4-22.userapi.com/j6ZJzdzWX0H4pKiqqEhefBAxy8Af0RkgZSYc1w/YOapcHrfOxY.png"
                                alt="">
                            <p class="font-size-large">О, Привет!</p>
                            <p class="font-size-2">Я очень рад что ты посетил мой сайт!<br>Надеюсь что он тебе понравится, а
                                информация на нем тебя заинтересует)<br>Удачи в исследовании!</p>

                            {{-- <button onclick="playSound()">Поздороваться</button>
                            <audio id="audio" src="{{ asset('o-privet.mp3') }}" muted></audio>

                            <script>
                                function playSound() {
                                    var audio = document.getElementById('audio');
                                    audio.muted = false; // Убираем блокировку звука
                                    audio.play();
                                }
                            </script> --}}
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
