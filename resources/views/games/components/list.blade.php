
<div class="row justify-content-center g-4">
    @foreach ($games as $game)
        <div class="col col-6 col-md-6 col-lg-4 col-xl-3">
            @component('games.components.card', ['game' => $game])
            @endcomponent
        </div>
    @endforeach
</div>