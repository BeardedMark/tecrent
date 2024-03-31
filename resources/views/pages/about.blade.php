@extends('layouts.app')
@section('title', $data->title)
@section('description', $data->description)

@section('content')
    {{-- Вступление --}}
    {{-- 3 --}}

    <section class="pos-relative">
        <img class="pos-absolute pos-wallpaper"
            src="https://game-ace.com/wp-content/uploads/2020/04/Hire-Game-Developers-1.png" alt="">
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
                            <a class="fib-button hover-contrast" href="#examples">Примеры</a>
                            <a class="fib-button hover-contrast" href="#target">Миссия</a>
                            <a class="fib-button hover-contrast" href="#statistics">Статистика</a>
                            <a class="fib-button hover-contrast" href="#team">Команда</a>
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
                    @foreach ($services as $service)
                        <div class="col col-12 col-lg-4">
                            <div class="fib fib-col fib-px-21 fib-py-34 fib-gap-13 fib-x-center pos-h-100 font-center frame bg-main">
                                <h3 class="font-size-3 color-accent">{{ $service->title }}</h3>
                                <p class="font-size-4 color-contrast">{{ $service->description }}</p>
                                <p class="font-size-5">{{ $service->content }}</p>
                            </div>
                        </div>
                    @endforeach

                    {{-- @component('posts.components.list', ['posts' => $functions])
                    @endcomponent --}}
                </div>
            </div>
        </div>
    </section>

    {{-- Польза --}}
    {{-- 2 --}}

    <section id="examples" class="bg-main">
        <div class="container">
            <div class="fib-section">
                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <h2 class="font-size-1 font-bold">Примеры нашей пользы</h2>
                            <p class="font-size-5">Примеры того, в каких ситуациях мы поможем</p>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center gy-4">
                    @foreach ($examples as $example)
                        <div class="col col-6 col-lg-3">
                            <div class="fib fib-col fib-px-21 fib-py-34 fib-gap-13 fib-center hover font-center pos-h-100">
                                <p class="font-size-1 emoji color-contrast">{{ $example->icon }}</p>
                                {{-- <p class="font-size-5">{{ $example->name }}</p> --}}
                                <p class="font-size-5 color-contrast">{{ $example->description }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- Цель --}}
    {{-- 1 --}}

    <section id="target" class="pos-relative">
        <img class="pos-absolute pos-wallpaper" {{-- src="https://bernardmarr.com/wp-content/uploads/2021/07/How-Do-You-Set-The-Right-Targets-For-Your-Business-Here-Are-Some-Top-Tips.png" --}}
            src="https://i.playground.ru/p/duPO7KxliH15GdlFyHbumg.jpeg" alt="">
        <div class="pos-absolute pos-overlay bg-accent"></div>

        <div class="container">
            <div class="fib-section">
                <div class="row justify-content-center">
                    <div class="col col-12 col-lg-6">
                        <div class="fib fib-col fib-gap-8 fib-center font-center color-main">
                            <h2 class="font-size-1 font-bold">Делаем технологии доступнее</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Мы в цифрах --}}
    {{-- 1 --}}

    <section id="statistics" class="bg-main">
        <div class="container">
            <div class="fib-section">
                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <h2 class="font-size-1 font-bold">Мы в цифрах</h2>
                            <p class="font-size-5">Интересная статистика и факты о нашем проекте</p>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center g-4">
                    <div class="col col-6 col-lg-3">
                        <a href="{{ route('games.index') }}"
                            class="fib fib-col fib-p-21 fib-gap-8 fib-center hover font-center pos-h-100">
                            <p class="font-size-large color-accent">{{ count($games) }}</p>
                            <p class="font-size-5 color-contrast">Игр с требованиями</p>
                        </a>
                    </div>

                    <div class="col col-6 col-lg-3">
                        <a href="{{ route('requirements.index') }}"
                            class="fib fib-col fib-p-21 fib-gap-8 fib-center hover font-center pos-h-100">
                            <p class="font-size-large color-accent">{{ count($requirements) }}</p>
                            <p class="font-size-5 color-contrast">Системных требований</p>
                        </a>
                    </div>

                    <div class="col col-6 col-lg-3">
                        <a href="{{ route('computers.index') }}"
                            class="fib fib-col fib-p-21 fib-gap-8 fib-center hover font-center pos-h-100">
                            <p class="font-size-large color-accent">{{ count($computers) }}</p>
                            <p class="font-size-5 color-contrast">Компьютеров в аренду</p>
                        </a>
                    </div>

                    <div class="col col-6 col-lg-3">
                        <a href="{{ route('gpus.index') }}"
                            class="fib fib-col fib-p-21 fib-gap-8 fib-center hover font-center pos-h-100">
                            <p class="font-size-large color-accent">{{ count($gpus) }}</p>
                            <p class="font-size-5 color-contrast">Видеокарт</p>
                        </a>
                    </div>

                    <div class="col col-6 col-lg-3">
                        <a href="{{ route('cpus.index') }}"
                            class="fib fib-col fib-p-21 fib-gap-8 fib-center hover font-center pos-h-100">
                            <p class="font-size-large color-accent">{{ count($cpus) }}</p>
                            <p class="font-size-5 color-contrast">Процессоров</p>
                        </a>
                    </div>

                    {{-- <div class="col col-6 col-lg-3">
                        <a href="{{ route('posts.index') }}"
                            class="fib fib-col fib-p-21 fib-gap-8 fib-center hover font-center pos-h-100">
                            <p class="font-size-large color-accent">{{ count($posts) }}</p>
                            <p class="font-size-5 color-contrast">Постов</p>
                        </a>
                    </div> --}}
                </div>
            </div>
        </div>
    </section>

    {{-- Команда --}}
    {{-- 2 --}}

    <section id="team">
        <div class="container">
            <div class="fib-section">
                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <h2 class="font-size-1 font-bold">Наша команда</h2>
                            <p class="font-size-5">Мы - энтузиасты, и хотим помочь людям с помощью наших навыков и
                                возможностей</p>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    @foreach ($employees as $employee)
                        <div class="col col-12 col-lg-3">
                            <div class="fib fib-col fib-p-21 fib-gap-8 fib-x-center pos-h-100 font-center">
                                <img width="128px" src="{{ $employee->image }}" alt="">
                                <h3 class="font-size-3 color-accent">{{ $employee->name }}</h3>
                                <p class="font-size-5">{{ $employee->description }}</p>
                            </div>
                        </div>
                    @endforeach
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
                            <h2 class="font-size-1 font-bold">Стать партнером</h2>
                            <p class="font-size-5">Мы открыты для предложений, так что можете сообщить их нам</p>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col col-12 col-md-10 col-lg-8 col-xl-6">
                        <div class="fib fib-col fib-gap-8 font-center">
                            <textarea class="fib fib-p-13 bord-second bg-main font-center" type="text" name="message" id="message"
                                placeholder="опишите свое предложение" rows="4"></textarea>
                            <input class="fib fib-p-13 bord-second bg-main font-center" type="text" name="name"
                                id="name" placeholder="ваше имя" value="{{ old('name') }}" required>
                            <input class="fib fib-p-13 bord-second bg-main font-center" type="text" name="phone"
                                id="phone" placeholder="контактный телефон" value="{{ old('phone') }}" required>
                            <input class="fib fib-p-13 bord-second bg-main font-center" type="email" name="email"
                                id="email" placeholder="электронная почта" value="{{ old('email') }}" required>
                            <input class="fib fib-p-13 bord-second bg-main font-center" type="number" name="money"
                                id="money" placeholder="ваш бюджет" value="{{ old('email') }}" required>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col col-12 col-md-10 col-lg-8 col-xl-6">
                        <div class="fib fib-gap-8 fib-center font-center">
                            <button class="fib-button hover-accent" type="submit">Отправить</button>
                        </div>
                    </div>
                </div>

            </form>
    </section>
@endsection
