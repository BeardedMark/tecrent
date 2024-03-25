@extends('layouts.page')

@section('title', 'Редактирование компьютера')
@section('description', 'Заполните обязательные поля и получите доступ к остальным данным')

@section('page-content')
    <section id="form">
        <div class="row justify-content-center">
            <div class="col">
                <form class="fib fib-col fib-gap-21" method="POST"
                    action="{{ route('posts.update', compact('post')) }}">
                    @csrf
                    @method('PUT')
                    <div class="row justify-content-center">
                        <div class="col col-12 col-lg-6">
                            <div class="fib fib-col fib-gap-13">
                                <div class="fib fib-col">
                                    <label for="name">Наименование</label>
                                    <input type="text" id="name" name="name"
                                        class="fib fib-p-8 bord-second bg-main pos-w-100"
                                        value="{{ $post->name ?: '' }}" required />

                                    <p class="font-size-6 color-second">уникальное значение</p>
                                </div>
                                
                                <div class="fib fib-col">
                                    <label for="emoji">Эмоция</label>
                                    <input type="text" id="emoji" name="emoji"
                                        class="fib fib-p-8 bord-second bg-main pos-w-100"
                                        value="{{ $post->emoji ?: '' }}"/>

                                    <p class="font-size-6 color-second">эмоция поста</p>
                                </div>

                                <div class="fib fib-col">
                                    <label for="image">Изображение</label>
                                    <input type="text" id="image" name="image"
                                        class="fib fib-p-8 bord-second bg-main pos-w-100"
                                        value="{{ $post->image ?: '' }}" />

                                    <p class="font-size-6 color-second">прямая ссылка на изображение</p>
                                </div>

                                <div class="fib fib-col">
                                    <label for="description">Описание</label>
                                    <textarea class="fib fib-p-8 bord-second bg-main pos-w-100" id="description" name="description" rows="4">{{ $post->description ?: '' }}</textarea>
                                    <p class="font-size-6 color-second">краткое описание страницы</p>
                                </div>

                                <div class="fib fib-col">
                                    <label for="content">Контент</label>
                                    <textarea class="fib fib-p-8 bord-second bg-main pos-w-100" id="content" name="content" rows="4">{{ $post->content ?: '' }}</textarea>
                                    <script>
                                        CKEDITOR.replace('content');
                                    </script>

                                    <p class="font-size-6 color-second">подробное описание</p>
                                </div>

                                <div class="fib fib-col">
                                    <label for="commentary">Комментарий</label>
                                    <input type="text" id="commentary" name="commentary"
                                        class="fib fib-p-8 bord-second bg-main pos-w-100"
                                        value="{{ $post->commentary ?: '' }}" />

                                    <p class="font-size-6 color-second">заметка об игре</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="fib fib-end">
                                <a class="fib-button hover-contrast emoji" href="{{ url()->previous() }}">❎ Отмена</a>

                                <input class="fib-button hover-contrast emoji" type="reset" value="⏮️ Сбросить">
                                <button type="submit" class="fib-button hover-accent emoji">✅ Сохранить</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
