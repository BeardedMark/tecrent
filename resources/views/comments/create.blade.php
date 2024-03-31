@extends('layouts.page')

@section('title', 'Добавление комментария')
@section('description', 'Заполните обязательные поля и получите доступ к остальным данным')

@section('page-content')
    <section id="form">
        <div class="row justify-content-center">
            <div class="col col-6">
                <form class="fib fib-col fib-gap-21" method="POST" action="{{ route('comments.store', compact('post')) }}">
                    @csrf

                    <div class="row">
                        <div class="col">
                            <div class="fib fib-col fib-gap-13">
                                {{-- <div class="fib fib-col">
                                    <label for="commentable_type">Тип владельца</label>
                                    <select id="commentable_type" name="commentable_type" class="fib fib-p-8 bord-second bg-main pos-w-100" required>
                                        <option selected disabled hidden></option>
                                        <option value="App\Models\Post">Пост</option>
                                        <option value="App\Models\Computer">Компьютер</option>
                                        <option value="App\Models\Game">Игра</option>
                                    </select>

                                    <p class="font-size-6 color-second">производитель видеочипа</p>
                                </div>

                                <div class="fib fib-col">
                                    <label for="commentable_id">Номер владельца</label>
                                    <input type="number" id="commentable_id" name="commentable_id"
                                        class="fib fib-p-8 bord-second bg-main pos-w-100"
                                        required />

                                    <p class="font-size-6 color-second">название видеокарты бех производителя</p>
                                </div>

                                <div class="fib fib-col">
                                    <label for="user_id">Автор</label>
                                    <input type="number" id="user_id" name="user_id"
                                        class="fib fib-p-8 bord-second bg-main pos-w-100"
                                        required />

                                    <p class="font-size-6 color-second">название видеокарты бех производителя</p>
                                </div> --}}

                                <div class="fib fib-col">
                                    <label for="content">Сообщение</label>
                                    <input type="text" id="content" name="content"
                                        class="fib fib-p-8 bord-second bg-main pos-w-100"
                                        required />

                                    <p class="font-size-6 color-second">название видеокарты бех производителя</p>
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
