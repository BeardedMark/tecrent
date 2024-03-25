<a href="{{ route('posts.show', compact('post')) }}"
    class="fib fib-col fib-px-21 fib-py-13 fib-gap-13 frame bg-main pos-relative link">
    @if ($post->image)
        <img class="pos-absolute pos-wallpaper" src="{{ $post->image }}" alt="">
        <div class="pos-absolute pos-overlay bg-contrast"></div>
    @endif

    <div class="fib fib-gap-13 fib-center">
        <div class="fib fib-col">
            <p class="font-size-3">{{ $post->name }}</p>

            @if ($post->description)
                <p class="font-size-5 color-second">{{ $post->description }}</p>
            @endif
        </div>

        @if ($post->emoji)
            <p class="font-size-1 emoji">{{ $post->emoji }}</p>
        @endif
    </div>


    <div class="fib fib-gap-13">
        <p class="font-size-6 color-second w-100">{{ $post->created_at }}</p>
        <p class="font-size-6 color-second">#{{ $post->id }}</p>
    </div>
</a>
