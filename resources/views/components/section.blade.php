<section class="pos-relative bg-{{ $background['color'] ?? '' }}" @isset($id) id="{{$id}}" @endisset>
    @isset($background)
        @isset($background['image'])
            <img class="pos-absolute pos-wallpaper" src="{{ $background['image'] }}" alt="{{ $background['image'] }}">
        @endisset
        @isset($background['overlay'])
            <div class="pos-absolute pos-overlay bg-{{ $background['overlay'] }}"></div>
        @endisset
    @endisset

    <div class="container">
        <div class="fib-section">
            @if (isset($header) || isset($description))
                <div class="row justify-content-center">
                    <div class="col col-12 col-lg-6">
                        <div
                            class="fib fib-col fib-gap-8 fib-center font-center color-{{ $style['color'] ?? 'contrast' }}">
                            @isset($header)
                                <h{{ $size ?? 2 }} class="font-size-{{ $size ?? 2 }} font-bold">
                                    {{ $header }}
                                    </h{{ $size ?? 2 }}>
                                @endisset

                                @isset($description)
                                    <p class="font-size-5">{{ $description }}</p>
                                @endisset
                        </div>
                    </div>
                </div>
            @endif

            @isset($items)
                <div class="row justify-content-center g-4">
                    @foreach ($items as $item)
                        <div class="col col-6 col-md">
                            @component('components.card', compact('item'))
                            @endcomponent
                        </div>
                    @endforeach
                </div>
            @endisset

            @if (isset($content) || isset($promo))
                <div class="row justify-content-center">
                    <div class="col col-12 col-lg-6">
                        <div
                            class="fib fib-col fib-gap-8 fib-center font-center color-{{ $style['color'] ?? 'contrast' }}">
                            @isset($promo)
                                <p class="font-size-1">{{ $promo }}</p>
                            @endisset

                            @isset($content)
                                <p class="font-size-4">{{ $content }}</p>
                            @endisset
                        </div>
                    </div>
                </div>
            @endif

            @isset($link)
                <div class="row justify-content-center">
                    <div class="col col-auto">
                        <a class="fib-button hover-{{ $link['style'] ?? 'contrast' }}"
                            href="{{ $link['href'] }}">{{ $link['label'] ?? 'Подробнее' }}</a>
                    </div>
                </div>
            @endisset
        </div>
    </div>
</section>
