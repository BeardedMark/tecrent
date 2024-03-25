@extends('layouts.page')

@section('title', 'Редактирование процессора')
@section('description', 'Заполните все необходжимые поля')

@section('page-content')
    <section id="form">
        <div class="row justify-content-center">
            <div class="col">
                <form class="fib fib-col fib-gap-21" method="POST"
                    action="{{ route('cpus.update', compact('cpu')) }}">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col col-12 col-lg-6">
                            <div class="fib fib-col fib-gap-13">
                                <div class="fib fib-col">
                                    <label for="name">Наименование</label>
                                    <input type="text" id="name" name="name"
                                        class="fib fib-p-8 bord-second bg-main pos-w-100"
                                        value="{{ $cpu->name ?: '' }}" required />

                                    <p class="font-size-6 color-second">required|string|unique</p>
                                </div>

                                <div class="fib fib-col">
                                    <label for="image">Изображение</label>
                                    <input type="text" id="image" name="image"
                                        class="fib fib-p-8 bord-second bg-main pos-w-100"
                                        value="{{ $cpu->image ?: '' }}" />

                                    <p class="font-size-6 color-second">nullable|string|max:255</p>
                                </div>

                                <div class="fib fib-col">
                                    <label for="description">Описание</label>
                                    <textarea class="fib fib-p-8 bord-second bg-main pos-w-100" id="description" name="description" rows="4">{{ $cpu->description ?: '' }}</textarea>
                                    <script>
                                        CKEDITOR.replace('description');
                                    </script>

                                    <p class="font-size-6 color-second">nullable|string|max:1000</p>
                                </div>

                                <div class="fib fib-col">
                                    <label for="content">Контент</label>
                                    <textarea class="fib fib-p-8 bord-second bg-main pos-w-100" id="content" name="content" rows="4">{{ $cpu->content ?: '' }}</textarea>
                                    <script>
                                        CKEDITOR.replace('content');
                                    </script>

                                    <p class="font-size-6 color-second">nullable|string|max:5000</p>
                                </div>

                                <div class="fib fib-col">
                                    <label for="commentary">Комментарий</label>
                                    <input type="text" id="commentary" name="commentary"
                                        class="fib fib-p-8 bord-second bg-main pos-w-100"
                                        value="{{ $cpu->commentary ?: '' }}" />

                                    <p class="font-size-6 color-second">nullable|string|max:255</p>
                                </div>
                            </div>
                        </div>

                        <div class="col col-12 col-lg-6">
                            <div class="fib fib-col fib-gap-13">
                                
                                <div class="fib fib-col">
                                    <label for="manufacturer">Производитель</label>
                                    <select id="manufacturer" name="manufacturer" class="fib fib-p-8 bord-second bg-main pos-w-100" required>
                                        <option @if(!$cpu->manufacturer) selected @endif disabled hidden></option>
                                        <option @if($cpu->manufacturer == 'Intel') selected @endif value="Intel">Intel</option>
                                        <option @if($cpu->manufacturer == 'AMD') selected @endif value="AMD">AMD</option>
                                    </select>

                                    <p class="font-size-6 color-second">nullable|string|max:255</p>
                                </div>
                                
                                <div class="fib fib-col">
                                    <label for="model">Модель</label>
                                    <input type="text" id="model" name="model"
                                        class="fib fib-p-8 bord-second bg-main pos-w-100"
                                        value="{{ $cpu->model ?: '' }}"/>

                                    <p class="font-size-6 color-second">nullable|string|max:255</p>
                                </div>
                                
                                <div class="fib fib-col">
                                    <label for="cache">Кэш-память</label>
                                    <input type="text" id="cache" name="cache"
                                        class="fib fib-p-8 bord-second bg-main pos-w-100"
                                        value="{{ $cpu->cache ?: '' }}"/>

                                    <p class="font-size-6 color-second">nullable|string|max:255</p>
                                </div>
                                
                                <div class="fib fib-col">
                                    <label for="socket">Сокет</label>
                                    <input type="text" id="socket" name="socket"
                                        class="fib fib-p-8 bord-second bg-main pos-w-100"
                                        value="{{ $cpu->socket ?: '' }}"/>

                                    <p class="font-size-6 color-second">nullable|string|max:255</p>
                                </div>
                                
                                <div class="fib fib-col">
                                    <label for="frequency">Частота</label>
                                    <input type="number" id="frequency" name="frequency"
                                        class="fib fib-p-8 bord-second bg-main pos-w-100"
                                        value="{{ $cpu->frequency ?: '' }}"/>

                                    <p class="font-size-6 color-second">nullable|integer</p>
                                </div>
                                
                                <div class="fib fib-col">
                                    <label for="cores_count">Количество ядер</label>
                                    <input type="number" id="cores_count" name="cores_count"
                                        class="fib fib-p-8 bord-second bg-main pos-w-100"
                                        value="{{ $cpu->cores_count ?: '' }}"/>

                                    <p class="font-size-6 color-second">nullable|integer</p>
                                </div>
                                
                                <div class="fib fib-col">
                                    <label for="threads_count">Количество потоков</label>
                                    <input type="number" id="threads_count" name="threads_count"
                                        class="fib fib-p-8 bord-second bg-main pos-w-100"
                                        value="{{ $cpu->threads_count ?: '' }}"/>

                                    <p class="font-size-6 color-second">nullable|integer</p>
                                </div>
                                
                                <div class="fib fib-col">
                                    <label for="power">Мощность</label>
                                    <input type="number" id="power" name="power"
                                        class="fib fib-p-8 bord-second bg-main pos-w-100"
                                        value="{{ $cpu->power ?: '' }}"/>

                                    <p class="font-size-6 color-second">nullable|integer</p>
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
