@extends('layouts.app')
@section('title', $data->title . ' : ' . $data->description)
@section('desctiption', $data->description)

@section('content')
    <section>
        <div class="container">
            <div class="fib-section">
                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <h2 class="font-size-1 font-bold">{{ $data->title }}</h2>
                            <p class="font-size-5">{{ $data->description }}</p>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center g-4">
                    @foreach ($data->link as $func)
                        <div class="col col-6 col-lg">
                            <a class="fib fib-col fib-p-21 fib-gap-8 fib-center frame font-center bg-main link" href="{{ $func->href }}">
                                <p class="font-size-1 emoji">{{ $func->icon }}</p>
                                <p class="font-size-2 color-accent">{{ $func->title }}</p>
                                <p class="font-size-5">{{ $func->description }}</p>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section id="map" class="pos-relative">
        <img class="pos-absolute pos-wallpaper"
            src="https://www.custom-wallpaper-printing.co.uk/custom/catalog/map/world-map-shutterstock_665429155.jpg"
            alt="">
        <div class="pos-absolute pos-overlay bg-accent"></div>

        <div class="container">
            <div class="fib-section">
                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center color-main">
                            <div class="row justify-content-center g-3">
                                @foreach ($data->citys as $city)
                                    @if ($city->status)
                                        <div class="col col-auto">
                                            <p class="font-size-1 font-bold">{{ $city->name }}</p>
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                            <p class="font-size-5">уже открыли, и планируем</p>

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

    <section id="form">
        <div class="container">
            <form method="POST" action="{{ route('send.discord', ['subject' => 'Обратная связь']) }}" class="fib-section">
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
