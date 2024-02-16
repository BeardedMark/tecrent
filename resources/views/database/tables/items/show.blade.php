@extends('database.dashboard')

@section('title', ($table->TABLE_COMMENT ?: $table->TABLE_NAME) . '[' . $item->id . ']')
@section('description', 'Название таблицы: ' . $table->TABLE_NAME)

@section('frame')
    <div class="fib fib-col fib-gap-21">
        <div class="fib fib-start">
            <a class="fib-button hover-contrast emoji"
                href="{{ route('items.index', $table->TABLE_NAME) }}">⬅️ Таблица</a>
            <a class="fib-button hover-contrast emoji"
                href="{{ route('items.edit', ['table' => $table->TABLE_NAME, 'id' => $item->id]) }}">🖍️ Редактировать</a>

            @if (File::exists(resource_path('views/' . $table->TABLE_NAME . '/show.blade.php')))
                <a class="fib-button hover-contrast emoji"
                    href="{{ route($table->TABLE_NAME . '.show', $item->id) }}">↗️ Просмотр</a>
            @endif

            @if (!isset($row->deleted_at))
                <form class="d-inline"
                    action="{{ route('items.destroy', ['table' => $table->TABLE_NAME, 'id' => $item->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="fib-button hover-accent emoji">
                        @if (isset($item->deleted_at))
                            ♻️ Восстановить
                        @else
                            ❌ Удалить
                        @endif
                    </button>
                </form>

            @endif
        </div>

        <table class="table table-bordered table-hover bg-main font-size-6">
            <tbody>
                @foreach ($item as $key => $value)
                    <tr>
                        <th>{{ $key }}</th>
                        <td>{{ $value }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


@endsection
