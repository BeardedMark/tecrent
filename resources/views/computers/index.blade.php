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
                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8">
                            <p class="font-size-4">{{ $content['content']}}</p>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
