<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Floro Mania</title>

        <link href="https://stark-shelf-54930.herokuapp.com/css/app.css" rel="stylesheet" type="text/css" >
        <link href="{{ URL::asset('css/app.css') }}" rel="stylesheet" type="text/css" >



        <script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>

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
    </body>
</html>
