<div class="fib fib-col fib-p-21 frame bg-main">
    <div class="row align-items-center justify-content-center">
        <div class="col col-2 col-lg-1">
            <p class="font-size-6">ID {{ $computer->id }} </p>
        </div>

        <div class="col col-lg-3">
            <a class="font-size-3 link" href="{{ route('computers.show', $computer->id) }}">{{ $computer->name }}</a>
        </div>

        <div class="col d-none d-lg-block">
            <p class="font-size-5">{{ $computer->commentary }} </p>
        </div>

        <div class="col col-auto">
            <p class="font-size-3">{{ $computer->price }} р/д</p>
        </div>

        <div class="col col-auto">
            <form method="POST" action="{{ route('basket.destroy', $computer->id) }}">
                @csrf
                @method('DELETE')
                <input type="text" hidden name="id" id="id" value="{{ $computer->id }}">
                <button class="link emoji" type="submit">❌</button>
            </form>
        </div>
    </div>
</div>
