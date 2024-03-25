@extends('layouts.page')

@section('title', 'Редактирование видеокарты')
@section('description', 'Заполните все необходжимые поля')

@section('page-content')
    <section id="form">
        <div class="row justify-content-center">
            <div class="col">
                <form class="fib fib-col fib-gap-21" method="POST"
                    action="{{ route('gpus.update', compact('gpu')) }}">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col col-12 col-lg-6">
                            <div class="fib fib-col fib-gap-13">
                                <div class="fib fib-col">
                                    <label for="name">Наименование</label>
                                    <input type="text" id="name" name="name"
                                        class="fib fib-p-8 bord-second bg-main pos-w-100"
                                        value="{{ $gpu->name ?: '' }}" required />

                                    <p class="font-size-6 color-second">required|string|unique</p>
                                </div>

                                <div class="fib fib-col">
                                    <label for="image">Изображение</label>
                                    <input type="text" id="image" name="image"
                                        class="fib fib-p-8 bord-second bg-main pos-w-100"
                                        value="{{ $gpu->image ?: '' }}" />

                                    <p class="font-size-6 color-second">nullable|string|max:255</p>
                                </div>

                                <div class="fib fib-col">
                                    <label for="description">Описание</label>
                                    <textarea class="fib fib-p-8 bord-second bg-main pos-w-100" id="description" name="description" rows="4">{{ $gpu->description ?: '' }}</textarea>
                                    <script>
                                        CKEDITOR.replace('description');
                                    </script>

                                    <p class="font-size-6 color-second">nullable|string|max:1000</p>
                                </div>

                                <div class="fib fib-col">
                                    <label for="content">Контент</label>
                                    <textarea class="fib fib-p-8 bord-second bg-main pos-w-100" id="content" name="content" rows="4">{{ $gpu->content ?: '' }}</textarea>
                                    <script>
                                        CKEDITOR.replace('content');
                                    </script>

                                    <p class="font-size-6 color-second">nullable|string|max:5000</p>
                                </div>

                                <div class="fib fib-col">
                                    <label for="commentary">Комментарий</label>
                                    <input type="text" id="commentary" name="commentary"
                                        class="fib fib-p-8 bord-second bg-main pos-w-100"
                                        value="{{ $gpu->commentary ?: '' }}" />

                                    <p class="font-size-6 color-second">nullable|string|max:255</p>
                                </div>
                            </div>
                        </div>

                        <div class="col col-12 col-lg-6">
                            <div class="fib fib-col fib-gap-13">
                                
                                <div class="fib fib-col">
                                    <label for="manufacturer">Производитель</label>
                                    <select id="manufacturer" name="manufacturer" class="fib fib-p-8 bord-second bg-main pos-w-100" required>
                                        <option @if(!$gpu->manufacturer) selected @endif disabled hidden></option>
                                        <option @if($gpu->manufacturer == 'NVIDIA') selected @endif value="NVIDIA">NVIDIA</option>
                                        <option @if($gpu->manufacturer == 'AMD') selected @endif value="AMD">AMD</option>
                                    </select>

                                    <p class="font-size-6 color-second">nullable|string|max:255</p>
                                </div>
                                
                                <div class="fib fib-col">
                                    <label for="model">Модель</label>
                                    <input type="text" id="model" name="model"
                                        class="fib fib-p-8 bord-second bg-main pos-w-100"
                                        value="{{ $gpu->model ?: '' }}"/>

                                    <p class="font-size-6 color-second">nullable|string|max:255</p>
                                </div>
                                
                                <div class="fib fib-col">
                                    <label for="interface">Интерфейс</label>
                                    <input type="text" id="interface" name="interface"
                                        class="fib fib-p-8 bord-second bg-main pos-w-100"
                                        value="{{ $gpu->interface ?: '' }}"/>

                                    <p class="font-size-6 color-second">nullable|string|max:255</p>
                                </div>
                                
                                <div class="fib fib-col">
                                    <label for="memory_type">Тип памяти</label>
                                    <input type="text" id="memory_type" name="memory_type"
                                        class="fib fib-p-8 bord-second bg-main pos-w-100"
                                        value="{{ $gpu->memory_type ?: '' }}"/>

                                    <p class="font-size-6 color-second">nullable|string|max:255</p>
                                </div>

                                <div class="fib fib-col">
                                    <label for="memory_size">Объем видеопамяти</label>

                                    <input type="number" id="memory_size" name="memory_size"
                                        class="fib fib-p-8 bord-second bg-main pos-w-100"
                                        value="{{ $gpu->memory_size ?: '' }}"/>

                                    <p class="font-size-6 color-second">nullable|integer</p>
                                </div>

                                <div class="fib fib-col">
                                    <label for="gpu_frequency">Частота</label>

                                    <input type="number" id="gpu_frequency" name="gpu_frequency"
                                        class="fib fib-p-8 bord-second bg-main pos-w-100"
                                        value="{{ $gpu->gpu_frequency ?: '' }}"/>

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
