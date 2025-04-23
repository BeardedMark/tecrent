@extends('layouts.app')
@section('title', $data['title'])
@section('description', $data['description'])
@section('keywords', $data['keywords'])

@section('content')
    <section class="pos-relative overflow-hidden">
        <video class="pos-absolute pos-wallpaper" autoplay muted loop>
            <source src="{{ asset('video/cinematic.mp4') }}" type="video/mp4">
        </video>
        <div class="pos-absolute pos-overlay bg-black"></div>

        <div class="container">
            <div class="fib-section">
                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-center font-center color-main">
                            <p class="font-size-large font-bold">
                                <span class="color-accent">TEC</span>RENT
                            </p>

                            <div class="fib fib-col fib-gap-13">
                                <h1 class="font-size-2">{{ $data['title'] }}</h1>
                                <p class="font-size-5">{{ $data['description'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col col-auto">
                        <a class="fib-button hover-accent" href="{{ route('offers.index') }}">Посмотреть каталог</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @foreach ($data['sections'] as $section)
        @component('components.section', $section)
        @endcomponent
    @endforeach
@endsection
