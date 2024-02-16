@extends('database.dashboard')

@section('title', 'Бэкапы')
@section('description', 'Файловые копии данных сайта')

@section('frame')
    <div class="fib fib-col fib-gap-21">
        <div class="fib fib-start">
            <a class="fib-button hover-accent emoji" href="{{ route('backups.create') }}">➕ Создать бэкап</a>
        </div>
        
        <table class="table table-bordered table-hover bg-main font-size-6">
            <thead>
                <tr>
                    <th>Название</th>
                    <th>Размер</th>
                    <th>Дата доступа</th>
                    <th>Дата изменения</th>
                    <th>Дата создания</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($files as $file)
                    <tr>
                        <td>
                            <a class="link"
                                href="{{ route('backups.show', $file->getFilename()) }}">{{ $file->getFilename() }}</a>
                        </td>
                        <td>{{ number_format($file->getSize() / (1024 * 1024), 2) }} Мб</td>
                        <td>{{ date('Y-m-d H:i:s', $file->getATime()) }}</td>
                        <td>{{ date('Y-m-d H:i:s', $file->getMTime()) }}</td>
                        <td>{{ date('Y-m-d H:i:s', $file->getCTime()) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
