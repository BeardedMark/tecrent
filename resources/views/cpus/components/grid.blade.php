<div class="row justify-content-center g-4">
    @foreach ($cpus as $cpu)
        <div class="col col-12 col-md-6 col-lg-4 col-xl-3">
            @component('cpus.components.card', compact('cpu'))
            @endcomponent
        </div>
    @endforeach
</div>
