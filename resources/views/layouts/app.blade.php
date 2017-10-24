<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ URL::asset('css/app.css') }}" rel="stylesheet" type="text/css" >
    <script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/bootstrap.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/jquery-3.1.1.js') }}"></script>
</head>
<body>
    <div id="app">

        <header>
            @include('partials.horizontal_nav_bar')
        </header>

        <div id="wrapper">
            <div class="container-fluid">
                <div class="row">
                     @yield('content') </div>
                </div>
            </div>
        </div>


        <footer>
            @include('partials.footer')
        </footer>
        <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'editor1' );
    </script>
</body>
</html>
