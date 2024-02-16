@extends('database.dashboard')

@section('title', 'Редактирование Записи')
@section('description', 'Внесите изменения и сохраните')

@section('frame')
    <form id="createBackup" class="fib fib-col fib-gap-21" method="POST"
        action="{{ route('items.update', ['table' => $table->TABLE_NAME, 'id' => $item->id]) }}">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col">
                <div class="fib fib-start">
                    <a class="fib-button hover-contrast emoji"
                        href="{{ route('items.show', ['table' => $table->TABLE_NAME, 'id' => $item->id]) }}">⬅️ Отмена</a>
                    <input class="fib-button hover-contrast emoji" type="reset" value="⏮️ Сбросить">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="fib fib-col fib-gap-13">
                    @foreach ($columns as $column)
                        <div class="fib fib-col fib-gap-5">
                            <label for="{{ $column->COLUMN_NAME }}">
                                {{ $column->COLUMN_COMMENT }}
                            </label>

                            @if (Str::endsWith($column->COLUMN_NAME, '_id'))
                                <select id="{{ $column->COLUMN_NAME }}" name="{{ $column->COLUMN_NAME }}"
                                    class="fib fib-p-8 bord-second bg-main pos-w-100"
                                    @if ($column->IS_NULLABLE === 'NO' && $column->COLUMN_NAME != 'id') required @endif>

                                    @if ($column->IS_NULLABLE === 'YES')
                                        <option value="">нет</option>
                                    @endif

                                    @foreach ($column->DATA as $option)
                                        <option value="{{ $option->id }}"
                                            @if ($option->id == $item->{$column->COLUMN_NAME}) selected @endif>
                                            {{ $option->name }}
                                        </option>
                                    @endforeach
                                </select>
                            @elseif ($column->DATA_TYPE === 'checkbox')
                                <input class="form-check-input" type="checkbox"
                                    @if ($item->{$column->COLUMN_NAME}) checked @endif>
                            @elseif ($column->DATA_TYPE === 'text')
                                <textarea id="{{ $column->COLUMN_NAME }}" class="fib fib-p-8 bord-second bg-main pos-w-100"
                                    name="{{ $column->COLUMN_NAME }}" rows="4">{{ $item->{$column->COLUMN_NAME} ?: null }}</textarea>

                                <script>
                                    CKEDITOR.replace({{ $column->COLUMN_NAME }});
                                </script>
                            @else
                                <input type="{{ $column->DATA_TYPE }}" id="{{ $column->COLUMN_NAME }}"
                                    name="{{ $column->COLUMN_NAME }}" class="fib fib-p-8 bord-second bg-main pos-w-100"
                                    @if ($column->DATA_TYPE === 'varchar' && $column->CHARACTER_MAXIMUM_LENGTH) maxlength="{{ $column->CHARACTER_MAXIMUM_LENGTH }}" @endif
                                    @if ($column->IS_NULLABLE === 'NO') required placeholder="..." @endif
                                    @if ($item->{$column->COLUMN_NAME}) value="{{ $item->{$column->COLUMN_NAME} }}" @endif />
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="fib fib-start">
                    <button type="submit" class="fib-button hover-accent emoji">✅ Сохранить</button>
                </div>
            </div>
        </div>
    </form>
@endsection
