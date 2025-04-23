<div class="row justify-content-center {{ isset($space) ? 'g-' . $space: '' }}">
    @foreach ($items as $item)
        <div class="col col-6 col-md-6 col-lg-4 {{ isset($xl) ? 'col-xl-' . 2 * $xl : '' }}">
            @component('offers.components.card', ['offer' => $item])
            @endcomponent
        </div>
    @endforeach
</div>
