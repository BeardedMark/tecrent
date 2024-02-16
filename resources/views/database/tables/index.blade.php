@extends('database.dashboard')

@section('title', 'База данных')
@section('description', 'Название базы: ' . env('DB_DATABASE'))

@section('frame')
    <div class="fib fib-col fib-gap-21">
        {{-- <div class="fib fib-start">
            <a class="fib-button hover-contrast emoji" href="{{ route('backups.create') }}">📥 Создать бэкап</a>
        </div> --}}

        <table class="table table-bordered table-hover bg-main font-size-6">
            <thead>
                <tr>
                    <th>Таблица</th>
                    <th>Название</th>
                    <th>Длинна</th>
                    <th>Дата создания</th>
                    <th>Дата изменения</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($tables as $table)
                    <tr>
                        <td>
                            <a class="link"
                                href="{{ route('items.index', ['table' => $table->TABLE_NAME]) }}">{{ $table->TABLE_COMMENT ?: $table->TABLE_NAME }}</a>
                        </td>
                        <td>{{ $table->TABLE_NAME }}</td>
                        <td>{{ $table->TABLE_ROWS }}</td>
                        <td>{{ $table->CREATE_TIME }}</td>
                        <td>{{ $table->UPDATE_TIME }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
