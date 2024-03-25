<a href="{{ route('cpus.show', compact('cpu')) }}"
    class="fib fib-col fib-p-34 fib-py-55 fib-gap-13 fib-center frame font-center bg-main pos-h-100 pos-relative link">


    <div class="fib fib-col fib-center h-100">
        @if ($cpu->manufacturer)
            <p class="font-size-4">{{ $cpu->manufacturer }}</p>
        @endif
        <p class="font-size-3">{{ $cpu->name }}</p>
        <p class="font-size-5">[🗲{{ $cpu->power }}]</p>
    </div>
    
    <div class="fib fib-col fib-center">
        <p class="font-size-6 color-second">{{ $cpu->created_at }}</p>
        @if ($cpu->deleted_at)
            <p class="font-size-6 color-danger">{{ $cpu->deleted_at }}</p>
        @endif
    </div>

</a>
