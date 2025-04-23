<div class="row justify-content-center g-4">
    @foreach ($offers as $offer)
        <div class="col col-6 col-md-6 col-lg-4 col-xl-2">
            @component('offers.components.card', ['offer' => $offer])
            @endcomponent
        </div>
    @endforeach
</div>
