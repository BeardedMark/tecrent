@extends('layouts.page')

@section('title', $requirement->name)
@section('description', $requirement->commentary)

@section('page-content')
    <section id="form">
        <div class="row justify-content-center">
            <div class="col col-12 col-md-10 col-lg-8 col-xl-6">
                <div class="fib fib-col fib-gap-21">
                    <select class="fib fib-p-8 bord-second bg-main w-100" name="gpus[]" multiple>
                        @foreach ($gpus as $gpu)
                            <option value="{{ $gpu->id }}" @if (in_array($gpu->id, $requirement->gpus->pluck('id')->toArray())) selected @endif>
                                {{ $gpu->title() }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </section>
@endsection
