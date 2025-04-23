@php $hasLink = isset($item['link']); @endphp

<{{ $hasLink ? 'a' : 'div' }}
    {{ $hasLink ? 'href=' . $item['link'] : '' }}
    class="fib fib-col fib-p-21 fib-gap-8 fib-x-center frame font-center bg-main pos-h-100 fib-r-21 bord-bg hover-icon
    {{ $hasLink ? 'card-clickable' : '' }}"
    style="text-decoration: none; color: inherit;"
>
    @isset($item['icon'])
        <img width="48" height="48" src="https://img.icons8.com/fluency-systems-regular/48/333333/{{ $item['icon'] }}"
            alt="{{ $item['icon'] }}" />
    @endisset

    @isset($item['title'])
        <p class="font-size-2 color-accent">{{ $item['title'] }}</p>
    @endisset

    @isset($item['header'])
        <p class="font-size-3">{{ $item['header'] }}</p>
    @endisset

    @isset($item['description'])
        <p class="font-size-4">{{ $item['description'] }}</p>
    @endisset

    @isset($item['content'])
        <p class="font-size-5">{{ $item['content'] }}</p>
    @endisset

    @if($hasLink)
        <div class="fib fib-end pos-h-100">
            <p class="color-second font-size-5 hover-link">подробнее</p>
        </div>
    @endif
</{{ $hasLink ? 'a' : 'div' }}>
