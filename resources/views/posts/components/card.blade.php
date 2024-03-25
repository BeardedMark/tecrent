<a href="{{ route('posts.show', compact('post')) }}"
    class="fib fib-col fib-p-34 fib-py-55 fib-gap-13 fib-center frame font-center bg-main pos-h-100 pos-relative link {{ $post->image ? 'color-main' : 'color-contrast'}}">
    @if ($post->image)
        <img class="pos-absolute pos-wallpaper" src="{{ $post->image }}" alt="">
        <div class="pos-absolute pos-overlay bg-contrast"></div>
    @endif

    @if ($post->emoji)
        <p class="font-size-1 emoji">{{ $post->emoji }}</p>
    @endif

    <div class="fib fib-col fib-center h-100">
        <p class="font-size-3">{{ $post->name }}</p>

        @if ($post->description)
            <p class="font-size-5 color-second">{{ $post->description }}</p>
        @endif
    </div>
    
    <div class="fib fib-col fib-gap-8 fib-center">
        <p class="font-size-6 color-second">{{ $post->created_at }}</p>
        <p class="font-size-4 color-second"><span class="emoji">🗨️</span>{{ Count($post->comments) }}</p>
    </div>

</a>
