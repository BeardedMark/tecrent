@extends('layouts.page')

@section('title', 'Редактирование компьютера')
@section('description', 'Заполните обязательные поля и получите доступ к остальным данным')

@section('page-content')
    <section id="form">
        <div class="row justify-content-center">
            <div class="col">
                <form class="fib fib-col fib-gap-21" method="POST"
                    action="{{ route('computers.update', compact('computer')) }}">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col col-12 col-lg-6">
                            <div class="fib fib-col fib-gap-13">
                                <div class="fib fib-col">
                                    <label for="name">Наименование</label>
                                    <input type="text" id="name" name="name"
                                        class="fib fib-p-8 bord-second bg-main pos-w-100"
                                        value="{{ $computer->name ?: '' }}" required />

                                    <p class="font-size-6 color-second">уникальное значение</p>
                                </div>

                                <div class="fib fib-col">
                                    <label for="image">Изображение</label>
                                    <input type="text" id="image" name="image"
                                        class="fib fib-p-8 bord-second bg-main pos-w-100"
                                        value="{{ $computer->image ?: '' }}" />

                                    <p class="font-size-6 color-second">прямая ссылка на изображение</p>
                                </div>

                                <div class="fib fib-col">
                                    <label for="description">Описание</label>
                                    <textarea class="fib fib-p-8 bord-second bg-main pos-w-100" id="description" name="description" rows="4">{{ $computer->description ?: '' }}</textarea>
                                    <script>
                                        CKEDITOR.replace('description');
                                    </script>

                                    <p class="font-size-6 color-second">краткое описание страницы</p>
                                </div>

                                <div class="fib fib-col">
                                    <label for="content">Контент</label>
                                    <textarea class="fib fib-p-8 bord-second bg-main pos-w-100" id="content" name="content" rows="4">{{ $computer->content ?: '' }}</textarea>
                                    <script>
                                        CKEDITOR.replace('content');
                                    </script>

                                    <p class="font-size-6 color-second">подробное описание</p>
                                </div>

                                <div class="fib fib-col">
                                    <label for="commentary">Комментарий</label>
                                    <input type="text" id="commentary" name="commentary"
                                        class="fib fib-p-8 bord-second bg-main pos-w-100"
                                        value="{{ $computer->commentary ?: '' }}" />

                                    <p class="font-size-6 color-second">заметка об игре</p>
                                </div>
                            </div>
                        </div>

                        <div class="col col-12 col-lg-6">
                            <div class="fib fib-col fib-gap-13">
                                <div class="fib fib-col">
                                    <label for="price">Цена</label>

                                    <input type="number" id="price" name="price"
                                        class="fib fib-p-8 bord-second bg-main pos-w-100"
                                        value="{{ $computer->price ?: '' }}" />

                                    <p class="font-size-6 color-second">рублей в день</p>
                                </div>

                                <div class="fib fib-col">
                                    <label for="gpu_id">Видеокарта</label>
                                    <select id="gpu_id" name="gpu_id" class="fib fib-p-8 bord-second bg-main pos-w-100">
                                        <option value="">нет</option>

                                        @foreach ($gpus as $gpu)
                                            <option value="{{ $gpu->id }}"
                                                @if ($gpu == $computer->gpu) selected @endif>
                                                {{ $gpu->getTitle() }}</option>
                                        @endforeach
                                    </select>

                                    <p class="font-size-6 color-second">заметка об игре</p>
                                </div>

                                <div class="fib fib-col">
                                    <label for="cpu_id">Процессор</label>
                                    <select id="cpu_id" name="cpu_id" class="fib fib-p-8 bord-second bg-main pos-w-100">
                                        <option value="">нет</option>

                                        @foreach ($cpus as $cpu)
                                            <option value="{{ $cpu->id }}"
                                                @if ($cpu == $computer->cpu) selected @endif>
                                                {{ $cpu->getTitle() }}</option>
                                        @endforeach
                                    </select>

                                    <p class="font-size-6 color-second">заметка об игре</p>
                                </div>

                                <div class="fib fib-col">
                                    <label for="ram_id">Оперативная память</label>
                                    <select id="ram_id" name="ram_id" class="fib fib-p-8 bord-second bg-main pos-w-100">
                                        <option value="">нет</option>

                                        @foreach ($rams as $ram)
                                            <option value="{{ $ram->id }}"
                                                @if ($ram == $computer->ram) selected @endif>
                                                {{ $ram->getTitle() }}</option>
                                        @endforeach
                                    </select>

                                    <p class="font-size-6 color-second">заметка об игре</p>
                                </div>

                                <div class="fib fib-col">
                                    <label for="ram_count">Количество оперативки</label>

                                    <input type="number" id="ram_count" name="ram_count"
                                        class="fib fib-p-8 bord-second bg-main pos-w-100"
                                        value="{{ $computer->ram_count ?: '1' }}" min="0" max="10"/>

                                    <p class="font-size-6 color-second">количество установленых слотов оперативной памяти</p>
                                </div>

                                <div class="fib fib-col">
                                    <label for="drive_id">Накопитель</label>
                                    <select id="drive_id" name="drive_id"
                                        class="fib fib-p-8 bord-second bg-main pos-w-100">
                                        <option value="">нет</option>

                                        @foreach ($drives as $drive)
                                            <option value="{{ $drive->id }}"
                                                @if ($drive == $computer->drive) selected @endif>
                                                {{ $drive->getTitle() }}</option>
                                        @endforeach
                                    </select>

                                    <p class="font-size-6 color-second">установленные жесткие диски</p>
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
