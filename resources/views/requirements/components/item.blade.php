<div class="fib fib-col fib-gap-21 fib-p-34 bg-contrast h-100">
    <div class="fib fib-col">
        <a href="{{ route('requirements.show', $requirement->id )}}" class="font-size-3 font-bold color-accent link">{{ $requirement->getTitle() }}</a>
    </div>

    <div class="fib fib-col fib-gap-13 h-100">
        @if ($requirement->gpus->count() > 0)
            <div class="fib">
                <p class="font-size-6">Видеокарта</p>

                <div class="fib fib-col font-end w-100">
                    @foreach ($requirement->gpus as $gpu)
                        <p class="font-size-4 color-accent">{{ $gpu->getTitle() }}</p>
                    @endforeach
                </div>
            </div>
        @endif

        @if ($requirement->cpus->count() > 0)
            <div class="fib">
                <p class="font-size-6">Процессор</p>

                <div class="fib fib-col font-end w-100">
                    @foreach ($requirement->cpus as $cpu)
                        <p class="font-size-4 color-accent">{{ $cpu->getTitle() }}</p>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="fib">
            <p class="font-size-6 w-100">Оперативная память</p>

            <div class="fib fib-col font-end w-100">
                <p class="font-size-4 color-accent">{{ $requirement->ram_require }} Gb
                </p>
            </div>
        </div>

        <div class="fib">
            <p class="font-size-6 w-100">Место на диске</p>

            <div class="fib fib-col font-end w-100">
                <p class="font-size-4 color-accent">{{ $requirement->drive_require }}
                    Gb</p>
            </div>
        </div>
    </div>

    <div class="fib fib-end">
        @if (Auth::user() && Auth::user()->is_admin)
            <div class="fib">
                <a class="fib-button hover-contrast emoji"
                    href="{{ route('requirements.edit', compact('requirement')) }}">🖍️ Ред</a>

                <form class="d-inline" action="{{ route('requirements.destroy', compact('requirement')) }}"
                    method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="fib-button hover-accent emoji">
                        @if (isset($requirement->deleted_at))
                            ♻️ Восст
                        @else
                            ❌ Удалить
                        @endif
                    </button>
                </form>
            </div>
        @endif

        <a class="fib-button hover-second"
            href="{{ route('computers.index', ['requirement' => $requirement->id]) }}">{{ $requirement->computers()->count() }} Сборки</a>
    </div>
</div>
