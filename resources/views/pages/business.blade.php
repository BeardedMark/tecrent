@extends('layouts.app')
@section('title', $data->title)
@section('description', $data->description)

@section('content')
    {{-- Вступление --}}
    {{-- 3 --}}

    <section class="pos-relative">
        <img class="pos-absolute pos-wallpaper"
            src="https://www.scientific-computing.com/sites/default/files/content/product-focus/lead-image/Kreabobek%20shutterstock_1089987059.jpg"
            alt="">
        <div class="pos-absolute pos-overlay bg-black"></div>

        <div class="container">
            <div class="fib-section">
                <div class="row justify-content-center">
                    <div class="col col-12 col-lg-6">
                        <div class="fib fib-col fib-gap-8 fib-center font-center color-main">
                            <h1 class="font-size-1 font-bold">{{ $data->title }}</h1>
                            <p class="font-size-5">{{ $data->description }}</p>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col col-auto">
                        <div class="fib">
                            <a class="fib-button hover-contrast" href="#requests">Запросы</a>
                            <a class="fib-button hover-contrast" href="#games">Под игру</a>
                            <a class="fib-button hover-contrast" href="#computers">Готовые сборки</a>
                            <a class="fib-button hover-accent" href="#form">Заказать сборку</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Подробности --}}
    {{-- 2 --}}

    <section>
        <div class="container">
            <div class="fib-section">
                <div class="row g-4">
                    @foreach ($data->functions as $func)
                        <div class="col col-12 col-lg-3">
                            <div class="fib fib-col fib-p-21 fib-gap-8 fib-x-center pos-h-100 font-center frame bg-main">
                                <h3 class="font-size-1 color-accent emoji">{{ $func->title }}</h3>
                                <p class="font-size-4">{{ $func->description }}</p>
                                <p class="font-size-5">{{ $func->content }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    
    {{-- Преимущества --}}
    {{-- 2 --}}

    <section id="requests" class="bg-main">
        <div class="container">
            <div class="fib-section">
                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <h2 class="font-size-1 font-bold">Популярные запросы</h2>
                            <p class="font-size-5">Самые частые пожелания которые к нам поступают</p>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center gy-4">
                    <div class="col col-6 col-lg-3">
                        <div class="fib fib-col fib-p-21 fib-gap-8 fib-center hover font-center pos-h-100">
                            <p class="font-size-1 emoji">🎚️</p>
                            {{-- <p class="font-size-3 color-accent">Круглосуточная работа</p> --}}
                            <p class="font-size-4">Под системные требования любимой игры</p>
                        </div>
                    </div>
                    
                    <div class="col col-6 col-lg-3">
                        <div class="fib fib-col fib-p-21 fib-gap-8 fib-center hover font-center pos-h-100">
                            <p class="font-size-1 emoji">💰</p>
                            {{-- <p class="font-size-3 color-accent">Масштабируемость</p> --}}
                            <p class="font-size-5">Максимальную мощность в рамках бюджета</p>
                        </div>
                    </div>
                    
                    <div class="col col-6 col-lg-3">
                        <div class="fib fib-col fib-p-21 fib-gap-8 fib-center hover font-center pos-h-100">
                            <p class="font-size-1 emoji">📟</p>
                            {{-- <p class="font-size-3 color-accent">Резервные копии</p> --}}
                            <p class="font-size-5">Сборка для офисных программ и браузера</p>
                        </div>
                    </div>
                    
                    <div class="col col-6 col-lg-3">
                        <div class="fib fib-col fib-p-21 fib-gap-8 fib-center hover font-center pos-h-100">
                            <p class="font-size-1 emoji">🆙</p>
                            {{-- <p class="font-size-3 color-accent">Безопасность</p> --}}
                            <p class="font-size-5">Апгрейд и модернизация имеющейся сборки</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Срок --}}
    {{-- 1 --}}

    <section id="period" class="pos-relative">
        <img class="pos-absolute pos-wallpaper"
            src="https://moon.kz/upload/iblock/af1/0m4xrabqqcnjytw5cxcoxjvqedv8e5gc.jpg" alt="">
        <div class="pos-absolute pos-overlay bg-dark"></div>

        <div class="container">
            <div class="fib-section">
                <div class="row justify-content-center">
                    <div class="col col-12 col-lg-6">
                        <div class="fib fib-col fib-gap-8 fib-center font-center color-main">
                            <p class="font-size-1 font-bold">Акцент на качестве</p>
                            <h2 class="font-size-3">Предлагаем только проверенные комплектующие</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    {{-- Игры --}}
    {{-- 1 --}}
    
    <section id="games" class="bg-main">
        <div class="container">
            <div class="fib-section">
                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <h2 class="font-size-1 font-bold">Сборка ПК под игру</h2>
                            <p class="font-size-5">Подобрать компьютер по системным требованиям игры</p>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center g-4">
                    @foreach ($games as $game)
                        <div class="col col-6 col-md-6 col-lg-4 col-xl-3">
                            @component('games.components.card', ['game' => $game])
                            @endcomponent

                            <p class="font-size-6 font-center fib-p-21">Сборка компьютера для {{ $game->getTitle() }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- Портфолио --}}
    {{-- 2 --}}

    <section id="computers">
        <div class="container">
            <div class="fib-section">
                <div class="row justify-content-center">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <h2 class="font-size-1 font-bold">Портфолио наших сборок</h2>
                            <p class="font-size-5">Все сборки в нашем каталоге аренды собраны нами</p>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center g-4">
                    @foreach ($computers as $computer)
                        <div class="col col-6 col-md-6 col-lg-4 col-xl-3">
                            @component('computers.components.card', ['computer' => $computer])
                            @endcomponent
                        </div>
                    @endforeach
                </div>

                <div class="row justify-content-center">
                    <div class="col col-auto">
                        <a class="fib-button hover-accent" href="{{ route('computers.index') }}">Все сборки »</a>
                    </div>
                </div>
            </div>
    </section>

    {{-- Контент --}}
    {{-- 3 --}}

    <section class="bg-main">
        <div class="container">
            <div class="fib-section">
                <div class="row justify-content-center">
                    <div class="col col-12 col-lg-6">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <p class="font-size-4">{{ $data->content }}</p>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    {{-- Форма --}}
    {{-- 2 --}}

    <section id="form">
        <div class="container">
            <form method="POST" action="{{ route('send.discord', ['subject' => 'Заявка на сборку компьютера']) }}"
                class="fib-section">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <h2 class="font-size-1 font-bold">Заявка на подбор</h2>
                            <p class="font-size-5">Эти данные нужны для анализа и связи</p>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col col-12 col-md-10 col-lg-8 col-xl-6">
                        <div class="fib fib-col fib-gap-8 font-center">
                            <input class="fib fib-p-13 bord-second bg-main font-center" type="text" name="name"
                                id="name" placeholder="ваше имя" value="{{ old('name') }}" required>
                            <input class="fib fib-p-13 bord-second bg-main font-center" type="text" name="phone"
                                id="phone" placeholder="контактный телефон" value="{{ old('phone') }}" required>
                            <input class="fib fib-p-13 bord-second bg-main font-center" type="email" name="email"
                                id="email" placeholder="электронная почта" value="{{ old('email') }}" required>
                            <input class="fib fib-p-13 bord-second bg-main font-center" type="number" name="money"
                                id="money" placeholder="ваш бюджет" value="{{ old('email') }}" required>
                            <textarea class="fib fib-p-13 bord-second bg-main font-center" type="text" name="message" id="message"
                                placeholder="опишите свою потребность" rows="4"></textarea>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col col-12 col-md-10 col-lg-8 col-xl-6">
                        <div class="fib fib-gap-8 fib-center font-center">
                            <button class="fib-button hover-accent" type="submit">Оформить</button>
                        </div>
                    </div>
                </div>

            </form>
    </section>
@endsection
