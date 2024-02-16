<a class="fib fib-col fib-p-34 fib-gap-8 fib-center pos-ratio color-second font-center link pos-relative anim-p-21 {{ $game->deleted_at ? 'bord-danger bg-danger' : null}}"
    href="{{ route('games.show', $game->id) }}">
    <img class="pos-absolute pos-wallpaper" src="{{ asset('storage/img/games/' . $game->image) }}">
    <div class="pos-absolute pos-overlay over-dark2"></div>

    <div class="fib fib-col fib-gap-8 fib-center pos-h-100 pos-w-100">
        <div class="pos-relative pos-h-100 pos-w-100">
            <img class="pos-absolute pos-wallpaper" src="{{ asset('storage/img/games/' . $game->image) }}" alt="{{ $game->name }}">
        </div>
        {{-- <p class="font-size-3 font-bold pos-h-100">{{ $game->name }}</p> --}}
    </div>
</a>
