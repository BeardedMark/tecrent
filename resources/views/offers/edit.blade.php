@extends('layouts.page')

@section('title', 'Редактирование предложения')
@section('description', 'Измените необходимые поля и сохраните изменения')

@section('page-content')
    <section id="form">
        <div class="row justify-content-center">
            <div class="col">
                @include('offers.components.form', [
                    'action' => route('offers.update', $offer),
                    'offer' => $offer
                ])
            </div>
        </div>
    </section>
@endsection
