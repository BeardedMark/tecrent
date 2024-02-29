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
                            <a class="fib-button hover-contrast" href="#steps">Этапы работы</a>
                            <a class="fib-button hover-contrast" href="#faq">Частые вопросы</a>
                            <a class="fib-button hover-contrast" href="#form">Задать вопрос</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Подробности --}}
    {{-- 2 --}}

    <section id="steps">
        <div class="container">
            <div class="fib-section">
                <div class="row g-4">
                    @foreach ($data->steps as $func)
                        <div class="col col-12 col-lg-4">
                            <div class="fib fib-col fib-p-21 fib-gap-8 fib-center pos-h-100 font-center frame bg-main">
                                <h3 class="font-size-1 color-accent font-bold">{{ $func->number }}</h3>
                                <p class="font-size-2">{{ $func->title }}</p>
                                <p class="font-size-4">{{ $func->description }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- Акции --}}
    {{-- 1 --}}

    <section id="target" class="pos-relative">
        <img class="pos-absolute pos-wallpaper"
            src="https://bychko.ru/wp-content/uploads/2019/03/signature-1024x684.jpg"
            alt="">
        <div class="pos-absolute pos-overlay bg-dark"></div>

        <div class="container">
            <div class="fib-section">
                <div class="row justify-content-center">
                    <div class="col col-12 col-lg-6">
                        <div class="fib fib-col fib-gap-8 fib-center font-center color-main">
                            <h2 class="font-size-1 font-bold">Заключаем Договор</h2>
                            <p class="font-size-5">В целях безопастности и качества предоставляемых услуг</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Вопросы --}}
    {{-- 2 --}}

    <section id="faq">
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
                    @foreach ($data->faq as $question)
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
