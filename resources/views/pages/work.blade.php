@extends('layouts.app')
@section('title', $data->title)
@section('description', $data->description)

@section('content')

    <section>
        <div class="container">
            <div class="fib-section">
                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <h1 class="font-size-1 font-bold">{{ $data->title }}</h1>
                            <p class="font-size-5">{{ $data->description }}</p>
                        </div>
                    </div>
                </div>

                <div class="row g-4">
                    @foreach ($data->steps as $func)
                        <div class="col col-12 col-lg-6">
                            <div class="fib fib-col fib-p-21 fib-gap-8 fib-center pos-h-100 font-center frame bg-main">
                                <h3 class="font-size-2 color-accent">{{ $func->number }}</h3>
                                <p class="font-size-5">{{ $func->title }}</p>
                                <p class="font-size-4">{{ $func->description }}</p>
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
                            <p class="font-size-4">{{ $data->content }}</p>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
