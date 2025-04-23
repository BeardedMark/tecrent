@extends('layouts.app')
@section('title', 'Страница не найдена')
@section('description', 'Прошу прощения, но страница, которую вы запрашиваете, не существует. Можете попробовать вернуться на главную страницу и найти нужную информацию там')

@section('content')
    <section>
        <div class="container">
            <div class="fib-section">
                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <h1 class="font-size-1 font-bold">Страница не найдена</h1>
                            <p class="font-size-5">Извините, но мы не можем найти страницу, которую вы ищете. Попробуйте вернуться на главную страницу и найти нужную информацию там.</p>
                            <img width="96" height="96" src="https://img.icons8.com/fluency-systems-regular/96/333333/page-not-found.png" alt="page-not-found"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
