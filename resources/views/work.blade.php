@php
    $content = json_decode(file_get_contents(storage_path('content/work.json')), true);
@endphp

@extends('layouts.app')
@section('title', $content['title'])
@section('description', $content['description'])

@section('content')

    <section>
        <div class="container">
            <div class="fib-section">
                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <h1 class="font-size-1 font-bold">{{ $content['title'] }}</h1>
                            <p class="font-size-5">{{ $content['description'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="row g-4">
                    @foreach ($content['steps'] as $func)
                        <div class="col col-12 col-lg-6">
                            <div class="fib fib-col fib-p-21 fib-gap-8 fib-center pos-h-100 font-center frame bg-main">
                                <h3 class="font-size-2 color-accent">{{ $func['number'] }}</h3>
                                <p class="font-size-5">{{ $func['title'] }}</p>
                                <p class="font-size-4">{{ $func['description'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="bg-main">
        <div class="container">
            <div class="fib-section">
                <div class="row justify-content-center">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <p class="font-size-4">{{ $content['content'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
