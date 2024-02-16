@extends('layouts.app')

@section('title', $content['title'])
@section('description', $content['description'])

@section('content')
    <section>
        <div class="container">
            <div class="fib-section">
                <div class="row justify-content-center">
                    <div class="col col-12 col-md-10 col-lg-8 col-xl-6">
                        <div class="fib fib-col fib-gap-8 font-center">
                            <h2 class="font-size-1 font-bold">{{ $content['title'] }}</h2>
                            <p class="font-size-5">{{ $content['description'] }}</p>
                            @if (Auth::user() && Auth::user()->is_admin)
                                <div class="fib fib-center">
                                    <a class="fib-button hover-contrast emoji" href="{{ route('games.create') }}">➕
                                        Добавить</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col col-12 col-md-10 col-lg-8 col-xl-6">
                        <form class="fib fib-col fib-gap-21" method="GET" action="{{ route('games.index') }}">
                            <div class="row">
                                <div class="col">
                                    <div class="fib fib-col fib-gap-13">
                                        <div class="fib fib-col">
                                            <div class="fib w-100">
                                                <input type="text" id="search" name="search"
                                                    class="fib fib-p-8 bord-second bg-main w-100"
                                                    placeholder="поиск строки по любому совпадению"
                                                    value="{{ request()->input('search') }}" required />

                                                <button type="submit" class="fib-button hover-accent emoji">🔍</button>
                                            </div>
                                        </div>

                                        <div class="fib fib-center fib-gap-21">
                                            <a class="link"
                                                href="{{ route('games.index', ['sort' => 'release', 'direction' => 'desc']) }}">по релизу</a>
                                            <a class="link"
                                                href="{{ route('games.index', ['sort' => 'name', 'direction' => 'asc']) }}">по алфавиту</a>
                                                <a class="link"
                                                    href="{{ route('games.index', ['sort' => 'autor', 'direction' => 'asc']) }}">по автору</a>
                                                    <a class="link"
                                                        href="{{ route('games.index', ['sort' => 'created_at', 'direction' => 'desc']) }}">по публикации</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row justify-content-center g-4">
                    @foreach ($games as $game)
                        <div class="col col-6 col-md-6 col-lg-4 col-xl-3">
                            @component('games.components.card', ['game' => $game])
                            @endcomponent
                        </div>
                    @endforeach
                </div>
            </div>
    </section>

    <section class="bg-main">
        <div class="container">
            <div class="fib-section font-center">
                <div class="row justify-content-center">
                    <div class="col col-12 col-md-10 col-lg-8 col-xl-6">
                        <div class="fib fib-col fib-gap-8">
                            <p class="font-size-4">{{ $content['content'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <section id="form">
        <div class="container">
            <form method="POST" action="{{ route('send.discord', ['subject' => 'Заявка на добавление игры']) }}"
                class="fib-section">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <h2 class="font-size-1 font-bold">Не нашли нужную игру?</h2>
                            <p class="font-size-5">Сообщите нам, и после добавления мы вас оповестим</p>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col col-12 col-md-10 col-lg-8 col-xl-6">
                        <div class="fib fib-col fib-gap-8 font-center">
                            <textarea class="fib fib-p-13 bord-second bg-main font-center" type="text" name="message" id="message"
                                placeholder="перечислите интересующие игры" rows="4" required></textarea>
                            <input class="fib fib-p-13 bord-second bg-main font-center" type="text" name="name"
                                id="name" placeholder="ваше имя" value="{{ old('name') }}">
                            <input class="fib fib-p-13 bord-second bg-main font-center" type="text" name="phone"
                                id="phone" placeholder="контактный телефон" value="{{ old('phone') }}">
                            <input class="fib fib-p-13 bord-second bg-main font-center" type="email" name="email"
                                id="email" placeholder="электронная почта" value="{{ old('email') }}">
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
