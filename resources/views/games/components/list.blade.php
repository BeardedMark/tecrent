
<div class="row g-4">
    @foreach ($games as $game)
    <div class="col col-12">
            @component('games.components.line', ['game' => $game])
            @endcomponent
        </div>
    @endforeach
</div>