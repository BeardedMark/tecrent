@extends('layouts.app')

@section('title')
    {{ $gpu->name }}
@endsection

@section('content')
    <section class="pos-relative">

        <div class="container">
            <div class="fib-section">

                <div class="row justify-content-center align-items-center g-4">
                    <div class="col order-1 order-lg-1 col-12 col-lg">
                        <div class="fib fib-col fib-center font-end">
                            <p class="font-size-large">{{ $gpu->manufacturer }}</p>
                            <h1 class="font-size-1 font-bold color-accent">{{ $gpu->name }}</h1>
                            <p class="font-size-5">{{ $gpu->commentary }}</p>

                            @if (Auth::user() && Auth::user()->is_admin)
                                <div class="fib">
                                    <a class="fib-button hover-contrast emoji"
                                        href="{{ route('gpus.edit', compact('gpu')) }}">🖍️ Редактировать</a>

                                    <form class="d-inline" action="{{ route('gpus.destroy', compact('gpu')) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="fib-button hover-accent emoji">
                                            @if (isset($gpu->deleted_at))
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

                    @if ($gpu->image)
                        <div class="col order-2 order-lg-2 col-12 col-lg-4">
                            <img src="{{ asset('storage/img/gpus/' . $gpu->image) }}">
                        </div>
                    @endif

                    <div class="col order-3 order-lg-3 col-12 col-lg">
                        <div class="fib fib-col fib-gap-8 font-center">

                            <p class="font-size-5">Модель: {{ $gpu->model }}</p>
                            <p class="font-size-5">Размер памяти: {{ $gpu->memory_size }}</p>
                            <p class="font-size-5">Тип памяти: {{ $gpu->memory_type }}</p>
                            <p class="font-size-5">Частота: {{ $gpu->gpu_frequency }}</p>
                            <p class="font-size-5">Интерфейс: {{ $gpu->interface }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if ($gpu->description)
        <section id="content" class="bg-main">
            <div class="container">
                <div class="fib-section">
                    <div class="row justify-content-center">
                        <div class="col col-6">
                            <div class="fib fib-col fib-gap-8 fib-center font-center">
                                {!! $gpu->description !!}
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
                                <p class="font-size-5">Где можно использовать эту видеокарту</p>
                            </div>
                        </div>
                    </div>

                    @component('games.components.grid', compact('games'))
                    @endcomponent
                </div>
        </section>
    @endif

    <section id="power" class="pos-relative">
        <img class="pos-absolute pos-wallpaper" src="https://azon.mobi/wp-content/uploads/2023/11/active_lava_1.jpg"
            alt="">
        <div class="pos-absolute pos-overlay bg-dark"></div>

        <div class="container">
            <div class="fib-section">
                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center color-main">
                            <h2 class="font-size-1 font-bold">Мощность видеокарты</h2>
                            <p class="font-size-5">Условный показатель в рамках сайта</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <p class="font-center font-size-large font-bold color-main">🗲 {{ $gpu->power }} 🗲</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if (count($gpus) > 0)
        <section id="content" class="">
            <div class="container">
                <div class="fib-section">
                    <div class="row">
                        <div class="col">
                            <div class="fib fib-col fib-gap-8 fib-center font-center">
                                <h2 class="font-size-1 font-bold">В каких сборках</h2>
                                <p class="font-size-5">Где мы используем эту видеокарту</p>
                            </div>
                        </div>
                    </div>

                    @component('computers.components.list', compact('computers'))
                    @endcomponent

                    <div class="row justify-content-center">
                        <div class="col col-auto">
                            <a class="fib-button hover-contrast"
                                href="{{ route('computers.index', ['gpu_id' => $gpu->id]) }}">Все компьютеры »</a>
                        </div>
                    </div>
                </div>
        </section>
    @endif

    @if ($gpu->content)
        <section id="content" class="bg-main">
            <div class="container">
                <div class="fib-section">
                    <div class="row">
                        <div class="col">
                            <div class="fib fib-col fib-gap-8 fib-center font-center">
                                {!! $gpu->content !!}
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
                            <h2 class="font-size-1 font-bold">Другие видеокарты</h2>
                            <p class="font-size-5">Возможно вам помогут другие статьи?</p>
                        </div>
                    </div>
                </div>

                @component('gpus.components.grid', compact('gpus'))
                @endcomponent

                <div class="row justify-content-center">
                    <div class="col col-auto">
                        <a class="fib-button hover-contrast" href="{{ route('gpus.index') }}">Все видеокарты »</a>
                    </div>
                </div>
            </div>
    </section>
@endsection
