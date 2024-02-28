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
                    @foreach ($data->functions as $func)
                        <div class="col col-12 col-lg-4">
                            <div class="fib fib-col fib-p-21 fib-gap-8 fib-x-center pos-h-100 font-center frame bg-main">
                                <h3 class="font-size-3 color-accent">{{ $func->title }}</h3>
                                <p class="font-size-4">{{ $func->description }}</p>
                                <p class="font-size-5">{{ $func->content }}</p>
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
                    <div class="col col-12 col-lg-6">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <p class="font-size-4">{{ $data->content }}</p>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <section>
        <div class="container">
            <div class="fib-section">
                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <h1 class="font-size-1 font-bold">Наша команда</h1>
                            <p class="font-size-5">Мы - энтузиасты, и хотим помочь людям с помощью наших навыков и
                                возможностей</p>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    @foreach ($data->team as $person)
                        <div class="col col-12 col-lg-3">
                            <div class="fib fib-col fib-p-21 fib-gap-8 fib-x-center pos-h-100 font-center">
                                <img width="128px" src="{{ $person->image }}" alt="">
                                <h3 class="font-size-2 color-accent">{{ $person->name }}</h3>
                                <p class="font-size-4">{{ $person->description }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
