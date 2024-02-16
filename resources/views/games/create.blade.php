@extends('layouts.page')

@section('title', 'Добавление игры')
@section('description', 'Заполните обязательные поля и получите доступ к остальным данным')

@section('page-content')
    <section id="form">
        <div class="row justify-content-center">
            <div class="col col-6">
                <form class="fib fib-col fib-gap-21" method="POST" action="{{ route('games.store') }}">
                    @csrf

                    <div class="row">
                        <div class="col">
                            <div class="fib fib-col fib-gap-13">
                                <div class="fib fib-col">
                                    <label for="name">Наименование</label>

                                    <input type="text" id="name" name="name"
                                        class="fib fib-p-8 bord-second bg-main pos-w-100" required />

                                    <p class="font-size-6 color-second">уникальное значение</p>
                                </div>

                                {{-- <label for="image">Изображение</label>
                                <input type="text" id="image" name="image"
                                    class="fib fib-p-8 bord-second bg-main pos-w-100" />

                                <label for="description">Описание</label>
                                <textarea class="fib fib-p-8 bord-second bg-main pos-w-100" id="description" name="description" rows="4"></textarea>
                                <script>
                                    CKEDITOR.replace('description');
                                </script>

                                <label for="autor">Автор</label>
                                <input type="text" id="autor" name="autor"
                                    class="fib fib-p-8 bord-second bg-main pos-w-100" />

                                <label for="release">Дата релиза</label>
                                <input type="date" id="release" name="release"
                                    class="fib fib-p-8 bord-second bg-main pos-w-100" />

                                <label for="content">Контент</label>
                                <textarea class="fib fib-p-8 bord-second bg-main pos-w-100" id="content" name="content" rows="4"></textarea>
                                <script>
                                    CKEDITOR.replace('content');
                                </script> --}}

                                {{-- <label for="gpus_id">Видеокарта</label>
                                <select id="gpus_id" name="gpus_id" class="fib fib-p-8 bord-second bg-main pos-w-100">
                                    <option value="">нет</option>
                                </select> --}}

                                {{-- <input class="form-check-input" type="checkbox" value=""
                                    @if ($item->{$column->COLUMN_NAME}) checked @endif> --}}

                                {{-- <label for="commentary">Комментарий</label>
                                <input type="text" id="commentary" name="commentary"
                                    class="fib fib-p-8 bord-second bg-main pos-w-100" /> --}}

                                {{-- <script>
                                    $('#gpus_id').click(function() {
                                        // Функция для загрузки чатов через Ajax
                                        function loadChats() {
                                            $.ajax({
                                                url: "{{ route('gpus.index') }}",
                                                method: "GET",
                                                success: function(data) {
                                                    $("#gpus_id").append(data.view);
                                                },
                                                error: function() {
                                                    alert("Ошибка загрузки чатов");
                                                }
                                            });
                                        }

                                        loadChats();
                                    });
                                </script> --}}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="fib fib-end">
                                <a class="fib-button hover-contrast emoji" href="{{ redirect()->back() }}">❎ Отмена</a>

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
