<div class="row justify-content-center g-4">
    @foreach ($posts as $post)
        <div class="col col-12 col-md-6 col-lg-4 col-xl-4">
            @component('posts.components.card', compact('post'))
            @endcomponent
        </div>
    @endforeach
</div>
