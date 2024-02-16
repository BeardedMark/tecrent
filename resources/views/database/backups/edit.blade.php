@extends('database.dashboard')

@section('title', 'Восстановление Бэкапа ' . $fileName)
@section('description', 'Укажите настройки восстановления')

@section('frame')
    <form id="createBackup" class="fib fib-col fib-gap-21" method="POST" action="{{ route('backups.update', $fileName) }}">
        @csrf
        @method('PUT')
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
            <div class="col">
                <div class="fib fib-col fib-gap-8">
                    <div class="fib fib-row fib-gap-3">
                        <input class="fib fib-p-8 bord-second bg-main" type="checkbox" name="truncateTables"
                            checked>
                        <label class="fib fib-p-8">Очистить таблицу перед восстановлением (только загруженые записи)</label>
                    </div>

                    <div class="fib fib-row fib-gap-3">
                        <input class="fib fib-p-8 bord-second bg-main" type="checkbox" name="clearId"
                            checked>
                        <label class="fib fib-p-8">Очистить ID у добавляемых записей (создание новых записей)</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="fib fib-start">
                    <input class="fib-button hover-contrast emoji" type="reset" value="⏮️ Сбросить">
                    <button type="submit" class="fib-button hover-accent emoji">✅ Восстановить</button>
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
