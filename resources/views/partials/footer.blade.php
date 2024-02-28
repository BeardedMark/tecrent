<section class="bg-contrast color-second">
    <div class="container">
        <div class="fib-section">
            <div class="row justify-content-center">
                <div class="col col-auto">
                    <div class="fib fib-col fib-center">
                        <p class="font-size-3">TECRENT</p>
                        <p class="font-size-6">Аренда игровых и офисных компьютеров</p>
                        <p class="font-size-4">8 (913) 920-84-05</p>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col col-auto">
                    <div class="fib fib-col fib-end">
                        <a class="font-size-4 link" href="{{ route('pages.main') }}">Главная</a>
                        <a class="font-size-4 link" href="{{ route('pages.about') }}">О компании</a>
                        <a class="font-size-4 link" href="{{ route('pages.work') }}">Как мы работаем</a>
                        <a class="font-size-4 link" href="{{ route('computers.index') }}">Компьютеры</a>
                        <a class="font-size-4 link" href="{{ route('games.index') }}">Игры</a>
                    </div>
                </div>

                <div class="col col-auto">
                    <div class="fib fib-col fib-start">
                        <a class="font-size-4 link" href="{{ route('pages.contacts') }}">Контакты</a>
                        <a class="font-size-4 link" href="{{ route('chat') }}">Чат поддержки</a>
                        <a class="font-size-4 link" href="{{ route('basket.index') }}">Заказ</a>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col col-auto">
                    <div class="fib fib-col fib-center">
                        <div class="fib fib-gap-8">
                            <a class="font-size-5 link" href="{{ route('pages.menu') }}">Карта сайта</a>
                            <a class="font-size-5 link" href="{{ route('auth.login') }}">Авторизация</a>
                        </div>
                        {{-- <a class="font-size-6 link" href="http://devirs.com/">Devirs ©️ 2023</a> --}}
                        <a class="font-size-6 link">ИП Синельщиков МР</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
