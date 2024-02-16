@php
    $content = json_decode(file_get_contents(storage_path('content/assembly.json')), true);
@endphp

@extends('layouts.app')
@section('title', $content['title'])
@section('description', $content['description'])

@section('content')
    <section>
        <div class="container">
            <div class="fib-section">
                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <h1 class="font-size-1 font-bold">{{ $content['title'] }}</h1>
                            <p class="font-size-5">{{ $content['description'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="row g-4">
                    @foreach ($content['functions'] as $func)
                        <div class="col col-12 col-lg-3">
                            <div class="fib fib-col fib-p-21 fib-gap-8 fib-x-center pos-h-100 font-center frame bg-main">
                                <h3 class="font-size-1 color-accent emoji">{{ $func['title'] }}</h3>
                                <p class="font-size-4">{{ $func['description'] }}</p>
                                <p class="font-size-5">{{ $func['content'] }}</p>
                            </div>
                        </div>
                    @endforeach
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
                            <p class="font-size-4">{{ $content['content'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <section id="form">
        <div class="container">
            <form method="POST" action="{{ route('send.discord', ['subject' => 'Заявка на сборку компьютера']) }}" class="fib-section">
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
