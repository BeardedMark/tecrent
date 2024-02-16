@php
    $title = 'Установить пароль';
@endphp

@extends('layouts.app')

@section('title', $title)

@section('content')
    <div class="row justify-content-center">
        <div class="col col-3">
            <div class="frame fib fib-col fib-21">
                <div class="fib fib-col fib-8">
                    <p class="font-size-4 font-bold">{{ $title }}</p>
                    <p class="font-size-6">Войдите в свой профиль с помощью персональных данных</p>
                </div>

                <form class="frame-outline fib fib-col fib-13" method="POST" action="{{ route('password.request') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->token }}">
        
                    <div class="fib fib-col fib-gap-13">
                        <div class="fib fib-col">
                            <div class="fib fib-col">
                                <label for="email" class="fib-p-8 font-size-6">Электронная почта</label>
                                <input id="email" class="action hover hover-second" type="text" name="email"
                                    value="{{ $request->email }}" required>
                            </div>
        
                            <div class="fib fib-col">
                                <label for="password" class="fib-p-8 font-size-6">Будущий пароль</label>
                                <input id="password" class="action hover hover-second" type="password" name="password" required>
                            </div>
        
                            <div class="fib fib-col">
                                <label for="password_confirmation" class="fib-p-8 font-size-6">Подтверждение
                                    пароля</label>
                                <input id="password_confirmation" class="action hover hover-second" type="password"
                                    name="password_confirmation" required>
                            </div>
                        </div>
        
                        <button class="action hover action-bold hover-accent" type="submit">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
