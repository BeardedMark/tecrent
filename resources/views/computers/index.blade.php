@extends('layouts.app')

@section('title', $content['title'])
@section('description', $content['description'])

@section('content')
    <section>
        <div class="container">
            <div class="fib-section">
                <div class="row justify-content-center">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <h2 class="font-size-1 font-bold">{{ $content['title'] }}</h2>
                            <p class="font-size-5">{{ $content['description'] }}</p>

                            @if (Auth::user() && Auth::user()->is_admin)
                                <div class="fib fib-center">
                                    <a class="fib-button hover-contrast emoji" href="{{ route('computers.create') }}">➕
                                        Добавить</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                @component('computers.components.list', compact('computers'))
                @endcomponent
            </div>
    </section>

    <section class="bg-main">
        <div class="container">
            <div class="fib-section fib-center font-center">
                <div class="row justify-content-center">
                    <div class="col col-12 col-md-10 col-lg-8 col-xl-6">
                        <div class="fib fib-col fib-gap-8">
                            <p class="font-size-4">{{ $content['content']}}</p>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    
    <section id="computers">
        <div class="container">
            <div class="fib-section">
                <div class="row justify-content-center">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <h2 class="font-size-1 font-bold">Подобрать по системным требованиям</h2>
                            <p class="font-size-5">Возможно вы хотите поиграть во что-то другое?</p>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center g-4">
                    @foreach ($games as $game)
                        <div class="col col-6 col-md-6 col-lg-4 col-xl-3">
                            @component('games.components.card', ['game' => $game])
                            @endcomponent

                            <p class="font-size-6 font-center fib-p-21">Аренда компьютера для {{ $game->getTitle() }}</p>
                        </div>
                    @endforeach
                </div>

                <div class="row justify-content-center">
                    <div class="col col-auto">
                        <a class="fib-button hover-accent" href="{{ route('games.index') }}">Все игры »</a>
                    </div>
                </div>
            </div>
    </section>
@endsection
