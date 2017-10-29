@extends('layouts.app')

@section('content')
    @include('admin.admin_partials.admin_menu')

    <h3>Admins</h3>

    <a class="btn btn-primary" href="/admin/admins/create">Create Admin</a>
    <br>
    <br>
    @if(count($admins) > 0)
        <table class="table table-striped">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            @foreach($admins as $admin)
                <tr>
                    <td><a href="/admin/admins/{{ $admin->id }}">{{ $admin->name }}</a></td>
                    <td>{{ $admin->email }}</td>
                    <td>{{ $admin->password }}</td>
                    <td><a class="btn btn-default" href="/admin/admins/{{ $admin->id }}/edit">Edit</a></td>
                    <td>
                        <form method="POST" action="/admin/admins/{{ $admin->id }}" accept-charset="UTF-8" class="pull-right">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="DELETE">
                            <input class="btn btn-danger" type="submit" value="Delete">
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>

    @else
        <p>No Admins for Admin</p>
    @endif



    @include('admin.admin_partials.admin_menu_bottom')
@endsection