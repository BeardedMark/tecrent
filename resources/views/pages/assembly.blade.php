@extends('layouts.app')
@section('title', $data->title)
@section('description', $data->description)

@section('content')
    {{-- Вступление --}}
    {{-- 3 --}}

    <section class="pos-relative">
        <img class="pos-absolute pos-wallpaper"
            src="https://www.scientific-computing.com/sites/default/files/content/product-focus/lead-image/Kreabobek%20shutterstock_1089987059.jpg"
            alt="">
        <div class="pos-absolute pos-overlay bg-black"></div>

        <div class="container">
            <div class="fib-section">
                <div class="row justify-content-center">
                    <div class="col col-12 col-lg-6">
                        <div class="fib fib-col fib-gap-8 fib-center font-center color-main">
                            <h1 class="font-size-1 font-bold">{{ $data->title }}</h1>
                            <p class="font-size-5">{{ $data->description }}</p>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col col-auto">
                        <div class="fib">
                            <a class="fib-button hover-contrast" href="#constructor">Подбор игр</a>
                            <a class="fib-button hover-contrast" href="#computers">Готовые сборки</a>
                            <a class="fib-button hover-contrast" href="#form">Заказать сборку</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Подробности --}}
    {{-- 2 --}}

    <section>
        <div class="container">
            <div class="fib-section">
                <div class="row g-4">
                    @foreach ($data->functions as $func)
                        <div class="col col-12 col-lg-3">
                            <div class="fib fib-col fib-p-21 fib-gap-8 fib-x-center pos-h-100 font-center frame bg-main">
                                <h3 class="font-size-1 color-accent emoji">{{ $func->title }}</h3>
                                <p class="font-size-4">{{ $func->description }}</p>
                                <p class="font-size-5">{{ $func->content }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- Конфигуратор --}}
    {{-- 1 --}}

    <section id="constructor">
        <div class="container">
            <div class="fib-section">
                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <h1 class="font-size-1 font-bold">Конфигарутор</h1>
                            <p class="font-size-5">Подборк игр по системным требованиям к комплектующим</p>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col">
                        <form class="fib fib-col fib-gap-21">
                            <div class="row justify-content-center">
                                <div class="col col-12 col-lg-6">
                                    <div class="fib fib-gap-13">
                                        <div class="fib fib-col fib-center font-center">
                                            <label for="gpu_id">Видеокарта</label>
                                            <select id="gpu_id" name="gpu_id"
                                                class="fib fib-p-8 bord-second bg-main pos-w-100">
                                                <option class="font-center" value="">нет</option>
                                                @foreach ($gpus as $gpu)
                                                    <option class="font-center" value="{{ $gpu->id }}">
                                                        {{ $gpu->getTitle() }}</option>
                                                @endforeach
                                            </select>

                                            <p class="font-size-6 color-second">выберите видеокарту для подбора</p>
                                        </div>

                                        <div class="fib fib-col fib-center font-center">
                                            <label for="cpu_id">Процессор</label>
                                            <select id="cpu_id" name="cpu_id"
                                                class="fib fib-p-8 bord-second bg-main pos-w-100">
                                                <option class="font-center" value="">нет</option>
                                                @foreach ($cpus as $cpu)
                                                    <option class="font-center" value="{{ $cpu->id }}">
                                                        {{ $cpu->getTitle() }}</option>
                                                @endforeach
                                            </select>

                                            <p class="font-size-6 color-second">выберите процессор для подбора</p>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    $('#gpu_id, #cpu_id').change(function() {
                                        var gpuId = $('#gpu_id').val();
                                        var cpuId = $('#cpu_id').val();
                                        var data = {};

                                        data.limit = 4;

                                        if (gpuId) {
                                            data.gpu_id = gpuId;
                                        }

                                        if (cpuId) {
                                            data.cpu_id = cpuId;
                                        }

                                        $.ajax({
                                            url: "{{ route('games.list') }}",
                                            method: "GET",
                                            data: data,
                                            success: function(data) {
                                                $("#games").html(data.view);
                                            },
                                            error: function() {
                                                alert("Ошибка загрузки игр");
                                            }
                                        });
                                    });

                                    $('#constructor').submit(function(event) {
                                        event.preventDefault();

                                        var formData = $(this).serializeArray();

                                        formData = formData.filter(function(item) {
                                            return item.value !== '';
                                        });

                                        var data = {};
                                        formData.forEach(function(item) {
                                            data[item.name] = item.value;
                                        });

                                        var url = "{{ route('games.index') }}";
                                        if (data.gpu_id) {
                                            url += "?gpu_id=" + data.gpu_id;
                                        }
                                        if (data.cpu_id) {
                                            url += "&cpu_id=" + data.cpu_id;
                                        }

                                        window.location.href = url;
                                    });
                                </script>
                            </div>

                            <div class="row">
                                <div id="games" class="col">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="fib fib-center">
                                        <button type="submit" class="fib-button hover-accent emoji">Посмотреть все</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Портфолио --}}
    {{-- 2 --}}

    <section id="computers">
        <div class="container">
            <div class="fib-section">
                <div class="row justify-content-center">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <h2 class="font-size-1 font-bold">Портфолио наших сборок</h2>
                            <p class="font-size-5">Все сборки в нашем каталоге аренды собраны нами</p>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center g-4">
                    @foreach ($computers as $computer)
                        <div class="col col-6 col-md-6 col-lg-4 col-xl-3">
                            @component('computers.components.card', ['computer' => $computer])
                            @endcomponent
                        </div>
                    @endforeach
                </div>

                <div class="row justify-content-center">
                    <div class="col col-auto">
                        <a class="fib-button hover-accent" href="{{ route('computers.index') }}">Все сборки »</a>
                    </div>
                </div>
            </div>
    </section>

    {{-- Контент --}}
    {{-- 3 --}}

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

    {{-- Форма --}}
    {{-- 2 --}}

    <section id="form">
        <div class="container">
            <form method="POST" action="{{ route('send.discord', ['subject' => 'Заявка на сборку компьютера']) }}"
                class="fib-section">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <h2 class="font-size-1 font-bold">Заявка на подбор</h2>
                            <p class="font-size-5">Эти данные нужны для анализа и связи</p>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col col-12 col-md-10 col-lg-8 col-xl-6">
                        <div class="fib fib-col fib-gap-8 font-center">
                            <input class="fib fib-p-13 bord-second bg-main font-center" type="text" name="name"
                                id="name" placeholder="ваше имя" value="{{ old('name') }}" required>
                            <input class="fib fib-p-13 bord-second bg-main font-center" type="text" name="phone"
                                id="phone" placeholder="контактный телефон" value="{{ old('phone') }}" required>
                            <input class="fib fib-p-13 bord-second bg-main font-center" type="email" name="email"
                                id="email" placeholder="электронная почта" value="{{ old('email') }}" required>
                            <input class="fib fib-p-13 bord-second bg-main font-center" type="number" name="money"
                                id="money" placeholder="ваш бюджет" value="{{ old('email') }}" required>
                            <textarea class="fib fib-p-13 bord-second bg-main font-center" type="text" name="message" id="message"
                                placeholder="опишите свою потребность" rows="4"></textarea>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col col-12 col-md-10 col-lg-8 col-xl-6">
                        <div class="fib fib-gap-8 fib-center font-center">
                            <button class="fib-button hover-accent" type="submit">Оформить</button>
                        </div>
                    </div>
                </div>

            </form>
    </section>
@endsection
