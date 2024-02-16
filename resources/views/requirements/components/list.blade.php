<div class="row justify-content-center gy-4">
    @foreach ($requirements as $requirement)
        <div class="col col-4">
            @component('requirements.components.item', compact('requirement'))
            @endcomponent
        </div>
    @endforeach
</div>
