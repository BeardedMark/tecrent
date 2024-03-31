@extends('layouts.page')

@section('title', 'Редактирование игры')
@section('description', 'На этой странице можно заполнить все доступные данные и поля')

@section('page-content')
    <section id="form">
        <div class="row justify-content-center">
            <div class="col">
                <form class="fib fib-col fib-gap-21" method="POST" action="{{ route('games.update', compact('game')) }}">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col col-12 col-lg-6">
                            <div class="fib fib-col fib-gap-13">
                                <div class="fib fib-col">
                                    <label for="name">Наименование</label>
                                    <input type="text" id="name" name="name"
                                        class="fib fib-p-8 bord-second bg-main pos-w-100" value="{{ $game->name ?: '' }}"
                                        required />

                                    <p class="font-size-6 color-second">required|string|unique</p>
                                </div>

                                <div class="fib fib-col">
                                    <label for="image">Изображение</label>
                                    <input type="text" id="image" name="image"
                                        class="fib fib-p-8 bord-second bg-main pos-w-100"
                                        value="{{ $game->image ?: '' }}" />

                                    <p class="font-size-6 color-second">nullable|string|max:255</p>
                                </div>

                                <div class="fib fib-col">
                                    <label for="video">Видео</label>
                                    <input type="text" id="video" name="video"
                                        class="fib fib-p-8 bord-second bg-main pos-w-100"
                                        value="{{ $game->video ?: '' }}" />

                                    <p class="font-size-6 color-second">nullable|string|max:255 (идентификатор видео на
                                        yputube, например mHDEDDrGYvo)
                                    </p>
                                </div>

                                <div class="fib fib-col">
                                    <label for="description">Описание</label>
                                    <textarea class="fib fib-p-8 bord-second bg-main pos-w-100" id="description" name="description" rows="4">{{ $game->description ?: '' }}</textarea>
                                    <script>
                                        CKEDITOR.replace('description');
                                    </script>

                                    <p class="font-size-6 color-second">nullable|string</p>
                                </div>

                                <div class="fib fib-col">
                                    <label for="content">Контент</label>
                                    <textarea class="fib fib-p-8 bord-second bg-main pos-w-100" id="content" name="content" rows="4">{{ $game->content ?: '' }}</textarea>
                                    <script>
                                        CKEDITOR.replace('content');
                                    </script>

                                    <p class="font-size-6 color-second">nullable|string</p>
                                </div>

                                <div class="fib fib-col">
                                    <label for="commentary">Комментарий</label>
                                    <input type="text" id="commentary" name="commentary"
                                        class="fib fib-p-8 bord-second bg-main pos-w-100"
                                        value="{{ $game->commentary ?: '' }}" />

                                    <p class="font-size-6 color-second">nullable|string|max:255</p>
                                </div>
                            </div>
                        </div>

                        <div class="col col-12 col-lg-6">
                            <div class="fib fib-col fib-gap-13">
                                <div class="fib fib-col">
                                    <label for="autor">Автор</label>
                                    <input type="text" id="autor" name="autor"
                                        class="fib fib-p-8 bord-second bg-main pos-w-100"
                                        value="{{ $game->autor ?: '' }}" />

                                    <p class="font-size-6 color-second">nullable|string|max:255</p>
                                </div>

                                <div class="fib fib-col">
                                    <label for="developer">Разработчик</label>
                                    <input type="text" id="developer" name="developer"
                                        class="fib fib-p-8 bord-second bg-main pos-w-100"
                                        value="{{ $game->developer ?: '' }}" />

                                    <p class="font-size-6 color-second">nullable|string|max:255</p>
                                </div>

                                <div class="fib fib-col">
                                    <label for="publisher">Издатель</label>
                                    <input type="text" id="publisher" name="publisher"
                                        class="fib fib-p-8 bord-second bg-main pos-w-100"
                                        value="{{ $game->publisher ?: '' }}" />

                                    <p class="font-size-6 color-second">nullable|string|max:255</p>
                                </div>

                                <div class="fib fib-col">
                                    <label for="release">Дата релиза</label>
                                    <input type="date" id="release" name="release"
                                        class="fib fib-p-8 bord-second bg-main pos-w-100"
                                        value="{{ $game->release ?: '' }}" />

                                    <p class="font-size-6 color-second">nullable|date</p>
                                </div>

                                <div class="fib fib-col">
                                    <label for="trailer">Трейлер</label>
                                    <input type="text" id="trailer" name="trailer"
                                        class="fib fib-p-8 bord-second bg-main pos-w-100"
                                        value="{{ $game->trailer ?: '' }}" />

                                    <p class="font-size-6 color-second">nullable|string|max:255 (идентификатор видео на
                                        yputube, например mHDEDDrGYvo)
                                    </p>
                                </div>

                                <div class="fib fib-col">
                                    <label for="gameplay">Геймплей</label>
                                    <input type="text" id="gameplay" name="gameplay"
                                        class="fib fib-p-8 bord-second bg-main pos-w-100"
                                        value="{{ $game->gameplay ?: '' }}" />

                                    <p class="font-size-6 color-second">nullable|string|max:255 (идентификатор видео на
                                        yputube, например mHDEDDrGYvo)
                                    </p>
                                </div>

                                <div class="fib fib-col">
                                    <label for="is_server">Можно открыть сервер</label>
                                    <input class="fib-p-8 bord-second bg-main" type="checkbox" id="is_server"
                                        name="is_server" {{ $game->is_server ? 'checked' : '' }} value="1">
                                    <p class="font-size-6 color-second">boolean</p>
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
