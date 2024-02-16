<div class="fib fib-col fib-center fib-p-34 fib-gap-13 frame bg-main pos-h-100">

    <a class="pos-rectangle pos-w-100 pos-relative" href="{{ route('computers.show', $computer->id) }}">
        @if ($computer->image)
            <img class="pos-absolute pos-wallpaper "
                src="{{ asset('storage/img/computers/' . $computer->image) }}">
        @else
            <div class="fib fib-center pos-h-100">
                <p class="font-size-large emoji color-second">🖥️</p>
            </div>
        @endif
    </a>

    <div class="fib fib-col fib-gap-3 fib-center pos-h-100">
        <a class="font-size-3 font-bold font-center link color-accent"
            href="{{ route('computers.show', $computer->id) }}">{{ $computer->name }}</a>

        <div class="fib fib-col font-size-6 font-center pos-h-100">
            @if ($computer->gpu)
                <p>{{ $computer->gpu->title() }}</p>
            @endif

            @if ($computer->cpu)
                <p>{{ $computer->cpu->title() }}</p>
            @endif

            @if ($computer->ram)
                <p>{{ $computer->ram->title() }}</p>
            @endif

            @if ($computer->drive)
                <p>{{ $computer->drive->title() }}</p>
            @endif
        </div>

        <p class="font-size-2 font-bold">{{ $computer->price }} р/д</p>
    </div>

    <form class="computer-card__button" method="POST" action="{{ route('basket.store') }}">
        @csrf
        <input type="text" hidden name="id" id="id" value="{{ $computer->id }}">
        <button class="fib-button hover-contrast" type="submit">к заказу</button>
    </form>
</div>
