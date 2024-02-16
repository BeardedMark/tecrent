@extends('layouts.app')

@section('title')
    {{ $title = $user->name }}
@endsection

@section('content')
    <div class="frame fib fib-col fib-21">
        <a href="{{ route('users.index') }}" class="frame-outline fib fib-row fib-13">
            <div class="flex-col fib-8">
                <p class="font-size-4 font-bold">{{ Auth::user()->name }}</p>
                <p class="t-small">{{ Auth::user()->email }}</p>
            </div>
        </a>

        <div class="frame-outline fib fib-col fib-13">
            <div class="flex-col">
                <a class="action hover" href="{{ route('users.index') }}">
                    <img class="image-16" src="https://img.icons8.com/small/16/333333/bank-card-front-side.png" />Мои
                    Профили</a>

                <a class="action hover" href="#">
                    <img class="image-16" src="https://img.icons8.com/small/16/333333/bookmark-ribbon--v1.png" />Мои
                    Подписки</a>

                <form method="POST" action="{{ route('auth.logout') }}">
                    @csrf
                    <button class="action hover w-100" type="submit"><img class="image-16"
                            src="https://img.icons8.com/small/16/FA5252/exit.png" /><span class="color-danger">Выйти из
                            аккаунта</span></button>
                </form>
            </div>
        </div>

    </div>
@endsection
