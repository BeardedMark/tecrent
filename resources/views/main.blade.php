@php
    $content = json_decode(file_get_contents(storage_path('content/main.json')), true);
@endphp

@extends('layouts.app')
@section('title', $content['title'] . ' : ' . $content['description'])
@section('desctiption', $content['description'])

@section('content')

    {{-- Вступление --}}

    <section class="pos-relative overflow-hidden">

        <video class="pos-absolute pos-wallpaper" autoplay muted loop>
            <source src="{{ asset('video/cinematic.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>

        <div class="pos-absolute pos-overlay bg-black"></div>


        <div class="container">
            <div class="fib-section">
                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center color-main">
                            <p class="font-size-large font-bold"><span class="color-accent">TEC</span>RENT</p>
                            <h1 class="font-size-4">{{ $content['description'] }}</h1>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col col-auto">
                        <a class="fib-button hover-accent" href="{{ route('computers.index') }}">Каталог »</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Обеспечиваем сервис --}}

    <section>
        <div class="container">
            <div class="fib-section">
                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <h2 class="font-size-1 font-bold">{{ $content['sections']['service']['title'] }}</h2>
                            <p class="font-size-5">{{ $content['sections']['service']['description'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center g-4">
                    @foreach ($content['sections']['service']['content'] as $func)
                        <div class="col col-6 col-lg-3">
                            <div class="fib fib-col fib-p-21 fib-gap-8 fib-center frame font-center bg-main pos-h-100">
                                <p class="font-size-1 emoji">{{ $func['icon'] }}</p>
                                <p class="font-size-2 color-accent">{{ $func['title'] }}</p>
                                <p class="font-size-5">{{ $func['description'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="row justify-content-center">
                    <div class="col col-auto">
                        <a class="fib-button hover-contrast" href="{{ route('work') }}">О компании »</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Для геймеров --}}

    <section class="pos-relative">
        <img class="pos-absolute pos-wallpaper"
            src="https://media.wired.com/photos/627da1085d49787abdf713b4/master/w_2560%2Cc_limit/Pakistani-Gamers-Want-a-Seat-at-the-Table-Culture-shutterstock_1949862841.jpg"
            alt="">
        <div class="pos-absolute pos-overlay bg-black"></div>

        <div class="container">
            <div class="fib-section">
                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center color-main">
                            <h2 class="font-size-1 font-bold">{{ $content['sections']['game']['title'] }}</h2>
                            <p class="font-size-5">{{ $content['sections']['game']['description'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center g-4">
                    @foreach ($content['sections']['game']['content'] as $func)
                        <div class="col col-6 col-lg-3">
                            <div class="fib fib-col fib-p-21 fib-gap-8 fib-center font-center hover-contrast pos-h-10">
                                <p class="font-size-1 emoji color-accent">{{ $func['icon'] }}</p>
                                <p class="font-size-2">{{ $func['title'] }}</p>
                                <p class="font-size-5">{{ $func['description'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="row justify-content-center">
                    <div class="col col-auto">
                        <a class="fib-button hover-accent" href="{{ route('computers.index') }}">Игровые сборки »</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Для бизнеса --}}

    <section class="pos-relative">
        <img class="pos-absolute pos-wallpaper"
            src="https://www.hdwallpapers.in/download/apple_laptop_on_white_table_hd_macbook-HD.jpg" alt="">
        <div class="pos-absolute pos-overlay bg-main"></div>

        <div class="container">
            <div class="fib-section">
                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <h2 class="font-size-1 font-bold">{{ $content['sections']['work']['title'] }}</h2>
                            <p class="font-size-5">{{ $content['sections']['work']['description'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center g-4">
                    @foreach ($content['sections']['work']['content'] as $func)
                        <div class="col col-6 col-lg-3">
                            <div
                                class="fib fib-col fib-p-21 fib-gap-8 fib-center font-center hover bg-main bord-second pos-h-100">
                                <p class="font-size-1 emoji color-accent">{{ $func['icon'] }}</p>
                                <p class="font-size-2">{{ $func['title'] }}</p>
                                <p class="font-size-5">{{ $func['description'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="row justify-content-center">
                    <div class="col col-auto">
                        <a class="fib-button hover-accent" href="{{ route('computers.index') }}">Сборки для работы »</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Призыв --}}

    <section class="bg-main">
        <div class="container">
            <div class="fib-section">
                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <h2 class="font-size-1 font-bold">{{ $content['sections']['statistic']['title'] }}</h2>
                            <p class="font-size-5">{{ $content['sections']['statistic']['description'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center g-4">
                    @foreach ($content['sections']['statistic']['content'] as $func)
                        <div class="col col-6 col-lg-3">
                            <div class="fib fib-col fib-p-21 fib-gap-8 fib-center hover font-center pos-h-100">
                                <p class="font-size-large color-accent">{{ $func['count'] }}</p>
                                <p class="font-size-5">{{ $func['description'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- <div class="row justify-content-center">
                    <div class="col col-auto">
                        <a class="fib-button hover-second" href="{{ route('computers.index') }}">Каталог предложений »</a>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>

    {{-- Выгодные условия --}}

    <section>
        <div class="container">
            <div class="fib-section">
                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <h2 class="font-size-1 font-bold">{{ $content['sections']['promo']['title'] }}</h2>
                            <p class="font-size-5">{{ $content['sections']['promo']['description'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center g-4">
                    @foreach ($content['sections']['promo']['content'] as $func)
                        <div class="col col-6 col-lg-4">
                            <div class="fib fib-col fib-p-21 fib-gap-8 fib-center frame font-center bg-main pos-h-100">
                                <p class="font-size-1 font-bold color-accent">{{ $func['title'] }}</p>
                                <p class="font-size-5">{{ $func['description'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- <div class="row justify-content-center">
                    <div class="col col-auto">
                        <a class="fib-button hover-contrast" href="{{ route('contacts') }}">Все акции »</a>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>

    {{-- Отзывы --}}

    <section class="bg-main">
        <div class="container">
            <div class="fib-section">
                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <h2 class="font-size-1 font-bold">{{ $content['sections']['feedback']['title'] }}</h2>
                            <p class="font-size-5">{{ $content['sections']['feedback']['description'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center gy-4">
                    @foreach ($content['sections']['feedback']['content'] as $func)
                        <div class="col col-6 col-lg-3">
                            <div class="fib fib-col fib-p-21 fib-gap-8 fib-center frame font-center pos-h-100">
                                <p class="font-size-large emoji">{{ $func['icon'] }}</p>
                                <p class="font-size-3 color-accent">{{ $func['name'] }}</p>
                                <p class="font-size-5">{{ $func['commentary'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- <div class="row justify-content-center">
                    <div class="col col-auto">
                        <a class="fib-button hover-contrast" href="{{ route('work') }}">Все отзывы »</a>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>

    {{-- Наши преимущества --}}

    <section>
        <div class="container">
            <div class="fib-section">
                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <h2 class="font-size-1 font-bold">{{ $content['sections']['feature']['title'] }}</h2>
                            <p class="font-size-5">{{ $content['sections']['feature']['description'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center g-4">
                    @foreach ($content['sections']['feature']['content'] as $func)
                        <div class="col col-6 col-lg-3">
                            <div class="fib fib-col fib-p-21 fib-gap-8 fib-center frame font-center bord-second pos-h-100">
                                <p class="font-size-1 emoji">{{ $func['icon'] }}</p>
                                <p class="font-size-2 color-accent">{{ $func['title'] }}</p>
                                <p class="font-size-5">{{ $func['description'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="row justify-content-center">
                    <div class="col col-auto">
                        <a class="fib-button hover-contrast" href="{{ route('work') }}">Как мы работаем »</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Города --}}

    <section class="pos-relative">
        <img class="pos-absolute pos-wallpaper"
            src="https://www.custom-wallpaper-printing.co.uk/custom/catalog/map/world-map-shutterstock_665429155.jpg"
            alt="">
        <div class="pos-absolute pos-overlay bg-accent"></div>

        <div class="container">
            <div class="fib-section">
                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center color-main">
                            <div class="row justify-content-center g-3">
                                @foreach ($content['sections']['citys']['open'] as $city)
                                    <div class="col col-auto">
                                        <p class="font-size-1 font-bold">{{ $city }}</p>
                                    </div>
                                @endforeach
                            </div>

                            <p class="font-size-5">{{ $content['sections']['citys']['description'] }}</p>

                            <div class="row justify-content-center g-3">
                                @foreach ($content['sections']['citys']['close'] as $city)
                                    <div class="col col-auto">
                                        <p class="font-size-2 font-bold">{{ $city }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col col-auto">
                        <a class="fib-button hover-second" href="{{ route('contacts') }}">Наши контакты »</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Частые вопросы --}}

    <section>
        <div class="container">
            <div class="fib-section">
                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <h2 class="font-size-1 font-bold">{{ $content['sections']['faq']['title'] }}</h2>
                            <p class="font-size-5">{{ $content['sections']['faq']['description'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center g-4">
                    @foreach ($content['sections']['faq']['content'] as $question)
                        <div class="col col-12 col-lg-4">
                            <div
                                class="fib fib-col fib-p-21 fib-gap-8 fib-center pos-h-100 hover-second bord-second font-center">
                                <p class="font-size-3">{{ $question['question'] }}</p>
                                <p class="font-size-4">{{ $question['answer'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="row justify-content-center">
                    <div class="col col-auto">
                        <a class="fib-button hover-contrast" href="{{ route('chat') }}">Написать в чат
                            »</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
