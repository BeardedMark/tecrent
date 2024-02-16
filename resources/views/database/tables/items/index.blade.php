@extends('database.dashboard')

@section('title', $table->TABLE_COMMENT ?: $table->TABLE_NAME)
@section('description', 'Название таблицы: ' . $table->TABLE_NAME)

@section('frame')
    <div class="fib fib-col fib-gap-21">
        <div class="fib fib-start">
            <a class="fib-button hover-contrast emoji" href="{{ route('tables.index') }}">⬅️ Таблицы</a>

            <a class="fib-button hover-accent emoji"
                href="{{ route('items.create', ['table' => $table->TABLE_NAME]) }}">➕ Создать</a>

            @if (File::exists(resource_path('views/' . $table->TABLE_NAME . '/index.blade.php')))
                <a class="fib-button hover-contrast emoji"
                    href="{{ route($table->TABLE_NAME . '.index') }}">↗️ Просмотр</a>
            @endif

            <a class="fib-button hover-contrast emoji"
                href="{{ route('table.export', ['table' => $table->TABLE_NAME]) }}">⬆️ Экспорт</a>
            <a class="fib-button hover-contrast emoji"
                href="{{ route('table.export', ['table' => $table->TABLE_NAME]) }}">⬇️ Импорт</a>
            <a class="fib-button hover-contrast emoji"
                href="{{ route('table.clean', ['table' => $table->TABLE_NAME]) }}">❌ Очистить</a>
        </div>

        <table class="table table-bordered table-hover bg-main font-size-6">
            <thead>
                <tr>
                    {{-- Перебор заголовков --}}
                    @foreach ($columns as $column)
                        <th>
                            <p>{{ $column->COLUMN_COMMENT }}</p>
                            <p class="font-size-6">{{ $column->COLUMN_NAME }}</p>
                        </th>
                    @endforeach
                </tr>
            </thead>

            <tbody>
                {{-- Перебор строк --}}
                @foreach ($data as $row)
                    <tr>
                        {{-- Перебор ячеек --}}
                        @foreach ($columns as $column)
                            <td>
                                <a class="@if (isset($row->deleted_at)) color-second @endif link"
                                    href="{{ route('items.show', ['table' => $table->TABLE_NAME, 'id' => $row->id]) }}#{{ $column->COLUMN_NAME }}">{{ $row->{$column->COLUMN_NAME} }}</a>
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
