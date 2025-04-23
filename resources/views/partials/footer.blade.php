<section id="footer" class="bg-contrast color-second">
    <div class="container">
        <div class="fib-section">
            <div class="row">
                <div class="col col-auto">
                    <div class="col col-auto">
                        <div class="fib fib-col">
                            <a class="font-size-4 link" href="{{ route('pages.main') }}">Главная</a>
                            <a class="font-size-4 link" href="{{ route('pages.about') }}">О компании</a>
                            <a class="font-size-4 link" href="{{ route('pages.work') }}">Условия работы</a>
                            <a class="font-size-4 link" href="{{ route('pages.contacts') }}">Контакты</a>
                            <a class="font-size-4 link" href="{{ route('pages.menu') }}">Карта сайта</a>
                        </div>
                    </div>
                </div>

                <div class="col col-auto">
                    <div class="col col-auto">
                        <div class="fib fib-col">
                            <a class="font-size-4 link" href="{{ route('offers.index') }}">Каталог</a>
                            <a class="font-size-4 link" href="{{ route('offers.search') }}">Поиск</a>
                            <a class="font-size-4 link"
                                href="{{ route('offers.search', ['type' => 'Аренда']) }}">Аренда</a>
                            <a class="font-size-4 link"
                                href="{{ route('offers.search', ['type' => 'Услуги']) }}">Услуги</a>
                            <a class="font-size-4 link"
                                href="{{ route('offers.search', ['type' => 'Товары']) }}">Товары</a>
                        </div>
                    </div>
                </div>

                <div class="col col-auto">
                    <div class="col col-auto">
                        <div class="fib fib-col fib-start">
                            <a class="font-size-4 link" href="{{ route('auth.login') }}">Личный кабинет</a>
                            <a class="font-size-4 link" href="{{ route('pages.business') }}">Юридическим лицам</a>
                            <a class="font-size-4 link" href="{{ route('pages.gamers') }}">Для геймеров</a>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="fib fib-col fib-end fib-gap-13 font-end h-100">
                        <div>
                            <p class="font-size-3 color-accent">TECRENT</p>
                            <p class="font-size-5">Аренда игровых и офисных компьютеров</p>
                            <p class="font-size-4 h-100">8 (913) 920-84-05</p>
                        </div>

                        <div>
                            <p class="font-size-5">г. Новосибирск © 2025</p>
                            <a class="font-size-6 link" href="https://sin-mark.ru/">ИП Синельщиков МР</a>
                        </div>

                        <div class="fib fib-row fib-gap-5">
                            <a class="fib-p-13 hover-contrast fib-r-34 font-size-5" href="tel:89139208405">
                                <img width="21" height="21"
                                    src="https://img.icons8.com/fluency-systems-regular/21/f12352/ringer-volume--v1.png"
                                    alt="вверх" />
                            </a>

                            <a class="fib-p-13 hover-contrast fib-r-34 font-size-5" href="{{ route('chat.telegram') }}"
                                target="_blink">
                                <img width="21" height="21"
                                    src="https://img.icons8.com/fluency-systems-regular/21/dadada/telegram-app.png"
                                    alt="вверх" />
                            </a>

                            <a class="fib-p-13 hover-contrast fib-r-34 font-size-5" href="{{ route('chat.whatsapp') }}"
                                target="_blink">
                                <img width="21" height="21"
                                    src="https://img.icons8.com/fluency-systems-regular/21/dadada/whatsapp--v1.png"
                                    alt="вверх" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
