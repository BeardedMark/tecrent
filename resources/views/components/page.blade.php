@extends('layouts.app')
@section('title', $data['title'])
@section('description', $data['description'])
@section('keywords', $data['keywords'])

@section('content')
    @foreach ($data['sections'] as $section)
        @component('components.section', $section)
        @endcomponent
    @endforeach
@endsection
