@extends('layouts.app')

@section('title')
    {{ $game->name }} системные требования на пк
@endsection
@section('description')
    {{ $game->commentary }} системные требования для игры {{ $game->name }}
@endsection

@section('content')
    <section class="pos-relative">
        <img class="pos-absolute pos-wallpaper" src="{{ $game->imageUrl() }}">
        <div class="pos-absolute pos-overlay over-dark"></div>

        <div class="container">
            <div class="fib-section">
                <div class="row align-items-center justify-content-center g-4">
                    <div class="col col-12 col-lg order-2 order-lg-1">
                        <div class="fib fib-col fib-gap-8 fib-start color-second">
                            <h1 class="fib fib-col fib-gap-8">
                                <span class="font-size-1 font-bold color-accent">{{ $game->name }}</span>
                                <span class="font-size-5">cистемные требования на пк</span>
                            </h1>
                            {{-- <p class="font-size-3">{{ $game->release }}</p> --}}
                            <p class="font-size-large font-bold">{{ $game->autor }}</p>

                            <div class="fib">
                                <a class="fib-button hover-accent emoji" href="#computers">Cборки</a>

                                @if ($game->requirements->count() > 0)
                                    <a class="fib-button hover-contrast" href="#requirements">Требования</a>
                                @endif

                                @if ($game->content)
                                    <a class="fib-button hover-contrast" href="#content">Подробности</a>
                                @endif
                            </div>

                            @if (Auth::user() && Auth::user()->is_admin)
                                <div class="fib">
                                    <a class="fib-button hover-contrast emoji"
                                        href="{{ route('games.edit', compact('game')) }}">🖍️ Редактировать</a>

                                    <form class="d-inline" action="{{ route('games.destroy', compact('game')) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="fib-button hover-accent emoji">
                                            @if (isset($game->deleted_at))
                                                ♻️ Восстановить
                                            @else
                                                ❌ Удалить
                                            @endif
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col order- order-lg-2 offset-lg-1 col-6 col-lg-3">
                        <div class="pos-ratio pos-relative">
                            <img class="pos-absolute pos-wallpaper" src="{{ $game->imageUrl() }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if ($game->description)
        <section id="description" class="bg-main">
            <div class="container">
                <div class="fib-section">
                    <div class="row justify-content-center">
                        <div class="col col-12 col-md-10 col-lg-8 col-xl-6">
                            <div class="fib fib-col fib-gap-8 fib-center font-center">
                                {!! $game->description !!}
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    @endif

    @if (count($game->computers()) > 0)
        <section id="computers">
            <div class="container">
                <div class="fib-section">
                    <div class="row justify-content-center">
                        <div class="col">
                            <div class="fib fib-col fib-gap-8 fib-center font-center">
                                <h2 class="font-size-1 font-bold">Подходящие сборки</h2>
                                <p class="font-size-5">Найдите подходящуюя для себя конфигурацию</p>
                            </div>
                        </div>
                    </div>

                    @component('computers.components.list', ['computers' => $game->computers()])
                    @endcomponent

                    <div class="row justify-content-center">
                        <div class="col col-auto">
                            <a class="fib-button hover-accent" href="{{ route('computers.index') }}">Все компьютеры »</a>
                        </div>
                    </div>
                </div>
        </section>
    @endif

    @if (count($game->requirements) > 0 || (Auth::check() && Auth::user()->is_admin))
        <section id="requirements" class="pos-relative color-second">
            <img class="pos-absolute pos-wallpaper"
                src="https://i.pinimg.com/originals/38/34/07/38340756bf1beea9634c2cfa40863a0e.jpg">
            <div class="pos-absolute pos-overlay over-dark"></div>

            <div class="container">
                <div class="fib-section">
                    <div class="row justify-content-center">
                        <div class="col order-2 order-lg-1">
                            <div class="fib fib-col fib-gap-8 font-center">
                                <h2 class="font-size-1 font-bold">Системные требования</h2>
                                <span class="font-size-5">для {{ $game->name }}</span>
                            </div>
                        </div>
                    </div>

                    @component('requirements.components.list', ['requirements' => $game->requirements])
                    @endcomponent

                    @if (Auth::check() && Auth::user()->is_admin)
                        <div class="row justify-content-center">
                            <div class="col col-auto">
                                <a class="fib-button hover-accent emoji"
                                    href="{{ route('requirements.create', ['game' => $game->id]) }}">➕ Добавить</a>
                            </div>
                        </div>
                    @endif
                </div>
        </section>
    @endif

    @if ($game->content)
        <section id="content" class="bg-main">
            <div class="container">
                <div class="fib-section">
                    <div class="row">
                        <div class="col">
                            <div class="fib fib-col fib-gap-8 fib-center font-center">
                                {!! $game->content !!}
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    @endif

    <section id="form">
        <div class="container">
            <form method="POST" action="{{ route('send.discord', ['subject' => 'Вопрос по игре ' . $game->name]) }}"
                class="fib-section">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <h2 class="font-size-1 font-bold">Вопрос по игре?</h2>
                            <p class="font-size-5">Мы дадим ответ по указанным вами данным</p>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col col-12 col-md-10 col-lg-8 col-xl-6">
                        <div class="fib fib-col fib-gap-8 font-center">
                            <textarea class="fib fib-p-13 bord-second bg-main font-center" type="text" name="message" id="message"
                                placeholder="напишите свой вопрос" rows="4" required></textarea>
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
                            <button class="fib-button hover-accent" type="submit">Отправить</button>
                        </div>
                    </div>
                </div>

            </form>
    </section>
@endsection