<div class="row justify-content-center g-4">
    @foreach ($posts as $post)
        <div class="col col-12">
            @component('posts.components.line', compact('post'))
            @endcomponent
        </div>
    @endforeach
</div>
