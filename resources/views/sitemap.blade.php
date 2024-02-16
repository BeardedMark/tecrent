@php
    $content = json_decode(file_get_contents(storage_path('content/navigate.json')), true);
@endphp

@extends('layouts.app')
@section('title', 'Карта сайта')

@section('content')
    <div class="container">
        <div class="fib-section">
            <div class="row">
                <div class="col">
                    <div class="fib fib-col fib-gap-8 font-center">
                        <h2 class="font-size-1 font-bold">{{ $content['title'] }}</h2>
                        <p class="font-size-5">{{ $content['description'] }}</p>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center g-1">
                @foreach ($content['routes'] as $func)
                    <a href="{{ route($func['route']) }}" class="col col-6 col-lg-3">
                        <div class="fib fib-col fib-py-55 fib-gap-8 font-center color-second link pos-relative">

                            <img class="pos-absolute pos-wallpaper"
                                src="{{ $func['image'] }}"
                                alt="">
                            <div class="pos-absolute pos-overlay bg-contrast"></div>
                            <p class="font-size-3 font-bold">{{ $func['title'] }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <section class="bg-main">
        <div class="container">
            <div class="fib-section font-center">
                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8">
                            <p class="font-size-4">{{ $content['content'] }}</p>
                            
                            {{-- <div class="pos bg-contrast">
                                <p class="fib-p-13 bg-accent pos-w-min">sda</p>
                                <p class="fib-p-13 bg-accent">sda</p>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
