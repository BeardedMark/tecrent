<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <title>@yield('title', env('APP_NAME'))</title>

    <meta name="description" content="@yield('description', 'pcrent.devirs.com')">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Метатеги --}}
    @component('layouts.resources.meta')
    @endcomponent

    {{-- Шрифты --}}
    @component('layouts.resources.fonts')
    @endcomponent

    {{-- Фреймворки --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>

    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>

    {{-- Стили --}}
    {{-- @component('layouts.resources.styles')
    @endcomponent --}}

    
    <link rel="stylesheet" href="{{ asset('css/framework/style.css') }}">
</head>

<body class="body">
    <main id="main" class="position-relative">
        <section>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h1>Header 1</h1>
                        <h2>Header 2</h2>
                        <h3>Header 3</h3>
                        <h4>Header 4</h4>
                        <h5>Header 5</h5>
                        <h6>Header 6</h6>
                        
                        <a href="#">hypertext</a>
                        <p>paragraph</p>
                        <p>
                            <span>span</span>
                            <small>small</small>
                            <strong>strong</strong>
                        </p>
                    </div>
                    
                    <div class="col">
                        <p class="font-size-xxl">xxl</p>
                        <p class="font-size-xl">xl</p>
                        <p class="font-size-lg">lg</p>
                        <p class="font-size-md">md</p>
                        <p class="font-size-sm">sm</p>

                        <p class="font-size-1">font-size-1</p>
                        <p class="font-size-2">font-size-2</p>
                        <p class="font-size-3">font-size-3</p>
                        <p class="font-size-4">font-size-4</p>
                        <p class="font-size-5">font-size-5</p>
                        <p class="font-size-6">font-size-6</p>
                    </div>
                    
                    <div class="col">
                        <p class="font-bold">font-bold</p>

                        <p class="color-main">color-main</p>
                        <p class="color-contrast">color-contrast</p>
                        <p class="color-second">color-second</p>
                        <p class="color-accent">color-accent</p>
                        <p class="color-danger">color-danger</p>
                        <p class="color-success">color-sucsess</p>
                        <p class="color-warning">color-warning</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
    @component('layouts.resources.scripts')
    @endcomponent
</body>

</html>
