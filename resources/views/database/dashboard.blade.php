@extends('layouts.app')

@section('title', 'Панель администратора')
@section('description', 'Выберите раздел для начала управления')

@section('frame')
    <div class="row g-4">
        <div class="col col-6 col-lg-3">
            <a href="https://www.google.com/search?q=site%3Atecrent.ru&oq=site%3Atecrent.ru&gs_lcrp=EgZjaHJvbWUyBggAEEUYOTIGCAEQRRg60gEINzQ1OWowajeoAgCwAgA&sourceid=chrome&ie=UTF-8"
                class="fib fib-col fib-p-21 fib-gap-8 fib-center frame font-center pos-h-100 bg-main">
                <p class="font-size-1 emoji">🔍</p>
                <p class="font-size-2 color-accent">Google.Search</p>
                <p class="font-size-5">Страницы в google</p>
            </a>
        </div>

        <div class="col col-6 col-lg-3">
            <a href="https://search.google.com/search-console?resource_id=sc-domain%3Atecrent.ru"
                class="fib fib-col fib-p-21 fib-gap-8 fib-center frame font-center pos-h-100 bg-main">
                <p class="font-size-1 emoji">🔍</p>
                <p class="font-size-2 color-accent">Google.Console</p>
                <p class="font-size-5">Статистика сайта</p>
            </a>
        </div>
        
        <div class="col col-6 col-lg-3">
            <a href="https://ya.ru/search/?text=site%3Atecrent.ru&lr=65&p=1"
                class="fib fib-col fib-p-21 fib-gap-8 fib-center frame font-center pos-h-100 bg-main">
                <p class="font-size-1 emoji">🔍</p>
                <p class="font-size-2 color-accent">Яндекс.Search</p>
                <p class="font-size-5">Страницы в yandex</p>
            </a>
        </div>

        <div class="col col-6 col-lg-3">
            <a href="https://wordstat.yandex.ru/"
                class="fib fib-col fib-p-21 fib-gap-8 fib-center frame font-center pos-h-100 bg-main">
                <p class="font-size-1 emoji">🔍</p>
                <p class="font-size-2 color-accent">Яндекс.Wordstat</p>
                <p class="font-size-5">Подбор слов</p>
            </a>
        </div>
    </div>
@endsection

@section('content')
    <section>
        <div class="container-fluid">
            <div class="fib-section">
                <div class="row">
                    <div class="col-2">
                        <div class="fib fib-col fib-gap-8">
                            <div class="fib fib-col fib-px-21">
                                <p class="font-size-1 font-bold color-accent">{{ env('APP_NAME') }}</p>
                                <p class="font-size-5">Панель управления сайтом</p>
                            </div>
                        </div>
                    </div>


                    <div class="col">
                        <div class="fib fib-col fib-gap-8">
                            <div class="fib fib-col">
                                <p class="font-size-1 font-bold">@yield('title')</p>
                                <p class="font-size-5">@yield('description')</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col col-2">
                        <div class="fib fib-col fib-gap-8">
                            <div class="fib fib-col fib-py-13 frame bg-main">
                                {{-- <a class="fib-button hover emoji" href="{{ route('admin', Auth::user()->id) }}">👑
                                    Adminboard</a> --}}
                                <a class="fib-button hover emoji" href="{{ route('tables.index') }}">🗃️
                                    Database</a>
                                <a class="fib-button hover emoji" href="{{ route('backups.index') }}">📦
                                    Backups</a>
                                <a class="fib-button hover emoji lock" href="{{ route('content.index') }}">📰
                                    Контент</a>
                                <a class="fib-button hover emoji lock" href="{{ route('content.index') }}">📎
                                    Файлы</a>
                                <a class="fib-button hover emoji lock" href="{{ route('content.index') }}">⚙️
                                    Настройки</a>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="fib fib-col fib-gap-8">
                            @yield('frame')
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
