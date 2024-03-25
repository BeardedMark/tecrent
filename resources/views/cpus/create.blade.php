@extends('layouts.page')

@section('title', 'Добавление прцоессора')
@section('description', 'Заполните обязательные поля и получите доступ к остальным данным')

@section('page-content')
    <section id="form">
        <div class="row justify-content-center">
            <div class="col col-6">
                <form class="fib fib-col fib-gap-21" method="POST" action="{{ route('cpus.store') }}">
                    @csrf

                    <div class="row">
                        <div class="col">
                            <div class="fib fib-col fib-gap-13">
                                <div class="fib fib-col">
                                    <label for="manufacturer">Производитель</label>
                                    <select id="manufacturer" name="manufacturer" class="fib fib-p-8 bord-second bg-main pos-w-100" required>
                                        <option selected disabled hidden></option>
                                        <option value="Intel">Intel</option>
                                        <option value="AMD">AMD</option>
                                    </select>

                                    <p class="font-size-6 color-second">производитель прцоессора</p>
                                </div>

                                <div class="fib fib-col">
                                    <label for="name">Модель *</label>
                                    <input type="text" id="name" name="name"
                                        class="fib fib-p-8 bord-second bg-main pos-w-100"
                                        required />

                                    <p class="font-size-6 color-second">название прцоессора без производителя</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="fib fib-end">
                                <a class="fib-button hover-contrast emoji" href="{{ url()->previous() }}">❎ Отмена</a>

                                <input class="fib-button hover-contrast emoji" type="reset" value="⏮️ Сбросить">
                                <button type="submit" class="fib-button hover-accent emoji">✅ Создать</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
