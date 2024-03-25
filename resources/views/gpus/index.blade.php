@extends('layouts.app')

@section('title', $title)
@section('description', $description)

@section('content')
    <section>
        <div class="container">
            <div class="fib-section">
                <div class="row justify-content-center">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <h2 class="font-size-1 font-bold">{{ $title }}</h2>
                            <p class="font-size-5">{{ $description }}</p>

                            @if (Auth::user() && Auth::user()->is_admin)
                                <div class="fib fib-center">
                                    <a class="fib-button hover-contrast emoji" href="{{ route('gpus.create') }}">➕
                                        Добавить</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                @component('gpus.components.grid', compact('gpus'))
                @endcomponent

                <div class="row justify-content-center">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <p class="font-size-6 color-second">всего записей : {{ count($gpus) }}</p>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
