@extends('layouts.app')

@section('title')
    Регистрация
@endsection

@section('content')
    <section>
        <div class="container">
            <div class="fib-section">
                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <h1 class="font-size-1 font-bold">Регистрация</h1>
                            <p class="font-size-5">Создание нового аккаунта на сайте</p>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col col-12 col-md-10 col-lg-8 col-xl-6">
                        <form class="fib fib-col fib-gap-34 font-center" method="POST" action="{{ route('auth.register') }}">
                            @csrf

                            <div class="fib fib-col fib-gap-8">
                                <div class="fib fib-col fib-gap-5">
                                    <input id="login" class="fib fib-p-13 bord-second bg-main font-center" type="text" name="login" placeholder="Логин"
                                        value="{{ old('login') }}" required autofocus>
                                </div>
    
                                <div class="fib fib-col fib-gap-5">
                                    <input id="email" class="fib fib-p-13 bord-second bg-main font-center" type="email" name="email" placeholder="Email"
                                        value="{{ old('email') }}" required>
                                </div>
    
                                <div class="fib fib-col fib-gap-5">
                                    <input id="password" class="fib fib-p-13 bord-second bg-main font-center" type="password" name="password" placeholder="Пароль" required>
                                </div>
    
                                <div class="fib fib-col fib-gap-5">
                                    <input id="password_confirmation" class="fib fib-p-13 bord-second bg-main font-center" type="password"
                                        name="password_confirmation" placeholder="Подтверждение пароля" required>
                                </div>
                            </div>
                            
                            <div class="fib fib-gap-8 fib-center font-center">
                                <a href="{{ route('auth.login') }}" class="fib-button hover-contrast">Вход</a>
                                <button type="submit" class="fib-button hover-accent">Регистрация</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </section>
@endsection
