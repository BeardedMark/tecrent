@extends('layouts.app')

@section('title')
    {{ $cpu->name }}
@endsection

@section('content')
    <section class="pos-relative">

        <div class="container">
            <div class="fib-section">
                <div class="row align-items-center justify-content-center g-4">
                    <div class="col col-12 col-lg-6">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <p class="font-size-2">{{ $cpu->manufacturer }}</p>
                            <h1 class="font-size-1 font-bold color-accent">{{ $cpu->name }}</h1>
                            <p class="font-size-5">{{ $cpu->commentary }}</p>
                            <p class="font-size-large emoji">{{ $cpu->emoji }}</p>

                            @if (Auth::user() && Auth::user()->is_admin)
                                <div class="fib">
                                    <a class="fib-button hover-contrast emoji"
                                        href="{{ route('cpus.edit', compact('cpu')) }}">🖍️ Редактировать</a>

                                    <form class="d-inline" action="{{ route('cpus.destroy', compact('cpu')) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="fib-button hover-accent emoji">
                                            @if (isset($cpu->deleted_at))
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
                </div>
            </div>
        </div>
    </section>

    @if ($cpu->description)
        <section id="content" class="bg-main">
            <div class="container">
                <div class="fib-section">
                    <div class="row">
                        <div class="col">
                            <div class="fib fib-col fib-gap-8 fib-center font-center">
                                {!! $cpu->description !!}
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    @endif

    @if (count($games) > 0)
        <section id="content" class="">
            <div class="container">
                <div class="fib-section">
                    <div class="row">
                        <div class="col">
                            <div class="fib fib-col fib-gap-8 fib-center font-center">
                                <h2 class="font-size-1 font-bold">В каких играх</h2>
                                <p class="font-size-5">Где можно использовать этот процессор</p>
                            </div>
                        </div>
                    </div>

                    @component('games.components.grid', compact('games'))
                    @endcomponent
                </div>
        </section>
    @endif

    <section id="power" class="pos-relative">
        <img class="pos-absolute pos-wallpaper"
            src="https://azon.mobi/wp-content/uploads/2023/11/active_lava_1.jpg"
            alt="">
        <div class="pos-absolute pos-overlay bg-dark"></div>

        <div class="container">
            <div class="fib-section">
                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center color-main">
                            <h2 class="font-size-1 font-bold">Мощность процессора</h2>
                            <p class="font-size-5">Условный показатель в рамках сайта</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <p class="font-center font-size-large font-bold color-main">🗲 {{ $cpu->power }} 🗲</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if (count($computers) > 0)
        <section id="content" class="">
            <div class="container">
                <div class="fib-section">
                    <div class="row">
                        <div class="col">
                            <div class="fib fib-col fib-gap-8 fib-center font-center">
                                <h2 class="font-size-1 font-bold">В каких сборках</h2>
                                <p class="font-size-5">Где мы используем этот процессор</p>
                            </div>
                        </div>
                    </div>

                    @component('computers.components.list', compact('computers'))
                    @endcomponent

                    <div class="row justify-content-center">
                        <div class="col col-auto">
                            <a class="fib-button hover-contrast"
                                href="{{ route('computers.index', ['cpu_id' => $cpu->id]) }}">Все компьютеры »</a>
                        </div>
                    </div>
                </div>
        </section>
    @endif

    @if ($cpu->content)
        <section id="content" class="bg-main">
            <div class="container">
                <div class="fib-section">
                    <div class="row">
                        <div class="col">
                            <div class="fib fib-col fib-gap-8 fib-center font-center">
                                {!! $cpu->content !!}
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    @endif

    <section id="content">
        <div class="container">
            <div class="fib-section">
                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <h2 class="font-size-1 font-bold">Другие процессоры</h2>
                            <p class="font-size-5">Возможно вам помогут другие статьи?</p>
                        </div>
                    </div>
                </div>

                @component('cpus.components.grid', compact('cpus'))
                @endcomponent

                <div class="row justify-content-center">
                    <div class="col col-auto">
                        <a class="fib-button hover-contrast" href="{{ route('cpus.index') }}">Все процессоры »</a>
                    </div>
                </div>
            </div>
    </section>
@endsection
