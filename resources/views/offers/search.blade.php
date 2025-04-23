@extends('layouts.app')

@section('title', 'Поиск техники и услуг — подберите нужное оборудование')
@section('description', 'Подберите подходящую технику, товары или услуги по фильтрам. Удобный поиск и быстрая аренда с доставкой')
@section('keywords', 'поиск оборудования, аренда техники, фильтр предложений, Tecrent, аренда компьютеров, услуги')

@section('content')
    @if ($offers)
        <section>
            <div class="container-fluid">
                <div class="fib-section">
                    <div class="row justify-content-center">
                        <div class="col">
                            <div class="fib fib-col fib-gap-8 fib-center font-center">
                                <h2 class="font-size-1 font-bold">{{ $title }}</h2>
                                <p class="font-size-5">Список подходящих предложений</p>
                            </div>
                        </div>
                    </div>

                    @if (count($offers) > 0)
                        @component('offers.components.list', compact('offers'))
                        @endcomponent
                    @else
                        <div class="row justify-content-center">
                            <div class="col col-auto">
                                <div class="fib fib-col fib-gap-13 fib-center font-center">

                                    <img width="55" height="55"
                                        src="https://img.icons8.com/fluency-systems-regular/55/333333/nothing-found.png"
                                        alt="nothing-found" />
                                    <p>Ничего не найдено</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="row justify-content-center">
                        <div class="col col-auto">
                            <a class="fib-button hover-contrast" href="{{ route('offers.index') }}">Каталог предложений</a>
                        </div>
                    </div>
                </div>
        </section>
    @else
        <section>
            <div class="container">
                <div class="fib-section">
                    <div class="row justify-content-center">
                        <div class="col">
                            <div class="fib fib-col fib-gap-8 fib-center font-center">
                                <h2 class="font-size-1 font-bold">Поиск по каталогу</h2>
                                <p class="font-size-5">Введите запрос или воспользуйтесь быстрыми ссылками</p>
                            </div>
                        </div>
                    </div>

                    <div class="fib fib-col fib-gap-13">
                        <form class="fib fib-gap-13 fib-p-21 bg-main fib-r-21 fib-center">
                            <a href="{{ route('offers.index') }}" class="fib">
                                <img width="34" height="34"
                                    src="https://img.icons8.com/fluency-systems-regular/34/333333/magazine.png"
                                    alt="magazine" />
                            </a>
                            <input class="fib-grow font-size-2 font-center" type="text" name="substring">
                            <button type="submit">
                                <img width="34" height="34"
                                    src="https://img.icons8.com/fluency-systems-regular/34/333333/search.png"
                                    alt="search" />
                            </button>
                        </form>

                    </div>

                    <div class="fib fib-col fib-gap-13">
                        <p class="fib fib-row fib-wrap fib-gap-13 fib-center">
                            @foreach ($types as $type)
                                <a class="fib-button hover-main"
                                    href="{{ route('offers.search', ['type' => $type]) }}">{{ $type }}</a>
                            @endforeach
                        </p>
                        <p class="fib fib-row fib-wrap fib-gap-13 fib-center">
                            @foreach ($groups as $group)
                                <a class="fib-button hover-main"
                                    href="{{ route('offers.search', ['group' => $group]) }}">{{ $group }}</a>
                            @endforeach
                        </p>
                        <p class="fib fib-row fib-wrap fib-gap-13 fib-center">
                            @foreach ($tags as $tag)
                                <a class="fib-button hover-main"
                                    href="{{ route('offers.search', ['tags' => $tag]) }}">{{ $tag }}</a>
                            @endforeach
                        </p>
                    </div>
                </div>
        </section>
    @endif
@endsection
