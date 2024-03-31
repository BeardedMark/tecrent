@extends('layouts.app')

@section('title')
    {{ $post->name }}
@endsection

@section('content')
    <section class="pos-relative">
        <img class="pos-absolute pos-wallpaper" src="{{ $post->image }}">
        <div class="pos-absolute pos-overlay over-dark"></div>

        <div class="container">
            <div class="fib-section">
                <div class="row align-items-center justify-content-center g-4">
                    <div class="col col-12 col-lg-6">
                        <div class="fib fib-col fib-gap-8 fib-center color-second font-center">
                            <h1 class="font-size-1 font-bold color-accent">{{ $post->name }}</h1>
                            <p class="font-size-5">{{ $post->description }}</p>
                            <p class="font-size-large emoji">{{ $post->emoji }}</p>

                            @if (Auth::user() && Auth::user()->is_admin)
                                <div class="fib">
                                    <a class="fib-button hover-contrast emoji"
                                        href="{{ route('posts.edit', compact('post')) }}">🖍️ Редактировать</a>

                                    <form class="d-inline" action="{{ route('posts.destroy', compact('post')) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="fib-button hover-accent emoji">
                                            @if (isset($post->deleted_at))
                                                ♻️ Восстановить
                                            @else
                                                ❌ Удалить
                                            @endif
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if ($post->content)
        <section id="content" class="bg-main">
            <div class="container">
                <div class="fib-section">
                    <div class="row">
                        <div class="col">
                            <div class="fib fib-col fib-gap-8 fib-center font-center">
                                {!! $post->content !!}
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    @endif
    
    <section id="comments">
        <div class="container">
            <div class="fib-section">
                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <h2 class="font-size-1 font-bold">Комментарии</h2>
                            <p class="font-size-5">Возможно вам помогут другие статьи?</p>
                        </div>
                    </div>
                </div>

                @component('comments.components.list', ['comments' => $post->comments])
                @endcomponent
                
                <div class="col col-6">
                    <form class="fib fib-col fib-gap-21" method="POST" action="{{ route('comments.store') }}">
                        @csrf
                        <input name="commentable_type" value="App\Models\Post" hidden>
                        <input name="commentable_id" value="{{ $post->id }}" hidden>
    
                        <div class="row">
                            <div class="col">
                                <div class="fib fib-col fib-gap-13">    
                                    <div class="fib fib-col">
                                        <label for="content">Сообщение</label>
                                        <input type="text" id="content" name="content"
                                            class="fib fib-p-8 bord-second bg-main pos-w-100"
                                            required />
    
                                        <p class="font-size-6 color-second">название видеокарты бех производителя</p>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <div class="row">
                            <div class="col">
                                <div class="fib fib-end">    
                                    <input class="fib-button hover-contrast emoji" type="reset" value="⏮️ Сбросить">
                                    <button type="submit" class="fib-button hover-accent emoji">✅ Создать</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </section>
    
    <section id="content" class="">
        <div class="container">
            <div class="fib-section">
                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <h2 class="font-size-1 font-bold">Другие посты</h2>
                            <p class="font-size-5">Возможно вам помогут другие статьи?</p>
                        </div>
                    </div>
                </div>

                @component('posts.components.grid', compact('posts'))
                @endcomponent
                
                <div class="row justify-content-center">
                    <div class="col col-auto">
                        <a class="fib-button hover-contrast" href="{{ route('posts.index') }}">Все посты »</a>
                    </div>
                </div>
            </div>
    </section>
@endsection
