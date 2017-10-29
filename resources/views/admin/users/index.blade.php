@extends('layouts.app')

@section('content')
    @include('admin.admin_partials.admin_menu')

    <h3>Users</h3>

    <a class="btn btn-primary" href="/admin/users/create">Create User</a>
    <br>
    <br>
    @if(count($users) > 0)
        <table class="table table-striped">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            @foreach($users as $user)
                <tr>
                    <td><a href="/admin/users/{{ $user->id }}">{{ $user->name }}</a></td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->password }}</td>
                    <td><a class="btn btn-default" href="/admin/users/{{ $user->id }}/edit">Edit</a></td>
                    <td>

                        <form method="POST" action="/admin/users/{{ $user->id }}" accept-charset="UTF-8" class="pull-right">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="DELETE">
                            <input class="btn btn-danger" type="submit" value="Delete">

                        </form>

                    </td>
                </tr>
            @endforeach
        </table>

    @else
        <p>No User for Users</p>
    @endif



    @include('admin.admin_partials.admin_menu_bottom')
@endsection