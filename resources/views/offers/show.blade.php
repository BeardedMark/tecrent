@extends('layouts.app')

@section('title')
    {{ $offer->meta_title ?? $offer->name }}
@endsection

@section('description')
    {{ $offer->commentary }} {{ $offer->name }} в аренду за {{ $offer->price }}
    ₽{{ $offer->unit ? '/' . $offer->unit : null }}
@endsection

@section('keywords')
    {{ $offer->meta_keywords ?? $offer->tags }}
@endsection

@push('toolbar')
    <a class="hover-link" href="{{ route('offers.edit', compact('offer')) }}">Редактировать</a>

    <form action="{{ route('offers.toggleMain', $offer->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('PATCH')
        <button type="submit" class="hover-link">{{ $offer->main_at ? 'Не основной' : 'Основной' }}</button>
    </form>

    <form action="{{ route('offers.toggleFavorite', $offer->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('PATCH')
        <button type="submit" class="hover-link">{{ $offer->favorited_at ? 'Из избранного' : 'В избранное' }}</button>
    </form>

    <form action="{{ route('offers.togglePublished', $offer->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('PATCH')
        <button type="submit" class="hover-link">{{ $offer->published_at ? 'Скрыть' : 'Опубликовать' }}</button>
    </form>

    <form action="{{ route('offers.toggleArchived', $offer->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('PATCH')
        <button type="submit" class="hover-link">{{ $offer->archived_at ? 'Из архива' : 'В архив' }}</button>
    </form>

    <form class="d-inline" action="{{ route('offers.destroy', compact('offer')) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="hover-link color-accent">
            @if (isset($offer->deleted_at))
                Восстановить
            @else
                Удалить
            @endif
        </button>
    </form>
@endpush

@if ($offer->comment)
    @push('toolbar-comment')
        <p>{{ $offer->comment }}</p>
    @endpush
@endif


