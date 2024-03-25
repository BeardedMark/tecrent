@extends('layouts.app')

@section('title')
    {{ $computer->name }}
@endsection
@section('description')
    {{ $computer->commentary }} {{ $computer->name }} в аренду за {{ $computer->price }} руб/день
@endsection

@section('content')
    <section class="pos-relative overflow-hidden">

        <video class="pos-absolute pos-wallpaper" autoplay muted loop>
            <source src="{{ asset('video/whitegeomerty.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>

        {{-- <div class="pos-absolute pos-overlay bg-white"></div> --}}
        <div class="container">
            <div class="fib-section">
                <div class="row justify-content-center align-items-center g-4">
                    <div class="col order-1 order-lg-1 col-12 col-lg">
                        <div class="fib fib-col fib-center font-end">
                            <h1 class="font-size-1 font-bold color-accent">{{ $computer->name }}</h1>
                            <p class="font-size-4">{{ $computer->comment }}</p>
                            <p class="font-size-large font-bold">{{ $computer->price }} р/д</p>

                            <div class="fib fib-col fib-gap-8 fib-center">
                                <div class="fib">
                                    <form method="POST" action="{{ route('basket.store') }}">
                                        @csrf
                                        <input type="text" hidden name="id" id="id"
                                            value="{{ $computer->id }}">
                                        <button class="fib-button hover-accent" type="submit">К заказу</button>
                                    </form>

                                    @if ($computer->games()->count() > 0)
                                        <a class="fib-button hover-contrast" href="#games">Игры</a>
                                    @endif
                                    @if ($computer->description)
                                        <a class="fib-button hover-contrast" href="#description">Описание</a>
                                    @endif
                                    @if ($computer->content)
                                        <a class="fib-button hover-contrast" href="#content">Подробности</a>
                                    @endif
                                </div>

                                @if (Auth::user() && Auth::user()->is_admin)
                                    <div class="fib">
                                        <a class="fib-button hover-contrast emoji"
                                            href="{{ route('computers.edit', compact('computer')) }}">🖍️ Редактировать</a>

                                        <form class="d-inline"
                                            action="{{ route('computers.destroy', compact('computer')) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="fib-button hover-accent emoji">
                                                @if (isset($computer->deleted_at))
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

                    @if ($computer->image)
                        <div class="col order-2 order-lg-2 col-12 col-lg-4">
                            {{-- @if ($computer->image) --}}
                            <img src="{{ asset('storage/img/computers/' . $computer->image) }}">
                            {{-- @else
                            <div class="fib fib-center pos-h-100 pos-w-100">
                                <p class="font-size-large emoji color-second">🖥️</p>
                            </div>
                            @endif --}}
                        </div>
                    @endif

                    @if ($computer->gpu || $computer->cpu || $computer->ram || $computer->drive)
                        <div class="col order-3 order-lg-3 col-12 col-lg">
                            <div class="fib fib-col fib-gap-8 font-center">
                                @if ($computer->gpu)
                                    <div class="fib fib-col">
                                        <p class="font-size-6">Видеокарта</p>
                                        <p class="font-size-2 font-bold color-accent">{{ $computer->gpu->getTitle() }}</p>
                                    </div>
                                @endif

                                @if ($computer->cpu)
                                    <div class="fib fib-col">
                                        <p class="font-size-6">Процессор</p>
                                        <p class="font-size-2 font-bold color-accent">{{ $computer->cpu->getTitle() }}</p>
                                    </div>
                                @endif

                                @if ($computer->ram)
                                    <div class="fib fib-col">
                                        <p class="font-size-6">Память</p>
                                        <p class="font-size-2 font-bold color-accent">{{ $computer->getRamTitle() }}</p>
                                    </div>
                                @endif

                                @if ($computer->drive)
                                    <div class="fib fib-col">
                                        <p class="font-size-6">Накопитель</p>
                                        <p class="font-size-2 font-bold color-accent">{{ $computer->drive->getTitle() }}
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    @if ($computer->description)
        <section id="description" class="bg-main">
            <div class="container">
                <div class="fib-section">
                    <div class="row justify-content-center">
                        <div class="col col-lg-6">
                            <div class="fib fib-col fib-gap-8 fib-center font-center">
                                {!! $computer->description !!}
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    @endif

    @if ($computer->games()->count() > 0)
        <section id="games" class="pos-relative">
            <img class="pos-absolute pos-wallpaper"
                src="https://wallpapers.com/images/hd/purple-gaming-nepi2tnxp6g0mvz9.jpg" alt="">
            <div class="pos-absolute pos-overlay bg-black"></div>

            <div class="container">
                <div class="fib-section color-second">
                    <div class="row">
                        <div class="col">
                            <div class="fib fib-col fib-gap-8 fib-center font-center">
                                <h2 class="font-size-1 font-bold">Подходящие игры</h2>
                                <p class="font-size-5">На этой сборке вы можете играюче провести время</p>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center g-4">
                        @foreach ($computer->games(4) as $game)
                            <div class="col col-6 col-md-6 col-lg-4 col-xl-3">
                                @component('games.components.card', ['game' => $game])
                                @endcomponent
                            </div>
                        @endforeach
                    </div>

                    <div class="row justify-content-center">
                        <div class="col col-auto">
                            <a class="fib-button hover-accent"
                                href="{{ route('games.index', ['computer' => $computer->id]) }}">Все
                                {{ $computer->games()->count() }} подходящие игры »</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if ($computer->content)
        <section id="content" class="bg-main">
            <div class="container">
                <div class="fib-section">
                    <div class="row">
                        <div class="col">
                            <div class="fib fib-col fib-gap-8 fib-center font-center">
                                {!! $computer->content !!}
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    @endif

    <section id="form">
        <div class="container">
            <form method="POST"
                action="{{ route('send.discord', ['subject' => 'Вопрос по компьютеру ' . $computer->name]) }}"
                class="fib-section">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <h2 class="font-size-1 font-bold">Возник вопрос?</h2>
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
