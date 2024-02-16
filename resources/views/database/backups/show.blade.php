@extends('database.dashboard')

@section('title', $fileName)
@section('description', 'Файловая копия данных сайта')

@section('frame')
    <div class="fib fib-col fib-gap-21">
        <div class="fib fib-start">
            <a class="fib-button hover-contrast emoji" href="{{ route('backups.index') }}">⬅️ Бэкапы</a>
            <a class="fib-button hover-accent emoji" href="{{ route('backups.edit', $fileName) }}">↙️
                Восстановить</a>
            <a class="fib-button hover-contrast emoji" href="{{ route('backups.download', $fileName) }}">⬇️
                Скачать</a>
            <form class="fib-button hover-contrast emoji" action="{{ route('backups.destroy', $fileName) }}"
                method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">❌ Удалить </button>
            </form>
        </div>

        <div class="fib fib-col fib-gap-8">
            <p class="fib fib-p-21 bg-main bord-second code  font-size-5">{{ $fileContent }}</p>
        </div>
    </div>
@endsection