@section('content')

    <section class="pos-relative overflow-hidden">
        {{-- @isset($offer->wallpaper)
            <img class="pos-absolute pos-wallpaper" src="{{ asset('storage/' . $offer->wallpaper) }}" alt="{{ $offer->wallpaper }}">
            <div class="pos-absolute pos-overlay bg-main"></div>
        @endisset --}}

        <div class="container">
            <div class="fib-section">
                <div class="row justify-content-center align-items-center g-4">
                    <div class="col order-1 order-lg-1 col-12 col-lg">
                        <div class="fib fib-col fib-gap-13 fib-center font-center">

                            <div>
                                <p class="font-size-1 font-bold color-accent">{{ $offer->name }}</p>
                                <p class="font-size-4">{{ $offer->description }}</p>

                                @if ($offer->type || $offer->group)
                                    <p class="font-size-6">
                                        @isset($offer->type)
                                            <a class="hover-link"
                                                href="{{ route('offers.search', ['type' => $offer->type]) }}">{{ $offer->type }}</a>
                                        @endisset

                                        @if ($offer->type && $offer->group)
                                            <span>/</span>
                                        @endif

                                        @isset($offer->group)
                                            <a class="hover-link"
                                                href="{{ route('offers.search', ['group' => $offer->group]) }}">{{ $offer->group }}</a>
                                        @endisset
                                @endif
                            </div>
                            @if ($offer->main_at || $offer->favorited_at)
                                <div class=" fib fib-row fib-end" style="top: 0px; right: 0px">
                                    <div class="fib fib-gap-5 fib-start fib-p-8 bg-main fib-r-21 pointer-auto">
                                        @isset($offer->main_at)
                                            <img width="21" height="12"
                                                src="https://img.icons8.com/fluency-systems-regular/21/f12352/fairytale.png"
                                                alt="cancel" />
                                        @endisset

                                        @isset($offer->favorited_at)
                                            <img width="21" height="12"
                                                src="https://img.icons8.com/fluency-systems-regular/21/ffbf00/star--v1.png"
                                                alt="cancel" />
                                        @endisset

                                        @isset($offer->sale)
                                            <img width="21" height="12"
                                                src="https://img.icons8.com/fluency-systems-regular/21/40C057/percentage-circle.png"
                                                alt="cancel" />
                                        @endisset
                                    </div>
                                </div>
                            @endif

                            @isset($offer->price)
                                <div>
                                    @if (isset($offer->sale))
                                        <p class="font-size-3 font-bold color-second font-through">{{ $offer->price }}₽</p>
                                        <p class="font-size-1 font-bold color-accent">{{ $offer->sale }}
                                            ₽{{ $offer->unit ? '/' . $offer->unit : null }}</p>
                                    @else
                                        <p class="font-size-1 font-bold">{{ $offer->price }}
                                            ₽{{ $offer->unit ? '/' . $offer->unit : null }}</p>
                                    @endif
                                </div>
                            @endisset
                        </div>
                    </div>

                    @if ($offer->image)
                        <div class="col order-2 order-lg-2 col-12 col-lg-4">
                            <img src="{{ asset('storage/' . $offer->image) }}">
                        </div>
                    @endif


                    @if ($offer->data)
                        <div class="col order-3 order-lg-3 col-12 col-lg">
                            <div class="fib fib-col fib-gap-13 font-center">
                                @foreach ($offer->getData() as $param)
                                    @if (isset($param['is_global']) && $param['is_global'])
                                        <div class="fib fib-col">
                                            <p class="font-size-5">{{ $param['title'] }}</p>
                                            <p class="font-size-4 font-bold color-accent">{{ $param['value'] }}</p>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section id="content" class="bg-main">
        <div class="container">
            <div class="fib-section">
                <div class="row justify-content-center">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <h1 class="font-size-1 font-bold">{{ $offer->meta_title ?? 'Предложение ' . $offer->name }}
                            </h1>
                            <p class="font-size-5">Список всех наших товаров и услуг</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            {!! $offer->content !!}
                        </div>
                    </div>
                </div>

                @if ($offer->tags)
                    <div class="row">
                        <div class="col">
                            <div class="fib fib-col fib-gap-8 fib-center font-center">
                                <p class="fib fib-row fib-wrap fib-gap-13 fib-center">
                                    @foreach ($offer->getTags() as $tag)
                                        <a class="fib-button hover-second"
                                            href="{{ route('offers.search', ['tags' => $tag]) }}">{{ $tag }}</a>
                                    @endforeach
                                </p>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="row g-4 justify-content-center">
                    @isset($offer->data)
                        <div class="col col-12 col-lg-6">
                            <div class="fib fib-col fib-gap-8">
                                @foreach ($offer->getData() as $param)
                                    @component('components.paramitem', ['title' => $param['title'], 'value' => $param['value']])
                                    @endcomponent
                                @endforeach
                            </div>
                        </div>
                    @endisset

                    <div class="col col-12 col-lg-6">
                        <div class="fib fib-col fib-gap-8">
                            @if ($offer->code)
                                @component('components.paramitem', ['title' => 'Артикул', 'value' => $offer->code])
                                @endcomponent
                            @endif

                            @if ($offer->type)
                                @component('components.paramitem', ['title' => 'Тип', 'value' => $offer->type])
                                @endcomponent
                            @endif

                            @if ($offer->group)
                                @component('components.paramitem', ['title' => 'Группа', 'value' => $offer->group])
                                @endcomponent
                            @endif

                            @if ($offer->stock)
                                @component('components.paramitem', ['title' => 'Наличие', 'value' => $offer->stock])
                                @endcomponent
                            @endif

                            @if ($offer->archived_at)
                                @component('components.paramitem', ['title' => 'Дата архивации', 'value' => $offer->archived_at])
                                @endcomponent
                            @endif

                            @if ($offer->published_at)
                                @component('components.paramitem', ['title' => 'Дата публикации', 'value' => $offer->published_at])
                                @endcomponent
                            @endif

                            @if ($offer->deleted_at)
                                @component('components.paramitem', ['title' => 'Дата удаления', 'value' => $offer->deleted_at])
                                @endcomponent
                            @endif

                            @if ($offer->updated_at && $offer->created_at != $offer->updated_at && $offer->deleted_at != $offer->updated_at)
                                @component('components.paramitem', ['title' => 'Дата обновления', 'value' => $offer->updated_at])
                                @endcomponent
                            @endif

                            @component('components.paramitem', ['title' => 'Дата создания', 'value' => $offer->created_at])
                            @endcomponent
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <section>
        <div class="container">
            <div class="fib-section">
                <div class="row justify-content-center">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <h2 class="font-size-2 font-bold">Другие предложения</h2>
                            <p class="font-size-5">Случайные предложения из нашего каталога</p>
                        </div>
                    </div>
                </div>

                @component('offers.components.list', ['offers' => $offer->getRandomOffers(6)])
                @endcomponent

                <div class="row justify-content-center">
                    <div class="col col-auto">
                        <a class="fib-button hover-main" href="{{ route('offers.index') }}">Все предложения</a>
                    </div>
                </div>
            </div>
    </section>
@endsection
