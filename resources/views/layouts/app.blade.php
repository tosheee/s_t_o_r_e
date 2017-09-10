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
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
</body>
</html>
