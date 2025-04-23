<div class="fib fib-col fib-center fib-p-21 fib-gap-8 frame bg-main bord-bg pos-h-100 fib-r-21 hover-icon pos-relative">

    @if ($offer->image)
        <a class="pos-rectangle pos-w-100 pos-relative" href="{{ route('offers.show', $offer->id) }}">
            <img class="pos-absolute pos-wallpaper fib-r-3" src="{{ asset('storage/' . $offer->image) }}">
        </a>
    @endif

    <div class="fib fib-col fib-gap-5 fib-center font-center pos-h-100">
        <div class="fib fib-col font-size-6 font-center">
            <a class="font-size-4 font-bold link color-contrast"
                href="{{ route('offers.show', $offer->id) }}">{{ $offer->getName() }}</a>

            @if ($offer->description)
                <p class="font-size-5">{{ $offer->description }}</p>
            @endif

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

        <div class="fib fib-col fib-gap-3 font-size-6 font-center {{ $offer->image ? 'pos-h-100' : ''}}">

            @if ($offer->code)
                <p>арт: {{ $offer->code }}</p>
            @endif

            @if ($offer->tags)
                <p class="fib fib-row fib-wrap fib-gap-2 fib-center">
                    @foreach ($offer->getTags() as $tag)
                        <a class="fib-px-8 fib-py-2 bg-other hover-second fib-r-3 font-size-6"
                            href="{{ route('offers.search', ['tags' => $tag]) }}">{{ $tag }}</a>
                    @endforeach
                </p>
            @endif
        </div>
    </div>

    @if ($offer->price)
        <div class="fib fib-col fib-center font-center">
            @if (isset($offer->sale))
                <p class="font-size-5 color-second font-through">{{ $offer->price }}</p>
                <p class="font-size-3 font-bold color-accent">{{ $offer->sale }}</p>
            @else
                <p class="font-size-3 font-bold">{{ $offer->price }}</p>
            @endif
            <p class="font-size-5 font-bold {{ $offer->sale ? 'color-accent' : '' }}">
                {{ $offer->unit ? 'руб/' . $offer->unit : null }}</p>
        </div>
    @endif

    @if($offer->main_at || $offer->favorited_at || $offer->sale)
        <div class="pos-absolute fib fib-row fib-end" style="top: 0px; right: 0px">
            <div class="fib fib-gap-5 fib-start fib-p-8 bg-main real-shadow fib-r-21 pointer-auto">
                @isset($offer->main_at)
                    <img width="21" height="12"
                        src="https://img.icons8.com/fluency-systems-regular/21/f12352/fairytale.png" alt="cancel" />
                @endisset

                @isset($offer->favorited_at)
                    <img width="21" height="12"
                        src="https://img.icons8.com/fluency-systems-regular/21/ffbf00/star--v1.png" alt="cancel" />
                @endisset

                @isset($offer->sale)
                    <img width="21" height="12"
                        src="https://img.icons8.com/fluency-systems-regular/21/40C057/percentage-circle.png" alt="cancel" />
                @endisset
            </div>
        </div>
    @endif
</div>
