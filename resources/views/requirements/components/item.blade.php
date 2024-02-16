<div class="row">
    <div class="col">

        <div class="fib fib-col fib-gap-13 fib-p-34 bg-contrast font-center fib-center">
            <p class="font-size-4">{{ $requirement->name }}</p>

            @if ($requirement->gpus->count() > 0)
            <div class="fib fib-col">
                    <p class="font-size-6">Видеокарта</p>
                    @foreach ($requirement->gpus as $gpu)
                        <p class="font-size-4 color-accent">{{ $gpu->title() }}</p>
                    @endforeach
                </div>
            @endif

            @if ($requirement->cpus->count() > 0)
            <div class="fib fib-col">
                    <p class="font-size-6">Процессор</p>
                    @foreach ($requirement->cpus as $cpu)
                        <p class="font-size-4 color-accent">{{ $cpu->title() }}</p>
                    @endforeach
                </div>
            @endif

            <div class="fib fib-col">
                <p class="font-size-6">Оперативная память</p>
                <p class="font-size-4 color-accent">{{ $requirement->ram_require }} Gb
                </p>
            </div>

            <div class="fib fib-col">
                <p class="font-size-6">Место на диске</p>
                <p class="font-size-4 color-accent">{{ $requirement->drive_require }}
                    Gb</p>
            </div>

            <div class="fib fib-center">
                <a class="fib-button hover-second"
                    href="{{ route('computers.index') }}">{{ $requirement->computers()->count() }} Сборки</a>
            </div>

        </div>
    </div>
</div>

{{-- <hr>

<div class="fib fib-col fib-px-21  fib-py-8 fib-gap-8 font-center bg-contrast">
    <div class="row d-flex align-items-center gy-4">
        <div class="col col-lg-2">
            <a href="#" class="link">
                <div class="fib fib-col fib-p-21 fib-gap-8">
                    <p class="font-size-4">{{ $requirement->name }}</p>
                </div>

            </a>
        </div>

        <div class="col col-12 col-lg order-3 order-lg-2">
            <div class="row d-flex align-items-center g-3">
                <div class="col col-12 col-md">
                    <div class="fib fib-col fib-p-21 fib-gap-8">
                        <p class="font-size-6">Видеокарта</p>
                        @if ($requirement->gpus->count() > 0)
                            @foreach ($requirement->gpus as $gpu)
                                <p class="font-size-4 color-accent">{{ $gpu->title() }}</p>
                            @endforeach
                        @else
                            <p>━</p>
                        @endif
                    </div>
                </div>

                <div class="col col-12 col-md">
                    <div class="fib fib-col fib-p-21 fib-gap-8">
                        <p class="font-size-6">Процессор</p>
                        @if ($requirement->cpus->count() > 0)
                            @foreach ($requirement->cpus as $cpu)
                                <p class="font-size-4 color-accent">{{ $cpu->title() }}</p>
                            @endforeach
                        @else
                            <p>━</p>
                        @endif
                    </div>
                </div>

                <div class="col col-12 col-md">
                    <div class="fib fib-col fib-p-21 fib-gap-8">
                        <p class="font-size-6">Оперативная память</p>
                        <p class="font-size-4 color-accent">{{ $requirement->ram_require }} Gb
                        </p>
                    </div>
                </div>

                <div class="col col-12 col-md">
                    <div class="fib fib-col fib-p-21 fib-gap-8">
                        <p class="font-size-6">Место на диске</p>
                        <p class="font-size-4 color-accent">{{ $requirement->drive_require }}
                            Gb</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col col-auto col-lg-auto order-2 order-lg-3 ">
            <a href="#" class="color-brand link">
                <div class="fib fib-col fib-p-21 fib-gap-8">
                    <p class="font-size-6">Сборок</p>

                    @if ($requirement->computers()->count() > 0)
                        <p class="font-size-4">{{ $requirement->computers()->count() }} шт</p>
                    @else
                        <p>━</p>
                    @endif
                </div>
            </a>
        </div>
    </div>
</div> --}}
