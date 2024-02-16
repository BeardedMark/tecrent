@php
    $title = 'Сброс пароля';
@endphp

@extends('layouts.app')

@section('title', $title)

@section('content')
    <div class="row justify-content-center">
        <div class="col col-3">
            <div class="frame fib fib-col fib-21">
                <div class="fib fib-col fib-8">
                    <p class="font-size-4 font-bold">{{ $title }}</p>
                    <p class="font-size-6">Укажите данные пользователя, у которого требуется сбросить пароль</p>
                </div>
                <form class="frame-outline fib fib-col fib-13" method="POST" action="{{ route('password.email') }}">
                    @csrf
        
                    <div class="fib fib-col fib-gap-13">
                        <div class="fib fib-col">
                            <div class="fib fib-col">
                                <label for="name" class="fib-p-8 font-size-6">Электронная почта или логин</label>
                                <input id="name" class="action hover hover-second" type="text" name="name"
                                    value="{{ old('name') }}" required>
                            </div>
                        </div>
        
                        <button class="action hover action-bold hover-accent" type="submit">Восстановить пароль</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
