<section class="fixed-top">
    <div class="frame bg-main real-shadow">
        <div class="row">
            <div class="col">
                <div class="fib">
                    <a class="fib-p-13 hover-accent font-size-5" href="{{ route('pages.menu') }}">
                        <img width="21" height="21"
                            src="https://img.icons8.com/fluency-systems-regular/21/ffffff/menu--v1.png" alt="вверх" />
                    </a>
                    <a class="fib-p-13 hover font-size-5 font-bold {{ request()->routeIs('pages.main') ? 'hover-second' : '' }}" id="loadButton"
                        href="{{ route('pages.main') }}"><span class="color-accent">TEC</span>RENT</a>
                    <a class="fib-p-13 hover font-size-5 d-none d-lg-block {{ request()->routeIs('pages.about') ? 'hover-second' : '' }}"
                        href="{{ route('pages.about') }}">О проекте</a>
                    <a class="fib-p-13 hover font-size-5 d-none d-lg-block {{ request()->routeIs('pages.work') ? 'hover-second' : '' }}"
                        href="{{ route('pages.work') }}">Условия работы</a>
                    <a class="fib-p-13 hover font-size-5 d-none d-lg-block {{ request()->routeIs('offers.index') ? 'hover-second' : '' }}"
                        href="{{ route('offers.index') }}">Каталог</a>

                    <a class="fib-p-13 hover font-size-5 d-none d-lg-block {{ request()->routeIs('offers.search') ? 'hover-second' : '' }}" href="{{ route('offers.search') }}">
                        <img width="21" height="21"
                            src="https://img.icons8.com/fluency-systems-regular/21/333333/search.png" alt="search" />
                    </a>
                </div>
            </div>

            <div class="col-auto">
                <div class="fib">
                    <a class="fib-p-13 hover font-size-5 d-none d-lg-block {{ request()->routeIs('pages.contacts') ? 'hover-second' : '' }}"
                        href="{{ route('pages.contacts') }}">Новосибирск</a>
                    <p class="fib-p-13 font-size-5 d-none d-lg-block">+7 (913) <span
                            class="color-accent">920-84-05</span></p>
                    <a class="fib-p-13 hover font-size-5" href="tel:89139208405">
                        <img width="21" height="21"
                            src="https://img.icons8.com/fluency-systems-regular/21/f12352/ringer-volume--v1.png"
                            alt="вверх" />
                    </a>

                    <a class="fib-p-13 hover font-size-5" href="{{ route('chat.telegram') }}" target="_blink">
                        <img width="21" height="21"
                            src="https://img.icons8.com/fluency-systems-regular/21/333333/telegram-app.png"
                            alt="вверх" />
                    </a>

                    <a class="fib-p-13 hover font-size-5" href="{{ route('chat.whatsapp') }}" target="_blink">
                        <img width="21" height="21"
                            src="https://img.icons8.com/fluency-systems-regular/21/333333/whatsapp--v1.png"
                            alt="вверх" />
                    </a>

                    @if (Auth::user())
                        <a class="fib-gap-5 fib-p-13 hover font-size-5 d-none d-lg-flex {{ request()->routeIs('users.show') ? 'hover-accent' : '' }} {{ Auth::user()->is_admin ? 'font-bold' : '' }}"
                            href="{{ route('users.show', Auth::user()->id) }}">
                            {{ Auth::user()->getName() }}
                        </a>
                    {{-- @else
                        <a class="fib-p-13 hover font-size-5 d-none d-lg-block {{ request()->routeIs('auth.login') ? 'hover-accent' : '' }}"
                            href="{{ route('auth.login') }}">Гость</a> --}}
                    @endif
                </div>
            </div>
        </div>

        @if (Auth::user() && Auth::user()->is_admin)
            <div class="bg-contrast">
                <div class="row justify-content-center">
                    <div class="col">
                        <div class="fib font-size-5">
                            <div class="fib fib-gap-21 fib-y-center color-main fib-p-8">
                                @stack('toolbar')
                            </div>
                        </div>
                    </div>

                    <div class="col col-auto">
                        <div class="fib fib-gap-21 fib-center font-size-5 fib-p-8">
                            <div class="color-second">@stack('toolbar-comment')</div>
                            <p class="color-warning">Вы в режиме Администратора</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <div class="pos-absolute pos-w-100 fib-gap-13 pointer-none">
        <div class="row">
            <div class="col">
                <div class="fib fib-col fib-p-21 font-size-6 fib-start">
                    @if (session('success'))
                        <div class="fib fib-gap-13 fib-start fib-p-8 bg-main real-shadow fib-r-21 pointer-auto">
                            <img width="21" height="21"
                                src="https://img.icons8.com/fluency-systems-regular/21/40C057/ok--v1.png"
                                alt="cancel" />
                            <p class="fib-py-2">{{ session('success') }}</p>
                            <button class="close-alert hover-opacity">
                                <img width="21" height="21"
                                    src="https://img.icons8.com/fluency-systems-regular/21/333333/cancel.png"
                                    alt="cancel" />
                            </button>
                        </div>
                    @endif

                    @if (session('warning'))
                        <div class="fib fib-gap-13 fib-start fib-p-8 bg-main real-shadow fib-r-21 pointer-auto">
                            <img width="21" height="21"
                                src="https://img.icons8.com/fluency-systems-regular/21/ffbf00/box-important--v1.png"
                                alt="cancel" />
                            <p class="fib-py-2">{{ session('warning') }}</p>
                            <button class="close-alert hover-opacity">
                                <img width="21" height="21"
                                    src="https://img.icons8.com/fluency-systems-regular/21/333333/cancel.png"
                                    alt="cancel" />
                            </button>
                        </div>
                    @endif

                    @if (isset($errors) && $errors->any())
                        <div class="fib fib-gap-13 fib-start fib-p-8 bg-main real-shadow fib-r-21 pointer-auto">
                            <img width="21" height="21"
                                src="https://img.icons8.com/fluency-systems-regular/21/FA5252/cancel-2.png"
                                alt="cancel" />
                            <ul class="fib-py-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button class="close-alert hover-opacity">
                                <img width="21" height="21"
                                    src="https://img.icons8.com/fluency-systems-regular/21/333333/cancel.png"
                                    alt="cancel" />
                            </button>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col col-auto">
                <div class="fib fib-col fib-end fib-gap-13 fib-p-21">
                    <a class="fib fib-center hover-contrast emoji escort fib-r-21 pointer-auto" href="#main"
                        style="width: 42px; height: 42px">
                        <img width="21" height="21"
                            src="https://img.icons8.com/fluency-systems-regular/21/ffffff/up--v1.png"
                            alt="вверх" />
                    </a>

                    <a class="fib fib-center hover-contrast emoji escort fib-r-21 pointer-auto" href="#footer"
                        style="width: 42px; height: 42px">
                        <img width="21" height="21"
                            src="https://img.icons8.com/fluency-systems-regular/21/ffffff/down--v1.png"
                            alt="вниз" />
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.close-alert').forEach(button => {
                button.addEventListener('click', function() {
                    this.parentElement.remove(); // Удаляет родительский элемент (уведомление)
                });
            });
        });
    </script>

</section>

<section class="fixed-bottom">
    <div class="bg-main bord-top d-block d-lg-none real-shadow-up">
        <div class="fib">
            <a class="fib fib-col fib-p-13 hover align-items-center" href="{{ route('offers.search') }}">
                <img width="34" height="34"
                    src="https://img.icons8.com/fluency-systems-regular/34/333333/search.png" alt="search" />
            </a>

            <a class="fib fib-col fib-p-13 hover align-items-center" href="{{ route('offers.index') }}">
                <img width="34" height="34"
                    src="https://img.icons8.com/fluency-systems-regular/34/333333/magazine.png"
                    alt="magazine" />
            </a>
        </div>
    </div>
</section>
