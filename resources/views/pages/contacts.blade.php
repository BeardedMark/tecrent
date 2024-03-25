@extends('layouts.app')
@section('title', $data->title . ' : ' . $data->description)
@section('desctiption', $data->description)

@section('content')
    {{-- Вступление --}}
    {{-- 3 --}}

    <section class="pos-relative">
        <img class="pos-absolute pos-wallpaper"
            src="https://png.pngtree.com/background/20230618/original/pngtree-virtual-meeting-global-business-contacts-conferencing-in-3d-picture-image_3757436.jpg"
            alt="">
        <div class="pos-absolute pos-overlay bg-black"></div>

        <div class="container">
            <div class="fib-section">
                <div class="row justify-content-center">
                    <div class="col col-12 col-lg-6">
                        <div class="fib fib-col fib-gap-8 fib-center font-center color-main">
                            <h2 class="font-size-1 font-bold">{{ $data->title }}</h2>
                            <p class="font-size-5">{{ $data->description }}</p>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col col-auto">
                        <div class="fib">
                            <a class="fib-button hover-contrast" href="#social">Социальные сети</a>
                            <a class="fib-button hover-contrast" href="#citys">Города</a>
                            <a class="fib-button hover-contrast" href="#requisites">Реквизиты</a>
                            <a class="fib-button hover-contrast" href="#form">Обратная связь</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Подробности --}}
    {{-- 2 --}}

    <section>
        <div class="container">
            <div class="fib-section">
                <div class="row justify-content-center g-4">
                    @foreach ($data->link as $func)
                        <div class="col col-6 col-lg">
                            <a class="fib fib-col fib-p-21 fib-gap-8 fib-center frame font-center bg-main link"
                                href="{{ $func->href }}">
                                <p class="font-size-1 emoji">{{ $func->icon }}</p>
                                <p class="font-size-3 color-accent">{{ $func->title }}</p>
                                <p class="font-size-5">{{ $func->description }}</p>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- Социалки --}}
    {{-- 2 --}}

    <section id="social" class="bg-main">
        <div class="container">
            <div class="fib-section">
                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <h2 class="font-size-1 font-bold">Социальные сети</h2>
                            <p class="font-size-5">Стараемся быть на связи с вами везде</p>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center gy-4">
                    <div class="col col-6 col-lg-3">
                        <a href="#" class="fib fib-col fib-p-21 fib-gap-8 fib-center hover font-center pos-h-100">
                            <img width="32" height="32" src="https://img.icons8.com/windows/32/000000/vk-com--v1.png"
                                alt="vk-com--v1" />
                            <p class="font-size-3 color-accent">VKontakte</p>
                            <p class="font-size-5">(скоро)</p>
                        </a>
                    </div>

                    <div class="col col-6 col-lg-3">
                        <a href="https://wa.me/79139208405"
                            class="fib fib-col fib-p-21 fib-gap-8 fib-center hover font-center pos-h-100">
                            <img width="32" height="32"
                                src="https://img.icons8.com/windows/32/000000/whatsapp--v1.png" alt="whatsapp--v1" />
                            <p class="font-size-3 color-accent">WhatsApp</p>
                            <p class="font-size-5">8 (913) 920-84-05</p>
                        </a>
                    </div>

                    <div class="col col-6 col-lg-3">
                        <a href="#" class="fib fib-col fib-p-21 fib-gap-8 fib-center hover font-center pos-h-100">
                            <img width="32" height="32"
                                src="https://img.icons8.com/windows/32/000000/telegram-app.png" alt="telegram-app" />
                            <p class="font-size-3 color-accent">Telegram</p>
                            <p class="font-size-5">(скоро)</p>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section>

    {{-- Города --}}
    {{-- 1 --}}

    <section id="citys" class="pos-relative">
        <img class="pos-absolute pos-wallpaper"
            src="https://www.custom-wallpaper-printing.co.uk/custom/catalog/map/world-map-shutterstock_665429155.jpg"
            alt="">
        <div class="pos-absolute pos-overlay bg-accent"></div>

        <div class="container">
            <div class="fib-section">
                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center color-main">
                            <p class="font-size-5">уже открыли</p>

                            <div class="row justify-content-center g-3">
                                @foreach ($data->citys as $city)
                                    @if ($city->status)
                                        <div class="col col-auto">
                                            <p class="font-size-1 font-bold">{{ $city->name }}</p>
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                            <p class="font-size-5">скоро откроем</p>

                            <div class="row justify-content-center g-3">
                                @foreach ($data->citys as $city)
                                    @if (!$city->status)
                                        <div class="col col-auto">
                                            <p class="font-size-2 font-bold">{{ $city->name }}</p>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Реквизиты --}}
    {{-- 2 --}}

    <section id="requisites" class="bg-main">
        <div class="container">
            <div class="fib-section">
                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <h2 class="font-size-1 font-bold">Реквизиты</h2>
                            <p class="font-size-5">Для помощи в юридических моментах</p>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center align-items-center gy-4">
                    <div class="col col-12 col-lg-6">
                        <div class="row justify-content-center">
                            <div class="col">
                                <div class="fib fib-col fib-end">
                                    <p class="font-size-5 font-bold">Наименование</p>
                                    <br>
                                    <p class="font-size-5 font-bold">ИНН</p>
                                    <p class="font-size-5 font-bold">ОГРН</p>
                                    <p class="font-size-5 font-bold">ОКПО</p>
                                    <br>
                                    <p class="font-size-5 font-bold">Юридический адрес</p>
                                    <p class="font-size-5 font-bold">Фактический адрес</p>
                                    <br>
                                    <p class="font-size-5 font-bold">Банк</p>
                                    <p class="font-size-5 font-bold">БИК</p>
                                    <p class="font-size-5 font-bold">Расчетный счет</p>
                                    <p class="font-size-5 font-bold">Корр. счет</p>
                                </div>
                            </div>

                            <div class="col">
                                <div class="fib fib-col fib-start">
                                    <p class="font-size-5">ИП Синельщиков Марк Романович</p>
                                    <br>
                                    <p class="font-size-5">220421489755</p>
                                    <p class="font-size-5">323220200119280</p>
                                    <p class="font-size-5">2028602007</p>
                                    <br>
                                    <p class="font-size-5">659300, Алтайский край, г Бийск, ул Ильи Мухачева</p>
                                    <p class="font-size-5">630126, Новосибирская обл, г Новосибирск, ул Выборная</p>
                                    <br>
                                    <p class="font-size-5">СИБИРСКИЙ БАНК ПАО СБЕРБАНК</p>
                                    <p class="font-size-5">045004641</p>
                                    <p class="font-size-5">40802810944050146649</p>
                                    <p class="font-size-5">30101810500000000641</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col col-12 col-lg-6">
                        <div class="fib fib-col fib-p-21 fib-gap-13 fib-center font-center pos-h-100">
                            <img class="" style="border-radius: 100%"
                                src="https://sun4-18.userapi.com/s/v1/if2/cvRR31KTU1mNje8Sljm_hX8jh71Cl9ib-qbp_MqJf7WYY2xKvEgVib7RjUoCWne3U2ERKg_eG8bHuaGu7mB8v_j3.jpg?quality=95&crop=0,0,800,800&as=50x50,100x100,200x200,400x400&ava=1&u=331o_BWUP1E8S4G-B8CyKHXDg-iExfDyF3F5ntyy_Ac&cs=200x200"
                                alt="">

                            <div>
                                <p class="font-size-4">Руководитель проекта</p>
                                <p class="font-size-3 emoji color-accent">Синельщиков Марк Романович</p>
                                <p class="font-size-6">Для обратной связи и работе компании</p>
                            </div>

                            <a href="https://wa.me/79139208405" class="fib-button hover-accent">Связаться WhatsApp</a>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>

    {{-- Форма --}}
    {{-- 2 --}}

    <section id="form">
        <div class="container">
            <form method="POST" action="{{ route('send.discord', ['subject' => 'Обратная связь']) }}"
                class="fib-section">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <h2 class="font-size-1 font-bold">Напишите нам</h2>
                            <p class="font-size-5">Мы дадим ответ по указанным вами данным</p>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col col-12 col-md-10 col-lg-8 col-xl-6">
                        <div class="fib fib-col fib-gap-8 font-center">
                            <textarea class="fib fib-p-13 bord-second bg-main font-center" type="text" name="message" id="message"
                                placeholder="сообщение" rows="4"></textarea>
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
