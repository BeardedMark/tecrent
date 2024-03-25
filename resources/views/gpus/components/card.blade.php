<a href="{{ route('gpus.show', compact('gpu')) }}"
    class="fib fib-col fib-p-34 fib-py-55 fib-gap-13 fib-center frame font-center bg-main pos-h-100 pos-relative link">
    @if ($gpu->image)
        <img class="pos-absolute pos-wallpaper" src="{{ $gpu->imageUrl() }}" alt="">
        <div class="pos-absolute pos-overlay bg-main"></div>
    @endif

    <div class="fib fib-col fib-center h-100">
        @if ($gpu->manufacturer)
            <p class="font-size-4">{{ $gpu->manufacturer }}</p>
        @endif
        <p class="font-size-3">{{ $gpu->name }}</p>
        <p class="font-size-5">[🗲{{ $gpu->power }}]</p>
    </div>
    
    <div class="fib fib-col fib-center">
        <p class="font-size-6 color-second">{{ $gpu->created_at }}</p>
        @if ($gpu->deleted_at)
            <p class="font-size-6 color-danger">{{ $gpu->deleted_at }}</p>
        @endif
    </div>

</a>
