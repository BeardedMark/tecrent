<div class="row justify-content-center g-4">
    @foreach ($computers as $computer)
        <div class="col col-6 col-md-6 col-lg-4 col-xl-3">
            @component('computers.components.card', ['computer' => $computer])
            @endcomponent
        </div>
    @endforeach
</div>
