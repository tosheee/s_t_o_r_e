@extends('layouts.app')

@section('content')

    <div class="col-md-2"> @include('partials.v_nav_bar') </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-9">

                <form id="signin" class="navbar-form navbar-right" role="form" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="email" type="email" class="form-control" name="email" value="" placeholder="Email Address">
                    </div>

                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="password" type="password" class="form-control" name="password" value="" placeholder="Password">
                    </div>

                    <button type="submit" class="btn btn-primary">Login</button>
                </form>








            </div>
        </div>
</div>
@endsection