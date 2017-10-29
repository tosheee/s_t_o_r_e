@extends('layouts.app')

@section('content')
    @include('admin.admin_partials.admin_menu')

<h1>Edit User</h1>
<a href="/admin/users" class="btn btn-default">Go Back</a>

    <br>
    <br>

<form method="POST" action="/admin/users/{{ $user->id }}" accept-charset="UTF-8" enctype="multipart/form-data">

    {{ csrf_field() }}

    <div class="form-group">
        <label for="name">User Name</label>
        <input class="form-control" placeholder="Name" name="name" type="text" value="{{ $user->name }}" id="name">
    </div>

    <div class="form-group">
        <label for="name">Email</label>
        <input class="form-control" placeholder="Email" name="email" type="text" value="{{ $user->email }}" id="email">
    </div>

    <div class="form-group">
        <label for="name">Password</label>
        <input class="form-control" placeholder="Password" name="password" type="text" value="{{ $user->password }}" id="password">
    </div>

    <input name="_method" type="hidden" value="PUT">
    <input class="btn btn-primary" type="submit" value="Submit">
</form>

</main>
    @include('admin.admin_partials.admin_menu_bottom')
@endsection