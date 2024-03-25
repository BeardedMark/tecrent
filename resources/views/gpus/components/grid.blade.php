<div class="row justify-content-center g-4">
    @foreach ($gpus as $gpu)
        <div class="col col-12 col-md-6 col-lg-4 col-xl-3">
            @component('gpus.components.card', compact('gpu'))
            @endcomponent
        </div>
    @endforeach
</div>
