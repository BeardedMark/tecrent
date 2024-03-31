
<div class="row justify-content-center g-4">
    @foreach ($comments as $comment)
        <div class="col col-12">
            @component('comments.components.line', compact('comment'))
            @endcomponent
        </div>
    @endforeach
</div>
