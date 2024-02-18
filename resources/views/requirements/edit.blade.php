@extends('layouts.page')

@section('title', 'Редактирование требования к игре')
{{-- @section('description', 'Заполните обязательные поля и получите доступ к остальным данным') --}}

@section('page-content')
    <section id="form">
        <div class="row justify-content-center">
            <div class="col">
                <form class="fib fib-col fib-gap-21" method="POST" action="{{ route('requirements.update', compact('requirement')) }}">
                    @csrf
                    @method('PUT')

                    <div class="row justify-content-center">
                        <div class="col col-12 col-md-10 col-lg-8 col-xl-7">
                            <div class="fib fib-col fib-gap-13">
                                <div class="fib fib-col">
                                    <label for="game_id">Игра</label>

                                    <select id="game_id" name="game_id" class="fib fib-p-8 bord-second bg-main pos-w-100">
                                        @foreach ($games as $game)
                                            <option value="{{ $game->id }}"
                                                @if ($game->id == $requirement->game_id) selected @endif>
                                                {{ $game->title() }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <p class="font-size-6 color-second">владелец нового системного требования</p>
                                </div>

                                <div class="fib fib-col">
                                    <label for="name">Уровень мощности требований</label>

                                    <input type="text" id="name" name="name"
                                        class="fib fib-p-8 bord-second bg-main pos-w-100" value="{{ $requirement->name ?: '' }}" required />

                                    <p class="font-size-6 color-second">наименование требования</p>
                                </div>

                                <div class="fib fib-col">
                                    <label for="description">Описание</label>
                                    <textarea class="fib fib-p-8 bord-second bg-main pos-w-100" id="description" name="description" rows="4">{{ $requirement->description ?: '' }}</textarea>
                                    <p class="font-size-6 color-second">общее кол-во в Gb</p>

                                    <script>
                                        CKEDITOR.replace('description');
                                    </script>
                                </div>

                                <div class="fib fib-col">
                                    <label for="content">Контент</label>
                                    <textarea class="fib fib-p-8 bord-second bg-main pos-w-100" id="content" name="content" rows="4">{{ $requirement->content ?: '' }}</textarea>
                                    <p class="font-size-6 color-second">общее кол-во в Gb</p>

                                    <script>
                                        CKEDITOR.replace('content');
                                    </script>
                                </div>

                                <div class="fib fib-col">
                                    <label for="commentary">Комментарий</label>

                                    <input type="text" id="commentary" name="commentary"
                                        class="fib fib-p-8 bord-second bg-main pos-w-100" value="{{ $requirement->commentary ?: '' }}"/>

                                    <p class="font-size-6 color-second">общее кол-во в Gb</p>
                                </div>
                            </div>
                        </div>

                        <div class="col col-12 col-md-10 col-lg-8 col-xl-5">
                            <div class="fib fib-col fib-gap-13">
                                <div class="fib fib-col">
                                    <label for="drive_require">Необходимый объем на накопителе</label>

                                    <input type="number" id="drive_require" name="drive_require"
                                        class="fib fib-p-8 bord-second bg-main pos-w-100" value="{{ $requirement->drive_require ?: '' }}" required />

                                    <p class="font-size-6 color-second">указывается в Gb</p>
                                </div>

                                <div class="fib fib-col">
                                    <label for="ram_require">Необходимое кол-во оперативной памяти</label>

                                    <input type="number" id="ram_require" name="ram_require"
                                        class="fib fib-p-8 bord-second bg-main pos-w-100" value="{{ $requirement->ram_require ?: '' }}" required />

                                    <p class="font-size-6 color-second">общее кол-во в Gb</p>
                                </div>

                                <div class="fib fib-col">
                                    <label for="gpus">Видеокарты</label>

                                    <select  id="gpus" class="fib fib-p-8 bord-second bg-main w-100" name="gpus[]" multiple style="height: 200px">
                                        @foreach ($gpus as $gpu)
                                            <option value="{{ $gpu->id }}" @if (in_array($gpu->id, $requirement->gpus->pluck('id')->toArray())) selected @endif>
                                                {{ $gpu->title() }}</option>
                                        @endforeach
                                    </select>

                                    <p class="font-size-6 color-second">подходящие видеокарты</p>
                                </div>

                                <div class="fib fib-col">
                                    <label for="cpus">Процессоры</label>

                                    <select  id="cpus" class="fib fib-p-8 bord-second bg-main w-100" name="cpus[]" multiple style="height: 200px">
                                        @foreach ($cpus as $cpu)
                                            <option value="{{ $cpu->id }}" @if (in_array($cpu->id, $requirement->cpus->pluck('id')->toArray())) selected @endif>
                                                {{ $cpu->title() }}</option>
                                        @endforeach
                                    </select>

                                    <p class="font-size-6 color-second">подходящие процессоры</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="fib fib-end">
                                <a class="fib-button hover-contrast emoji" href="{{ url()->previous() }}">❎ Отмена</a>
                                <input class="fib-button hover-second emoji" type="reset" value="⏮️ Сбросить">
                                <button type="submit" class="fib-button hover-accent emoji">✅ Сохранить</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection