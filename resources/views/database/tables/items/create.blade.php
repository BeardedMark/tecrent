@extends('database.dashboard')

@section('title', 'Добавить в ' . $table->TABLE_COMMENT ?: $table->TABLE_NAME)
@section('description', 'Заполните поля')

@section('frame')
    <form id="createBackup" class="fib fib-col fib-gap-21" method="POST" action="{{ route('items.store', ['table' => $table->TABLE_NAME]) }}">
        @csrf
        <div class="row">
            <div class="col">
                <div class="fib fib-start">
                    <a class="fib-button hover-contrast emoji"
                        href="{{ route('items.index', ['table' => $table->TABLE_NAME]) }}">⬅️ Назад</a>
                    <input class="fib-button hover-contrast emoji" type="reset" value="⏮️ Сбросить">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="fib fib-col fib-gap-13">
                    @foreach ($columns as $column)
                        @if ($column->IS_NULLABLE === 'NO')
                            <div class="fib fib-col fib-gap-5">
                                <label
                                    for="{{ $column->COLUMN_NAME }}">{{ $column->COLUMN_COMMENT ?: $column->COLUMN_NAME }}</label>

                                @if (Str::endsWith($column->COLUMN_NAME, '_id'))
                                    <select id="{{ $column->COLUMN_NAME }}" name="{{ $column->COLUMN_NAME }}"
                                        class="fib fib-p-8 bord-second bg-main pos-w-100"
                                        @if ($column->IS_NULLABLE === 'NO' && $column->COLUMN_NAME != 'id') required @endif>

                                        @if ($column->IS_NULLABLE === 'YES')
                                            <option value="">нет</option>
                                        @endif

                                        @foreach ($column->DATA as $option)
                                            <option value="{{ $option->id }}">{{ $option->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                @elseif ($column->DATA_TYPE === 'checkbox')
                                    <input class="form-check-input" type="checkbox" value=""
                                        @if ($item->{$column->COLUMN_NAME}) checked @endif>
                                @elseif ($column->DATA_TYPE === 'text')
                                    <textarea class="fib fib-p-8 bord-second bg-main pos-w-100" id="{{ $column->COLUMN_NAME }}"
                                        name="{{ $column->COLUMN_NAME }}" rows="4"></textarea>

                                    <script>
                                        CKEDITOR.replace({{ $column->COLUMN_NAME }});
                                    </script>
                                @else
                                    <input type="{{ $column->DATA_TYPE }}" id="{{ $column->COLUMN_NAME }}"
                                        name="{{ $column->COLUMN_NAME }}" class="fib fib-p-8 bord-second bg-main pos-w-100"
                                        @if ($column->DATA_TYPE === 'varchar' && $column->CHARACTER_MAXIMUM_LENGTH) maxlength="{{ $column->CHARACTER_MAXIMUM_LENGTH }}" @endif
                                        @if ($column->IS_NULLABLE === 'NO') required @endif />
                                @endif
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="fib fib-start">
                    <a class="fib-button hover-contrast emoji"
                        href="{{ route('items.index', ['table' => $table->TABLE_NAME]) }}">❎ Отмена</a>
                    <button type="submit" class="fib-button hover-accent emoji">✅ Создать</button>
                </div>
            </div>
        </div>
    </form>
@endsection

{{-- @section('content')
    <section>
        <div class="container">
            <form class="fib-section" method="POST" action="{{ route('items.store', ['table' => $table->TABLE_NAME]) }}">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8">
                            <h1 class="font-size-1 font-bold">Создание</h1>
                            <ul class="fib fib-gap-5 font-size-5">
                                <li><a class="link" href="{{ route('tables.index') }}">{{ env('DB_DATABASE') }}</a></li>
                                . <li><a class="link"
                                        href="{{ route('items.index', ['table' => $table->TABLE_NAME]) }}">{{ $table->TABLE_NAME }}</a>
                                </li>
                                . <li><span class="font-bold">create</span></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8">
                            @foreach ($columns as $column)
                                <div class="fib fib-col fib-gap-3">
                                    <label for="{{ $column->COLUMN_NAME }}">{{ $column->COLUMN_COMMENT }}
                                        <span class="color-second">
                                            {{ $column->COLUMN_NAME }} / {{ $column->HTML_TYPE }} /
                                            nullable:{{ $column->IS_NULLABLE }}
                                        </span>
                                    </label>

                                    @if (Str::endsWith($column->COLUMN_NAME, '_id'))
                                        <select id="{{ $column->COLUMN_NAME }}" name="{{ $column->COLUMN_NAME }}"
                                            class="fib fib-p-13 bord-second bg-main pos-w-100"
                                            @if ($column->IS_NULLABLE === 'NO' && $column->COLUMN_NAME != 'id') required @endif>

                                            @if ($column->IS_NULLABLE === 'YES')
                                                <option value="">нет</option>
                                            @endif

                                            @foreach ($column->DATA as $option)
                                                <option value="{{ $option->id }}">{{ $option->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    @elseif ($column->DATA_TYPE === 'checkbox')
                                        <input class="form-check-input" type="checkbox" value=""
                                            @if ($item->{$column->COLUMN_NAME}) checked @endif>
                                    @elseif ($column->DATA_TYPE === 'text')
                                        <textarea class="fib fib-p-13 bord-second bg-main pos-w-100" id="{{ $column->COLUMN_NAME }}"
                                            name="{{ $column->COLUMN_NAME }}" rows="4"></textarea>
                                    @else
                                        <input type="{{ $column->DATA_TYPE }}" id="{{ $column->COLUMN_NAME }}"
                                            name="{{ $column->COLUMN_NAME }}"
                                            class="fib fib-p-13 bord-second bg-main pos-w-100"
                                            @if ($column->DATA_TYPE === 'varchar' && $column->CHARACTER_MAXIMUM_LENGTH) maxlength="{{ $column->CHARACTER_MAXIMUM_LENGTH }}" @endif
                                            @if ($column->IS_NULLABLE === 'NO') required placeholder="..." @endif />
                                    @endif
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="fib fib-start">
                            <a class="fib-button hover-contrast emoji"
                                href="{{ route('items.index', ['table' => $table->TABLE_NAME]) }}">❎ Отмена</a>
                            <input class="fib-button hover-contrast emoji" type="reset" value="⏮️ Сбросить">
                            <button type="submit" class="fib-button hover-accent emoji">✅ Создать</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection --}}
