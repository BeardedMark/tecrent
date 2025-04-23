@extends('layouts.app')

@section('title', 'Каталог техники в аренду и услуг — Tecrent')
@section('description', 'Компьютеры, оборудование и услуги — всё в одном месте. Выберите подходящее предложение для бизнеса, игр или дома')
@section('keywords', 'аренда техники, оборудование, услуги, Tecrent, каталог, компьютеры, аренда компьютеров')

@push('toolbar')
    <a class="hover-link" href="{{ route('offers.create') }}">Добавить</a>
@endpush

@section('content')
    <section>
        <div class="container">
            <div class="fib-section">
                <div class="row justify-content-center">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <h2 class="font-size-1 font-bold">Наши рекомендации</h2>
                            <p class="font-size-5">Компьютеры, приставки и другая техника</p>
                        </div>
                    </div>
                </div>

                @component('offers.components.list', ['offers' => $favorites])
                @endcomponent
            </div>
    </section>

    <section class="bg-main">
        <div class="container">
            <div class="fib-section">
                <div class="row justify-content-center align-items-center g-4">
                    @isset($main)
                        <div class="col col-12 col-md-8 col-lg-6 col-xl-4">
                            @component('offers.components.card', ['offer' => $main])
                            @endcomponent
                        </div>

                        <div class="col col-12 col-xl-6">
                            <section>
                                <div class="container">
                                    <div class="fib-section">
                                        <div class="row justify-content-center">
                                            <div class="col">
                                                <div class="fib fib-col fib-gap-8 fib-center font-center">
                                                    <h2 class="font-size-2 font-bold">Главное предложение</h2>
                                                    <p class="font-size-5">Наше главное предложение на текущий момент</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row justify-content-center">
                                            <div class="col">
                                                <div class="fib fib-col fib-gap-8 fib-center font-center">
                                                    <p class="font-size-3 font-bold">{{ $main->description }}</p>
                                                    <p class="font-size-4">{{ $main->content }}</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row justify-content-center">
                                            <div class="col col-auto">
                                                <a class="fib-button hover-accent"
                                                    href="{{ route('offers.show', $main) }}">Подробнее</a>
                                            </div>
                                        </div>
                                    </div>
                            </section>
                        </div>
                    @endisset
                </div>
            </div>
    </section>
    <section>
        <div class="container">
            <div class="fib-section">
                <div class="row justify-content-center">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <h2 class="font-size-2 font-bold">Аренда оборудования</h2>
                            <p class="font-size-5">Компьютеры, приставки и другая техника</p>
                        </div>
                    </div>
                </div>

                @component('offers.components.list', ['offers' => $rent])
                @endcomponent

                <div class="row justify-content-center">
                    <div class="col col-auto">
                        <a class="fib-button hover-main" href="{{ route('offers.search', ['type' => 'Аренда']) }}">Все
                            предложения
                            аренды</a>
                    </div>
                </div>
            </div>
    </section>

    <section class="pos-relative bg-accent">
        <img class="pos-absolute pos-wallpaper"
            src="https://kartinki.pics/uploads/posts/2021-07/1626265042_5-kartinkin-com-p-fon-skidki-krasivo-6.jpg"
            alt="">
        <div class="pos-absolute pos-overlay bg-accent"></div>
        <div class="container">
            <div class="fib-section">
                <div class="row justify-content-center">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center color-main">
                            <h2 class="font-size-2 font-bold">Выгодные предложения</h2>
                            <p class="font-size-5">Предложения со скидками</p>
                        </div>
                    </div>
                </div>

                @component('offers.components.list', ['offers' => $sales])
                @endcomponent
            </div>
    </section>

    <section>
        <div class="container">
            <div class="fib-section">
                <div class="row justify-content-center">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <h2 class="font-size-2 font-bold">Товары</h2>
                            <p class="font-size-5">Список всех наших товаров и услуг</p>
                        </div>
                    </div>
                </div>

                @component('offers.components.list', ['offers' => $trade])
                @endcomponent

                <div class="row justify-content-center">
                    <div class="col col-auto">
                        <a class="fib-button hover-main" href="{{ route('offers.search', ['type' => 'Товары']) }}">Весь
                            каталог
                            товаров</a>
                    </div>
                </div>
            </div>
    </section>

    <section class="bg-main">
        <div class="container">
            <div class="fib-section">
                <div class="row justify-content-center">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <h2 class="font-size-2 font-bold">Услуги</h2>
                            <p class="font-size-5">Список всех наших товаров и услуг</p>
                        </div>
                    </div>
                </div>

                @component('offers.components.list', ['offers' => $service])
                @endcomponent

                <div class="row justify-content-center">
                    <div class="col col-auto">
                        <a class="fib-button hover-second" href="{{ route('offers.search', ['type' => 'Услуги']) }}">Полный
                            прайс
                            услуг</a>
                    </div>
                </div>
            </div>
    </section>

    <section>
        <div class="container">
            <div class="fib-section">
                <div class="row justify-content-center">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <h2 class="font-size-2 font-bold">Случайные предложения</h2>
                            <p class="font-size-5">Возможно что-то из этого вам пригоится</p>
                        </div>
                    </div>
                </div>

                @component('offers.components.list', ['offers' => $offers])
                @endcomponent

                <div class="row justify-content-center">
                    <div class="col col-auto">
                        <a class="fib-button hover-contrast" href="{{ route('offers.search') }}">Все предложения</a>
                    </div>
                </div>
            </div>
    </section>
@endsection
