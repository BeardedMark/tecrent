<div class="fib fib-p-13">asd</div>

@if (session('success'))
    <div class="frame fib fib-col fib-21">
        <div class="fib fib-col fib-13">
            <div class="fib fib-col fib-8">
                {{-- <p class="font-size-4 font-bold color-success">Готово!</p> --}}
                <p class="color-success"><span class="emoji">✅</span> {{ session('success') }}</p>
            </div>
        </div>
    </div>
@endif

@if (session('warning'))
    <div class="frame fib fib-col fib-21">
        <div class="fib fib-col fib-13">
            <div class="fib fib-col fib-8">
                {{-- <p class="font-size-4 font-bold color-warning">Внимание!</p> --}}
                <p class="color-warning"><span class="emoji">ℹ️</span> {{ session('warning') }}</p>
            </div>
        </div>
    </div>
@endif

@if (session('error'))
    <div class="frame fib fib-col fib-21">
        <div class="fib fib-col fib-13">
            <div class="fib fib-col fib-8">
                {{-- <p class="font-size-4 font-bold color-warning">Внимание!</p> --}}
                <p class="color-warning"><span class="emoji">❎</span> {{ session('error') }}</p>
            </div>
        </div>
    </div>
@endif

@if ($errors->any())
    <div class="frame fib fib-col fib-21">
        <div class="fib fib-col fib-13 fib-gap-0">
            {{-- <p class="font-size-4 font-bold fib-8 color-danger">Ошибка!</p> --}}
            
            <ul class="fib fib-col fib-8">
                @foreach ($errors->all() as $error)
                    <li class="color-danger"><span class="emoji">❎</span> {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
