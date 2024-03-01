@extends('layouts.app')
@section('title', $data->title)
@section('description', $data->description)

@section('content')
    {{-- Вступление --}}
    {{-- 3 --}}

    <section class="pos-relative">
        <img class="pos-absolute pos-wallpaper" src="https://www.artlebedev.com/1shot/interiors/1shot-interiors-gg-light.jpg"
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
                            <a class="fib-button hover-contrast" href="#steps">Этапы</a>
                            <a class="fib-button hover-contrast" href="#features">Преимущества</a>
                            <a class="fib-button hover-contrast" href="#gifts">Акции</a>
                            <a class="fib-button hover-contrast" href="#questions">Ответы</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Этапы --}}
    {{-- 2 --}}

    <section id="steps">
        <div class="container">
            <div class="fib-section">
                <div class="row g-4">
                    @foreach ($steps as $step)
                        <div class="col col-12 col-lg-4">
                            <div class="fib fib-col fib-p-21 fib-gap-8 fib-center pos-h-100 font-center frame bg-main">
                                <p class="font-size-1 color-accent font-bold">{{ $step->number }}</p>
                                <h3 class="font-size-2">{{ $step->title }}</h3>
                                <p class="font-size-6">{{ $step->description }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    
    {{-- Наши преимущества --}}
    {{-- 2 --}}

    <section id="features" class="bg-main">
        <div class="container">
            <div class="fib-section">
                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <h2 class="font-size-1 font-bold">Наши особенности</h2>
                            <p class="font-size-5">Что мы хотим выставить в свете своих приемуществ</p>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center g-4">
                    @foreach ($features as $feature)
                        <div class="col col-6 col-lg-3">
                            <div class="fib fib-col fib-p-21 fib-gap-8 fib-center hover font-center pos-h-100">
                                <p class="font-size-1 emoji">{{ $feature->icon }}</p>
                                <p class="font-size-2 color-accent">{{ $feature->title }}</p>
                                <p class="font-size-5">{{ $feature->description }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- Акции --}}
    {{-- 1 --}}

    <section class="pos-relative">
        <img class="pos-absolute pos-wallpaper"
            src="https://www.groovypost.com/wp-content/uploads/2022/09/calendar-example.png"
            alt="">
        <div class="pos-absolute pos-overlay bg-dark"></div>

        <div class="container">
            <div class="fib-section">
                <div class="row justify-content-center">
                    <div class="col col-12 col-lg-6">
                        <div class="fib fib-col fib-gap-8 fib-center font-center color-main">
                            <p class="font-size-1 font-bold">7 дней</p>
                            <h2 class="font-size-2">Минимальный срок аренды</h2>
                            <p class="font-size-6">Можно арендовать на меньший срок,<br>но оплата будет как за 7 дней</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    {{-- Наши преимущества --}}
    {{-- 2 --}}

    <section id="gifts" class="bg-main">
        <div class="container">
            <div class="fib-section">
                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <h2 class="font-size-1 font-bold">Акции и предложения</h2>
                            <p class="font-size-5">Условия, за которые мы дарим дни аренды</p>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center g-4">
                    <div class="col col-6 col-lg-3">
                        <div class="fib fib-col fib-p-21 fib-gap-8 fib-center hover font-center pos-h-100">
                            <p class="font-size-1 emoji">✌️</p>
                            <p class="font-size-2 color-accent">За второй заказ</p>
                            <p class="font-size-6">1 день бесплатно</p>
                        </div>
                    </div>

                    <div class="col col-6 col-lg-3">
                        <div class="fib fib-col fib-p-21 fib-gap-8 fib-center hover font-center pos-h-100">
                            <p class="font-size-1 emoji">📅</p>
                            <p class="font-size-2 color-accent">По праздникам</p>
                            <p class="font-size-6">1 день бесплатно</p>
                        </div>
                    </div>
                    
                    <div class="col col-6 col-lg-3">
                        <div class="fib fib-col fib-p-21 fib-gap-8 fib-center hover font-center pos-h-100">
                            <p class="font-size-1 emoji">🎂</p>
                            <p class="font-size-2 color-accent">В день рождения</p>
                            <p class="font-size-6">1 день бесплатно</p>
                        </div>
                    </div>
                    
                    <div class="col col-6 col-lg-3">
                        <div class="fib fib-col fib-p-21 fib-gap-8 fib-center hover font-center pos-h-100">
                            <p class="font-size-1 emoji">👍</p>
                            <p class="font-size-2 color-accent">За отзыв</p>
                            <p class="font-size-6">1 день бесплатно</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Вопросы --}}
    {{-- 2 --}}

    <section id="questions">
        <div class="container">
            <div class="fib-section">
                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <h2 class="font-size-1 font-bold">Частые вопросы</h2>
                            <p class="font-size-5">Возможно вы не первый кому в голову приходят те или иные мысли</p>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center g-4">
                    @foreach ($questions as $question)
                        <div class="col col-12 col-lg-4">
                            <div class="fib fib-col fib-p-21 fib-gap-8 fib-center frame font-center bg-main pos-h-100">
                                <p class="font-size-3 color-accent">{{ $question->question }}</p>
                                <p class="font-size-4">{{ $question->answer }}</p>
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
            <form method="POST" action="{{ route('send.discord', ['subject' => 'Обратная связь']) }}" class="fib-section">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <h2 class="font-size-1 font-bold">Задать вопрос</h2>
                            <p class="font-size-5">Мы дадим ответ по указанным вами данным</p>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col col-12 col-md-10 col-lg-8 col-xl-6">
                        <div class="fib fib-col fib-gap-8 font-center">
                            <textarea class="fib fib-p-13 bord-second bg-main font-center" type="text" name="message" id="message"
                                placeholder="сообщение" rows="4"></textarea>
                            <input class="fib fib-p-13 bord-second bg-main font-center" type="text" name="name"
                                id="name" placeholder="ваше имя" value="{{ old('name') }}" required>
                            <input class="fib fib-p-13 bord-second bg-main font-center" type="text" name="phone"
                                id="phone" placeholder="контактный телефон" value="{{ old('phone') }}" required>
                            <input class="fib fib-p-13 bord-second bg-main font-center" type="email" name="email"
                                id="email" placeholder="электронная почта" value="{{ old('email') }}" required>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col col-12 col-md-10 col-lg-8 col-xl-6">
                        <div class="fib fib-gap-8 fib-center font-center">
                            <button class="fib-button hover-accent" type="submit">Задать</button>
                        </div>
                    </div>
                </div>

            </form>
    </section>
@endsection
