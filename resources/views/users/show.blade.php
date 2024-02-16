@php
    // $user = Auth::user();
    $title = 'Личный кабинет ' . $user->name;
@endphp

@extends('layouts.app')

@section('title', $title)

@section('content')
    <section>
        <div class="container">
            <div class="fib-section">
                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <h1 class="font-size-1 font-bold">Личный кабинет</h1>
                            <p class="font-size-5">Здесь доступна вся информация о пользователе сайта</p>
                        </div>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <div class="fib-p-8">
                                <p class="color-second">Персональный Логин</p>
                                <p class="font-size-3 font-bold color-accent">{{ $user->name }}</p>
                            </div>

                            <div class="fib-p-8">
                                <p class="color-second">Персональный номер id</p>
                                <p class="font-size-5">{{ $user->id }}</p>
                            </div>

                            <div class="fib-p-8">
                                <p class="color-second">Персональный Email</p>
                                <p class="font-size-5">{{ $user->email }}</p>
                            </div>

                            <div class="fib-p-8">
                                <p class="color-second">Профиль прав</p>
                                <p class="font-size-5">{{ $user->is_admin ? 'Администратор' : 'Пользователь' }}</p>
                                @if ($user->is_admin)
                                    <a class="fib-button hover-second"
                                        href="{{ route('admin') }}">Управление »</a>
                                @endif
                            </div>

                            <div class="fib-p-8">
                                <p class="color-second">Дата регистрации</p>
                                <p class="font-size-5">{{ $user->created_at }}</p>
                            </div>

                            @if ($user->updated_at != $user->created_at)
                                <div class="fib-p-8">
                                    <p class="color-second">Дата обновления</p>
                                    <p class="font-size-5">{{ $user->updated_at }}</p>
                                </div>
                            @endif

                            @if ($user->deleted_at)
                                <div class="fib-p-8 color-danger">
                                    <p>Дата удаления</p>
                                    <p class="font-size-5">{{ $user->deleted_at }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col">
                        <div class="fib fib-gap-8 fib-center font-center">
                            <form method="POST" action="{{ route('auth.logout') }}">
                                @csrf
                                <button class="fib-button hover-accent" type="submit">Выйти</button>
                            </form>
                            <a class="fib-button hover-contrast"
                                href="{{ route('users.edit', compact('user')) }}">Редактировать</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
