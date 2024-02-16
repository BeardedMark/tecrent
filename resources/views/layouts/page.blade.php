@extends('layouts.app')

@section('content')
    <section>
        <div class="container">
            <div class="fib-section">
                <div class="row justify-content-center">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 font-center">
                            <h2 class="font-size-1 font-bold">@yield('title', env('APP_NAME'))</h2>
                            <p class="font-size-5">@yield('description')</p>
                        </div>
                    </div>
                </div>

                @yield('page-content')
            </div>
    </section>
@endsection
