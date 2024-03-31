@extends('layouts.app')
@section('title', $title . ' : ' . $description)
@section('desctiption', $description)

@section('content')

    {{-- Вступление --}}

    <section class="pos-relative overflow-hidden">
        <video class="pos-absolute pos-wallpaper" autoplay muted loop>
            <source src="{{ asset('video/cinematic.mp4') }}" type="video/mp4">
        </video>
        <div class="pos-absolute pos-overlay bg-black"></div>

        <div class="container">
            <div class="fib-section">
                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-center font-center color-main">
                            <p class="font-size-large font-bold">
                                <span class="color-accent">TEC</span>RENT
                            </p>

                            <h1 class="font-size-4">{{ $description }}</h1>
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
                            <h2 class="font-size-1 font-bold">{{ $data->sections->service->title }}</h2>
                            <p class="font-size-5">{{ $data->sections->service->description }}</p>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center g-4">
                    @foreach ($data->sections->service->content as $func)
                        <div class="col col-6 col-lg-3">
                            <div class="fib fib-col fib-p-21 fib-gap-8 fib-center frame font-center bg-main pos-h-100">
                                <p class="font-size-1 emoji">{{ $func->icon }}</p>
                                <p class="font-size-2 color-accent">{{ $func->title }}</p>
                                <p class="font-size-5">{{ $func->description }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="row justify-content-center">
                    <div class="col col-auto">
                        <a class="fib-button hover-contrast" href="{{ route('pages.work') }}">О компании »</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- <section class="bg-main">
        <div class="container">
            <div class="fib-section">
                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <h2 class="font-size-1 font-bold">Как мы работаем</h2>
                            <p class="font-size-5">Подробная информация о будущем взаимодействии</p>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center g-4">
                    <div class="col col-6 col-lg-3">
                        <a href="{{ route('pages.about') }}#examples"
                            class="fib fib-col fib-p-34 fib-py-55 fib-gap-8 fib-center frame font-center bg-main pos-h-100 pos-relative">
                            <img class="pos-absolute pos-wallpaper"
                                src="https://e3.365dm.com/20/08/768x432/skynews-child-playing-games_5065192.jpg?20200811233800"
                                alt="">
                            <div class="pos-absolute pos-overlay bg-contrast"></div>

                            <p class="font-size-1 emoji">{{ $func->icon }}</p>
                            <p class="font-size-3 color-main font-bold">Примеры</p>
                            <p class="font-size-5 color-second">В чем наша польза</p>
                        </a>
                    </div>

                    <div class="col col-6 col-lg-3">
                        <a href="{{ route('pages.about') }}#target"
                            class="fib fib-col fib-p-34 fib-py-55 fib-gap-8 fib-center frame font-center bg-main pos-h-100 pos-relative">
                            <img class="pos-absolute pos-wallpaper"
                                src="https://images.spiceworks.com/wp-content/uploads/2021/12/15003939/targeting_gamer_audiences_might_be_more_complex_than_you_think_5e57a1b74301d.jpg"
                                alt="">
                            <div class="pos-absolute pos-overlay bg-contrast"></div>

                            <p class="font-size-1 emoji">{{ $func->icon }}</p>
                            <p class="font-size-3 color-main font-bold">Миссия</p>
                            <p class="font-size-5 color-second">Ради чего мы стараемся</p>
                        </a>
                    </div>

                    <div class="col col-6 col-lg-3">
                        <a href="{{ route('pages.about') }}#statistics"
                            class="fib fib-col fib-p-34 fib-py-55 fib-gap-8 fib-center frame font-center bg-main pos-h-100 pos-relative">
                            <img class="pos-absolute pos-wallpaper"
                                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSDiWLqhszA-HbOKvTbQXFBEnbhtoK9D_8x45AwTpJVhT6-YTu_dVQHowqEtI2N5qOwpSQ&usqp=CAU"
                                alt="">
                            <div class="pos-absolute pos-overlay bg-contrast"></div>

                            <p class="font-size-1 emoji">{{ $func->icon }}</p>
                            <p class="font-size-3 color-main font-bold">Статистика</p>
                            <p class="font-size-5 color-second">Информация в виде цифр</p>
                        </a>
                    </div>

                    <div class="col col-6 col-lg-3">
                        <a href="{{ route('pages.about') }}#team"
                            class="fib fib-col fib-p-34 fib-py-55 fib-gap-8 fib-center frame font-center bg-main pos-h-100 pos-relative">
                            <img class="pos-absolute pos-wallpaper"
                                src="https://media.istockphoto.com/id/1354761874/photo/team-of-professional-cybersport-gamers-celebrating-success-in-gaming-club.jpg?s=612x612&w=0&k=20&c=U_o5f29NIbk_WkiZvlZ49YY1N6VnUzVgV01BMpd7J-E="
                                alt="">
                            <div class="pos-absolute pos-overlay bg-contrast"></div>

                            <p class="font-size-1 emoji">{{ $func->icon }}</p>
                            <p class="font-size-3 color-main font-bold">Команда</p>
                            <p class="font-size-5 color-second">С кем вам предстоит работать</p>
                        </a>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col col-auto">
                        <a class="fib-button hover-contrast" href="{{ route('pages.about') }}">Все подробности »</a>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

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
                            <h2 class="font-size-1 font-bold">{{ $data->sections->game->title }}</h2>
                            <p class="font-size-5">{{ $data->sections->game->description }}</p>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center g-4">
                    @foreach ($data->sections->game->content as $func)
                        <div class="col col-6 col-lg-3">
                            <div class="fib fib-col fib-p-21 fib-gap-8 fib-center font-center hover-contrast pos-h-10">
                                <p class="font-size-1 emoji color-accent">{{ $func->icon }}</p>
                                <p class="font-size-2">{{ $func->title }}</p>
                                <p class="font-size-5">{{ $func->description }}</p>
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
                            <h2 class="font-size-1 font-bold">{{ $data->sections->work->title }}</h2>
                            <p class="font-size-5">{{ $data->sections->work->description }}</p>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center g-4">
                    @foreach ($data->sections->work->content as $func)
                        <div class="col col-6 col-lg-3">
                            <div
                                class="fib fib-col fib-p-21 fib-gap-8 fib-center font-center hover bg-main bord-second pos-h-100">
                                <p class="font-size-1 emoji color-accent">{{ $func->icon }}</p>
                                <p class="font-size-2">{{ $func->title }}</p>
                                <p class="font-size-5">{{ $func->description }}</p>
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

    <section>
        <div class="container">
            <div class="fib-section">
                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <h2 class="font-size-1 font-bold">Прокат компьютеров</h2>
                            <p class="font-size-5">У нас множество предложений под любые потребности</p>
                        </div>
                    </div>
                </div>

                @component('computers.components.list', compact('computers'))
                @endcomponent

                <div class="row justify-content-center">
                    <div class="col col-auto">
                        <a class="fib-button hover-contrast" href="{{ route('computers.index') }}">Все компьютеры »</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-main">
        <div class="container">
            <div class="fib-section">
                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <h2 class="font-size-1 font-bold">Подбор к игре</h2>
                            <p class="font-size-5">Можете подобрать компьютер по системным требованиям нужной игры</p>
                        </div>
                    </div>
                </div>

                @component('games.components.grid', compact('games'))
                @endcomponent

                <div class="row justify-content-center">
                    <div class="col col-auto">
                        <a class="fib-button hover-contrast" href="{{ route('games.index') }}">Все игры »</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Призыв --}}

    {{-- <section class="bg-main">
        <div class="container">
            <div class="fib-section">
                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <h2 class="font-size-1 font-bold">{{ $data->sections->statistic->title }}</h2>
                            <p class="font-size-5">{{ $data->sections->statistic->description }}</p>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center g-4">
                    @foreach ($data->sections->statistic->content as $func)
                        <div class="col col-6 col-lg-3">
                            <div class="fib fib-col fib-p-21 fib-gap-8 fib-center hover font-center pos-h-100">
                                <p class="font-size-large color-accent">{{ $func->count }}</p>
                                <p class="font-size-5">{{ $func->description }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="row justify-content-center">
                    <div class="col col-auto">
                        <a class="fib-button hover-second" href="{{ route('computers.index') }}">Каталог предложений »</a>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    {{-- Выгодные условия --}}

    {{-- <section>
        <div class="container">
            <div class="fib-section">
                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <h2 class="font-size-1 font-bold">{{ $data->sections->promo->title }}</h2>
                            <p class="font-size-5">{{ $data->sections->promo->description }}</p>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center g-4">
                    @foreach ($data->sections->promo->content as $func)
                        <div class="col col-6 col-lg-4">
                            <div class="fib fib-col fib-p-21 fib-gap-8 fib-center frame font-center bg-main pos-h-100">
                                <p class="font-size-1 font-bold color-accent">{{ $func->title }}</p>
                                <p class="font-size-5">{{ $func->description }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="row justify-content-center">
                    <div class="col col-auto">
                        <a class="fib-button hover-contrast" href="{{ route('pages.contacts') }}">Все акции »</a>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

{{-- Посты блога --}}

    {{-- <section>
        <div class="container">
            <div class="fib-section">
                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <h2 class="font-size-1 font-bold">Наши статьи</h2>
                            <p class="font-size-5">Стараемся дать своим клиентам и посетителям максимум пользы</p>
                        </div>
                    </div>
                </div>

                @component('posts.components.grid', compact('posts'))
                @endcomponent

                <div class="row justify-content-center">
                    <div class="col col-auto">
                        <a class="fib-button hover-contrast" href="{{ route('posts.index') }}">Все посты »</a>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    {{-- Отзывы --}}

    <section class="bg-main">
        <div class="container">
            <div class="fib-section">
                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <h2 class="font-size-1 font-bold">{{ $data->sections->feedback->title }}</h2>
                            <p class="font-size-5">{{ $data->sections->feedback->description }}</p>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center gy-4">
                    @foreach ($data->sections->feedback->content as $func)
                        <div class="col col-6 col-lg-3">
                            <div class="fib fib-col fib-p-21 fib-gap-8 fib-center frame font-center pos-h-100">
                                <p class="font-size-large emoji">{{ $func->icon }}</p>
                                <p class="font-size-3 color-accent">{{ $func->name }}</p>
                                <p class="font-size-5">{{ $func->commentary }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="row justify-content-center">
                    <div class="col col-auto">
                        <a class="fib-button hover-contrast" href="{{ route('pages.work') }}">Все отзывы »</a>
                    </div>
                </div>
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
                            <h2 class="font-size-1 font-bold">{{ $data->sections->feature->title }}</h2>
                            <p class="font-size-5">{{ $data->sections->feature->description }}</p>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center g-4">
                    @foreach ($data->sections->feature->content as $func)
                        <div class="col col-6 col-lg-3">
                            <div class="fib fib-col fib-p-21 fib-gap-8 fib-center frame font-center bord-second pos-h-100">
                                <p class="font-size-1 emoji">{{ $func->icon }}</p>
                                <p class="font-size-2 color-accent">{{ $func->title }}</p>
                                <p class="font-size-5">{{ $func->description }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="row justify-content-center">
                    <div class="col col-auto">
                        <a class="fib-button hover-contrast" href="{{ route('pages.work') }}">Как мы работаем »</a>
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
                                @foreach ($data->sections->citys->open as $city)
                                    <div class="col col-auto">
                                        <p class="font-size-1 font-bold">{{ $city }}</p>
                                    </div>
                                @endforeach
                            </div>

                            <p class="font-size-5">{{ $data->sections->citys->description }}</p>

                            <div class="row justify-content-center g-3">
                                @foreach ($data->sections->citys->close as $city)
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
                        <a class="fib-button hover-second" href="{{ route('pages.contacts') }}">Наши контакты »</a>
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
                            <h2 class="font-size-1 font-bold">{{ $data->sections->faq->title }}</h2>
                            <p class="font-size-5">{{ $data->sections->faq->description }}</p>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center g-4">
                    @foreach ($data->sections->faq->content as $question)
                        <div class="col col-12 col-lg-4">
                            <div
                                class="fib fib-col fib-p-21 fib-gap-8 fib-center pos-h-100 hover-second bord-second font-center">
                                <p class="font-size-3">{{ $question->question }}</p>
                                <p class="font-size-4">{{ $question->answer }}</p>
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
