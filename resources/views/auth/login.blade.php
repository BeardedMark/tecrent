@extends('layouts.app')

@section('title')
    Войти
@endsection

@section('content')
    <section>
        <div class="container">
            <div class="fib-section">
                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <h1 class="font-size-1 font-bold">Вход</h1>
                            <p class="font-size-5">Доступ к аккаунту на сайте</p>

                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col col-12 col-md-10 col-lg-8 col-xl-6">

                        <form class="fib fib-col fib-gap-34 font-center" method="POST" action="{{ route('auth.login') }}">
                            @csrf

                            <div class="fib fib-col fib-gap-8">
                                <div class="fib fib-col fib-gap-5">
                                    <input id="login" class="fib fib-p-13 bord-second bg-main font-center"
                                        type="email" name="login" placeholder="логин" value="{{ old('login') }}"
                                        required autofocus>
                                </div>

                                <div class="fib fib-col fib-gap-5">
                                    <input id="password" class="fib fib-p-13 bord-second bg-main font-center"
                                        type="password" name="password" placeholder="пароль" required>
                                </div>
                            </div>

                            <div class="fib fib-gap-8 fib-center font-center">
                                <a href="{{ route('auth.register') }}"
                                    class="fib-button hover-contrast">Регистрация</a>
                                <button type="submit" class="fib-button hover-accent">Войти</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
