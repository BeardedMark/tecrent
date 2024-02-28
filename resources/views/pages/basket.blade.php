@extends('layouts.app')

@section('title', env('APP_NAME') . ' : Заказ')

@section('content')

    @if (!count($cartItems))
        <section>
            <div class="container">
                <div class="fib-section">
                    <div class="row">
                        <div class="col">
                            <div class="fib fib-col fib-gap-8 fib-center font-center">
                                <h1 class="font-size-1 font-bold">Ваш заказ пуст</h1>
                                <p class="font-size-5">Посетите каталог для подбора компьютера</p>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col col-auto">
                            <a class="fib-button hover-accent" href="{{ route('computers.index') }}">Каталог
                                »</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @else
        <section>
            <div class="container">
                <div class="fib-section">
                    <div class="row">
                        <div class="col">
                            <div class="fib fib-col fib-gap-8 fib-center font-center">
                                <h1 class="font-size-1 font-bold">Ваш заказ</h1>
                                <p class="font-size-5">Проверьте правильность заказа перед оформлением</p>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center g-4">
                        @foreach ($cartItems as $id)
                            <div class="col col-12">
                                @component('computers.components.line', ['computer' => \App\Models\Computer::find($id)])
                                @endcomponent
                            </div>
                        @endforeach

                        <div class="col col-12">
                            <a href="{{ route('computers.index') }}"
                                class="fib fib-col fib-p-21 bord-second font-center hover-second font-size-4">добавить</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <form method="POST" action="{{ route('basket.send') }}">
            @csrf
            <section class="bg-main">
                <div class="container">
                    <div class="fib-section">
                        <div class="row">
                            <div class="col">
                                <div class="fib fib-col fib-gap-8 fib-center font-center">
                                    <h2 class="font-size-1 font-bold">Калькулятор</h2>
                                    <p class="font-size-5">Укажите период аренды и мы посчитаем цену</p>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center g-4">
                            <div class="col col-6 col-lg-3">
                                <div class="fib fib-col fib-p-21 fib-gap-8 fib-center font-center">
                                    <p class="font-size-large color-accent">{{ count($cartItems) }}</p>
                                    <p class="font-size-5">Позиций</p>
                                </div>
                            </div>

                            <div class="col col-6 col-lg-3">
                                <div class="fib fib-col fib-p-21 fib-gap-8 fib-center font-center">
                                    <p class="font-size-large color-accent" id="price_day">{{ $cardSumm }}</p>
                                    <p class="font-size-5">Рублей в день</p>
                                </div>
                            </div>

                            <div class="col col-6 col-lg-3">
                                <div class="fib fib-col fib-p-21 fib-gap-8 fib-center font-center">
                                    <p class="font-size-large color-accent" id="rent_days">0</p>
                                    <p class="font-size-5">Дней аренды</p>
                                </div>
                            </div>

                            <div class="col col-6 col-lg-3">
                                <div class="fib fib-col fib-p-21 fib-gap-8 fib-center font-center">
                                    <p class="font-size-large color-accent" id="cart_summ">0</p>
                                    <p class="font-size-5">Сумма</p>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center g-4">
                            <div class="col col-6 col-xl-3">
                                <input class="fib fib-p-21 pos-w-100 hover-second font-size-4 font-center" type="text"
                                    name="start_date" id="start_date" autocomplete="off" placeholder="дата начала"
                                    value="{{ old('start_date') }}" required>
                            </div>

                            <div class="col col-6 col-xl-3">
                                <input class="fib fib-p-21 pos-w-100 hover-second font-size-4 font-center" type="text"
                                    name="end_date" id="end_date" autocomplete="off" placeholder="дата окончания"
                                    value="{{ old('end_date') }}" required>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="form">
                <div class="container">
                    <div class="fib-section">
                        <div class="row">
                            <div class="col">
                                <div class="fib fib-col fib-gap-8 fib-center font-center">
                                    <h2 class="font-size-1 font-bold">Оформление</h2>
                                    <p class="font-size-5">Эти данные помогут нам связаться с вами</p>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col col-12 col-md-10 col-lg-8 col-xl-6">
                                <div class="fib fib-col fib-gap-8 font-center">
                                    <input class="fib fib-p-13 bord-second bg-main font-center" type="text"
                                        name="name" id="name" placeholder="ваше имя" value="{{ old('name') }}"
                                        required>
                                    <input class="fib fib-p-13 bord-second bg-main font-center" type="text"
                                        name="phone" id="phone" placeholder="контактный телефон"
                                        value="{{ old('phone') }}" required>
                                    <input class="fib fib-p-13 bord-second bg-main font-center" type="email"
                                        name="email" id="email" placeholder="электронная почта"
                                        value="{{ old('email') }}" required>
                                    <input class="fib fib-p-13 bord-second bg-main font-center" type="text"
                                        name="message" id="message"" placeholder="текст сообщения">
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
                    </div>
            </section>
        </form>
    @endif
@endsection
