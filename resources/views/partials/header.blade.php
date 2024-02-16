@php
    $cartItems = session('cart', []);
    // dd ($cartItems);
    $cartCount = count($cartItems) ? count($cartItems) : 0;
@endphp

<section class="fixed-top">
    <div class="frame bg-main bord-bot">
        <div class="row">
            <div class="col">
                <div class="fib">
                    <a class="fib-p-13 hover-accent font-size-5 d-none d-lg-block emoji"
                        href="{{ route('sitemap') }}">🟰</a>
                    <a class="fib-p-13 hover font-size-5 font-bold" id="loadButton" href="{{ route('main') }}"><span
                            class="color-accent">TEC</span>RENT</a>
                    <a class="fib-p-13 hover font-size-5" href="{{ route('about') }}">О компании</a>
                    <a class="fib-p-13 hover font-size-5" href="{{ route('work') }}">Как работаем</a>
                    <a class="fib-p-13 hover font-size-5 d-none d-lg-block"
                        href="{{ route('servers') }}">Сервера</a>
                    <a class="fib-p-13 hover font-size-5 d-none d-lg-block"
                        href="{{ route('assembly') }}">Сборка</a>
                    <a class="fib-p-13 hover font-size-5 d-none d-lg-block" href="{{ route('games.index') }}">Игры</a>
                    <a class="fib-p-13 hover font-size-5 d-none d-lg-block"
                        href="{{ route('computers.index') }}">Компьютеры</a>
                </div>
            </div>

            <div class="col-auto">
                <div class="fib">
                    <a class="fib-p-13 hover font-size-5 d-none d-lg-block" href="{{ route('chat') }}"
                        target="_blank">Чат</a>
                    <a class="fib-p-13 hover font-size-5 d-none d-lg-block" href="{{ route('contacts') }}">Контакты</a>
                    <a class="fib-p-13 hover font-size-5" href="tel:89139208405">+7 (913) <span
                            class="color-accent">920-84-05</span></a>
                    @if (Auth::user())
                        @if (Auth::user()->is_admin)
                            <a class="fib-p-13 hover font-size-5 emoji"
                                href="{{ route('admin', Auth::user()->id) }}">👑</a>
                        @endif
                        <a class="fib-p-13 hover font-size-5 d-none d-lg-block"
                            href="{{ route('users.show', Auth::user()->id) }}">Профиль</a>
                    @endif
                    <a class="fib-p-13 hover font-size-5 d-none d-lg-block" href="{{ route('basket.index') }}">Заказ:
                        <span class="color-accent">{{ $cartCount }}</span></a>
                </div>
            </div>
        </div>
    </div>

    <div class="fib fib-col pos-w-100 pos-absolute color-main font-size-6">
        @if (Auth::user() && Auth::user()->is_admin && session('log'))
            <p class="fib-px-13 fib-py-8 bg-contrast font-center"><span class="emoji">⏺️</span> {{ session('log') }}</p>
        @endif

        @if (session('success'))
            <p class="fib-px-13 fib-py-8 bg-success font-center"><span class="emoji">✅</span> {{ session('success') }}</p>
        @endif

        @if (session('warning'))
            <p class="fib-px-13 fib-py-8 bg-warning font-center"><span class="emoji">ℹ️</span> {{ session('warning') }}</p>
        @endif

        @if (isset($errors) && $errors->any())
            <ul class="fib fib-col fib-px-13 fib-py-8 bg-danger font-center">
                @foreach ($errors->all() as $error)
                    <li><span class="emoji">❎</span> {{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <div class="fib fib-end">
            <a class="fib-button hover-contrast emoji escort" href="#main">⬆️ Вверх</a>
        </div>
    </div>
</section>

<section class="fixed-bottom">
    <div class="bg-main bord-top d-block d-lg-none">
        <div class="fib">
            <a class=" fib-col fib-p-13 hover font-center" href="{{ route('sitemap') }}">
                <p class="font-size-2 emoji">🧭</p>
                <p class="font-size-6">Меню</p>
            </a>
            <a class="fib-col fib-p-13 hover font-center" href="{{ route('games.index') }}">
                <p class="font-size-2 emoji">🎮</p>
                <p class="font-size-6">Игры</p>
            </a>
            <a class="fib-col fib-p-13 hover font-center" href="{{ route('computers.index') }}">
                <p class="font-size-2 emoji">🖥️</p>
                <p class="font-size-6">Компьютеры</p>
            </a>
            @if (Auth::user())
                <a class="fib-col fib-p-13 hover font-center" href="{{ route('users.show', Auth::user()->id) }}">
                    <p class="font-size-2 emoji">👤</p>
                    <p class="font-size-6">Профиль</p>
                </a>
            @endif
            <a class="fib-col fib-p-13 hover font-center" href="{{ route('basket.index') }}">
                <p class="font-size-2 emoji">🛒</p>
                <p class="font-size-6">Заказ: <span class="color-accent">{{ $cartCount }}</span></p>
            </a>
        </div>
    </div>
</section>
