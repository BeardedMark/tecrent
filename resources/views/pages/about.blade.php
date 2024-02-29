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
                            <a class="fib-button hover-contrast" href="#target">Наша цель</a>
                            <a class="fib-button hover-contrast" href="#team">Наша команда</a>
                            <a class="fib-button hover-contrast" href="#form">Стать партнером</a>
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
                        <div class="col col-12 col-lg-4">
                            <div class="fib fib-col fib-p-21 fib-gap-8 fib-x-center pos-h-100 font-center frame bg-main">
                                <h3 class="font-size-3 color-accent">{{ $func->title }}</h3>
                                <p class="font-size-4">{{ $func->description }}</p>
                                <p class="font-size-5">{{ $func->content }}</p>
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
        <img class="pos-absolute pos-wallpaper"
            src="https://bernardmarr.com/wp-content/uploads/2021/07/How-Do-You-Set-The-Right-Targets-For-Your-Business-Here-Are-Some-Top-Tips.png"
            alt="">
        <div class="pos-absolute pos-overlay bg-accent"></div>

        <div class="container">
            <div class="fib-section">
                <div class="row justify-content-center">
                    <div class="col col-12 col-lg-6">
                        <div class="fib fib-col fib-gap-8 fib-center font-center color-main">
                            <h2 class="font-size-1 font-bold">Цель проекта<br>сделать игры доступными и удобными</h2>
                        </div>
                    </div>
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
                                <h3 class="font-size-2 color-accent">{{ $employee->name }}</h3>
                                <p class="font-size-4">{{ $employee->description }}</p>
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
                            <input class="fib fib-p-13 bord-second bg-main font-center" type="text" name="name"
                                id="name" placeholder="ваше имя" value="{{ old('name') }}" required>
                            <input class="fib fib-p-13 bord-second bg-main font-center" type="text" name="phone"
                                id="phone" placeholder="контактный телефон" value="{{ old('phone') }}" required>
                            <input class="fib fib-p-13 bord-second bg-main font-center" type="email" name="email"
                                id="email" placeholder="электронная почта" value="{{ old('email') }}" required>
                            <input class="fib fib-p-13 bord-second bg-main font-center" type="number" name="money"
                                id="money" placeholder="ваш бюджет" value="{{ old('email') }}" required>
                            <textarea class="fib fib-p-13 bord-second bg-main font-center" type="text" name="message" id="message"
                                placeholder="опишите свое предложение" rows="4"></textarea>
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
