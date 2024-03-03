@extends('layouts.app')
@section('title', $data->title)
@section('description', $data->description)

@section('content')
    {{-- Вступление --}}
    {{-- 3 --}}

    <section class="pos-relative">
        <img class="pos-absolute pos-wallpaper"
            src="https://www.upsite.com/wp-content/uploads/data-center-servers-e1456255797441.jpg"
            alt="">
        <div class="pos-absolute pos-overlay bg-black"></div>

        <div class="container">
            <div class="fib-section">
                <div class="row justify-content-center">
                    <div class="col col-12 col-lg-6">
                        <div class="fib fib-col fib-gap-8 fib-center font-center color-main">
                            <h1 class="font-size-1 font-bold">{{ $data->title }}</h1>
                            <p class="font-size-5">{{ $data->description }}</p>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col col-auto">
                        <div class="fib">
                            <a class="fib-button hover-contrast" href="#games">Игровые сервера</a>
                            <a class="fib-button hover-contrast" href="#features">Приемущества</a>
                            <a class="fib-button hover-contrast" href="#servers">Готовые сервера</a>
                            <a class="fib-button hover-accent" href="#form">Заказать сервер</a>
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
                <div class="row g-4">
                    @foreach ($data->functions as $func)
                        <div class="col col-12 col-lg-4">
                            <div class="fib fib-col fib-p-21 fib-gap-8 fib-x-center pos-h-100 font-center frame bg-main">
                                <p class="font-size-1 color-accent emoji">{{ $func->title }}</p>
                                <h3 class="font-size-3">{{ $func->description }}</h3>
                                <p class="font-size-5">{{ $func->content }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- Игры --}}
    {{-- 1 --}}
    
    <section id="games" class="bg-main">
        <div class="container">
            <div class="fib-section">
                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <h2 class="font-size-1 font-bold">Аренда игрового сервера</h2>
                            <p class="font-size-5">Игры, в которых вы можете открыть свой сервер</p>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center g-4">
                    @foreach ($games as $game)
                        <div class="col col-6 col-md-6 col-lg-4 col-xl-3">
                            @component('games.components.card', ['game' => $game])
                            @endcomponent

                            <p class="font-size-6 font-center fib-p-21">Аренда сервера для {{ $game->getTitle() }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- Срок --}}
    {{-- 1 --}}

    <section id="period" class="pos-relative">
        <img class="pos-absolute pos-wallpaper"
            src="https://w.forfun.com/fetch/ae/ae2cbe4c74a79df332455ab8fe742e7c.jpeg" alt="">
        <div class="pos-absolute pos-overlay bg-dark"></div>

        <div class="container">
            <div class="fib-section">
                <div class="row justify-content-center">
                    <div class="col col-12 col-lg-6">
                        <div class="fib fib-col fib-gap-8 fib-center font-center color-main">
                            <p class="font-size-1 font-bold">12 лет</p>
                            <h2 class="font-size-3">Опыта в аренде серверов</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Преимущества --}}
    {{-- 2 --}}

    <section id="features" class="bg-main">
        <div class="container">
            <div class="fib-section">
                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <h2 class="font-size-1 font-bold">Преимущества серверов</h2>
                            <p class="font-size-5">Мы заботимся о наших клиентах и их данных</p>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center gy-4">
                    <div class="col col-6 col-lg-3">
                        <div class="fib fib-col fib-p-21 fib-gap-8 fib-center hover font-center pos-h-100">
                            <p class="font-size-1 emoji">🗓️</p>
                            <p class="font-size-3 color-accent">Круглосуточная работа</p>
                            <p class="font-size-5">Сервера всегда работают, чтобы обеспечить стабильную работу ваших серверов</p>
                        </div>
                    </div>
                    
                    <div class="col col-6 col-lg-3">
                        <div class="fib fib-col fib-p-21 fib-gap-8 fib-center hover font-center pos-h-100">
                            <p class="font-size-1 emoji">📈</p>
                            <p class="font-size-3 color-accent">Масштабируемость</p>
                            <p class="font-size-5">Помере роста ваших потребностей мы можем увеличивать мощность оборудования</p>
                        </div>
                    </div>
                    
                    <div class="col col-6 col-lg-3">
                        <div class="fib fib-col fib-p-21 fib-gap-8 fib-center hover font-center pos-h-100">
                            <p class="font-size-1 emoji">🗃️</p>
                            <p class="font-size-3 color-accent">Резервные копии</p>
                            <p class="font-size-5">Ваша информация на сервере всегда в безопасности благодаря ежедневным копиям</p>
                        </div>
                    </div>
                    
                    <div class="col col-6 col-lg-3">
                        <div class="fib fib-col fib-p-21 fib-gap-8 fib-center hover font-center pos-h-100">
                            <p class="font-size-1 emoji">🛡️</p>
                            <p class="font-size-3 color-accent">Безопасность</p>
                            <p class="font-size-5">Все наши серверы защищены современными средствами безопасности</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Сервера --}}
    {{-- 2 --}}

    <section id="servers">
        <div class="container">
            <div class="fib-section">
                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <h2 class="font-size-1 font-bold">Готовые сервера в аренду</h2>
                            <p class="font-size-5">Возможно вас заинтересуют уже готовые сервера</p>
                        </div>
                    </div>
                </div>

                <div class="row g-4">
                    @foreach ($data->servers as $server)
                        <div class="col col-12 col-lg-3">
                            <div class="fib fib-col fib-p-21 fib-gap-8 fib-x-center pos-h-100 font-center frame bg-main">
                                <p class="font-size-3 font-bold font-center link color-accent">{{ $server->name }}</p>

                                <div class="fib fib-col font-size-6 font-center pos-h-100">
                                    <p class="font-size-6">{{ $server->cpu }}</p>
                                    <p class="font-size-6">{{ $server->ram }}</p>
                                    <p class="font-size-6">{{ $server->drive }}</p>
                                </div>

                                <p class="font-size-2 font-bold">{{ $server->price }} р/м</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>


    {{-- Контент --}}
    {{-- 3 --}}

    <section class="bg-main">
        <div class="container">
            <div class="fib-section">
                <div class="row justify-content-center">
                    <div class="col col-12 col-lg-6">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <p class="font-size-4">{{ $data->content }}</p>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    {{-- Форма --}}
    {{-- 2 --}}

    <section id="form">
        <div class="container">
            <form method="POST" action="{{ route('send.discord', 'Заявка на аренду сервера') }}" class="fib-section">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <h2 class="font-size-1 font-bold">Заявка на аренду</h2>
                            <p class="font-size-5">Эти данные нужны для анализа и связи</p>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col col-12 col-md-10 col-lg-8 col-xl-6">
                        <div class="fib fib-col fib-gap-13">
                            <div class="row">
                                <div class="col">
                                    <div class="fib fib-col fib-gap-13">
                                        <div class="fib fib-col">
                                            <label for="name">Процессор</label>

                                            <select id="platform" name="platform"
                                                class="fib fib-p-13 bord-second bg-main pos-w-100">
                                                <option value="Xeon E5-2690V2">Xeon E5-2690V2</option>
                                                <option value="Xeon E5-2690V3">Xeon E5-2690V3</option>
                                                <option value="AMD EPYC 7551">AMD EPYC 7551</option>
                                                <option value="Xeon Gold 5217">Xeon Gold 5217</option>
                                                <option value="Xeon Gold 6346">Xeon Gold 6346</option>
                                            </select>

                                        </div>

                                        <div class="fib fib-col">
                                            <label for="name">Оперативка</label>

                                            <select id="ram" name="ram"
                                                class="fib fib-p-13 bord-second bg-main pos-w-100">
                                                <option value="4">4</option>
                                                <option value="8">8</option>
                                                <option value="16">16</option>
                                                <option value="32">32</option>
                                                <option value="64">64</option>
                                                <option value="128">128</option>
                                                <option value="256">256</option>
                                            </select>

                                            <p class="font-size-6 color-second">общий объем оперативной памяти</p>
                                        </div>
                                    </div>
                                </div>


                                <div class="col">
                                    <div class="fib fib-col fib-gap-13">
                                        <div class="fib fib-col">
                                            <label for="name">Тип накопителя</label>

                                            <select id="driveType" name="driveType"
                                                class="fib fib-p-13 bord-second bg-main pos-w-100">
                                                <option value="SSD">SSD</option>
                                                <option value="HDD">HDD</option>
                                                <option value="NVME U2\pci-e">NVME U2\pci-e</option>
                                                <option value="Optane 5800x">Optane 5800x</option>
                                            </select>
                                        </div>

                                        <div class="fib fib-col">
                                            <label for="name">Объем на накопителе</label>

                                            <select id="ram" name="ram"
                                                class="fib fib-p-13 bord-second bg-main pos-w-100">
                                                <option value="250 Gb">250 Gb</option>
                                                <option value="500 Gb">500 Gb</option>
                                                <option value="1 Tb">1 Tb</option>
                                                <option value="2 Tb">2 Tb</option>
                                                <option value="4 Tb">4 Tb</option>
                                                <option value="8 Tb">8 Tb</option>
                                                <option value="16 Tb">16 Tb</option>
                                            </select>

                                            <p class="font-size-6 color-second">общее необходимое место на дисках</p>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="fib fib-col">
                                <label for="name">Имя</label>

                                <input class="fib fib-p-13 bord-second bg-main font-center" type="text" name="name"
                                    id="name" value="{{ old('name') }}" required>

                                <p class="font-size-6 color-second">как мы к вам можем обращаться</p>
                            </div>

                            <div class="fib fib-col">
                                <label for="name">Телефон</label>

                                <input class="fib fib-p-13 bord-second bg-main font-center" type="text" name="phone"
                                    id="phone" value="{{ old('phone') }}" required>

                                <p class="font-size-6 color-second">куда вам позвонить в случае необходимости</p>
                            </div>

                            <div class="fib fib-col">
                                <label for="name">Email</label>

                                <input class="fib fib-p-13 bord-second bg-main font-center" type="email" name="email"
                                    id="email" value="{{ old('email') }}" required>

                                <p class="font-size-6 color-second">куда направлять сообщения и документы</p>
                            </div>

                            <div class="fib fib-col">
                                <label for="name">Сообщение</label>

                                <textarea class="fib fib-p-13 bord-second bg-main font-center" type="text" name="message" id="message"
                                    rows="4"></textarea>

                                <p class="font-size-6 color-second">любое уточнение в свободной форме</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col col-12 col-md-10 col-lg-8 col-xl-6">
                        <div class="fib fib-gap-8 fib-center font-center">
                            <button class="fib-button hover-accent" type="submit">Оформить</button>
                        </div>
                    </div>
                </div>

            </form>
    </section>
@endsection
