@extends('database.dashboard')

@section('title', 'Создание Бэкапа')
@section('description', 'Укажите таблицы, которые хотите сохранить')

@section('frame')
    <form id="createBackup" class="fib fib-col fib-gap-21" method="POST" action="{{ route('backups.store') }}">
        @csrf
        <div class="row">
            <div class="col">
                <div class="fib fib-start">
                    <a class="fib-button hover-contrast emoji" href="{{ route('backups.index') }}">⬅️ Бэкапы</a>

                    <button class="fib-button hover-contrast emoji" type="button" onclick="toggleCheckboxes(true)">✅ Выделить все</button>
                    <button class="fib-button hover-contrast emoji" type="button" onclick="toggleCheckboxes(false)">❎ Снять выделение</button>
                    <button class="fib-button hover-contrast emoji" type="button" onclick="toggleCheckboxes()">🔄 Инвертировать выделение</button>
                </div>
            </div>
        </div>

        <div class="row g-1">
            @foreach ($tables as $table)
                <div class="col col-3">
                    <div class="fib fib-row fib-gap-3">
                        <input id="{{ $table->TABLE_NAME }}" class="fib fib-p-8 bord-second bg-main" type="checkbox" name="{{ $table->TABLE_NAME }}"
                            checked>
                        <label for="{{ $table->TABLE_NAME }}" class="fib fib-p-8">{{ $table->TABLE_COMMENT ?: $table->TABLE_NAME }}</label>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row">
            <div class="col">
                <div class="fib fib-start">
                    <input class="fib-button hover-contrast emoji" type="reset" value="⏮️ Сбросить">
                    <button type="submit" class="fib-button hover-accent emoji">✅ Создать</button>
                </div>
            </div>
        </div>
    </form>
@endsection

<script>
    function toggleCheckboxes(check) {
        var checkboxes = document.querySelectorAll('#createBackup input[type="checkbox"]');

        checkboxes.forEach(function(checkbox) {
            if (check === true) {
                checkbox.checked = true;
            } else if (check === false) {
                checkbox.checked = false; 
            } else {
                checkbox.checked = !checkbox.checked;
            }
        });
    }
</script>
