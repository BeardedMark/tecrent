@extends('layouts.page')

@section('title', 'Добавление предложения')
@section('description', 'Заполните обязательные поля для создания нового предложения')

@section('page-content')
    <section id="form">
        <div class="row justify-content-center">
            <div class="col">
                @include('offers.components.form', ['action' => route('offers.store')])
            </div>
        </div>
    </section>
@endsection
