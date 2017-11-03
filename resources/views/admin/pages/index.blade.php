@extends('layouts.app')

@section('content')
    @include('admin.admin_partials.admin_menu')

    <h3>Pages</h3>

    <a class="btn btn-primary" href="/admin/pages/create">Create Pages</a>
    <br>
    <br>
    @if(count($pages) > 0)
        <table class="table table-striped">
            <tr>
                <th>Title</th>
                <th></th>
                <th></th>
            </tr>
            @foreach($pages as $page)
                <tr>
                    <td><a href="/admin/pages/{{ $page->id }}">{{ $page->name_page }}</a></td>
                    <td><a class="btn btn-default" href="/admin/pages/{{ $page->id }}/edit">Edit</a></td>
                    <td>
                        <form method="POST" action="/admin/pages/{{ $page->id }}" accept-charset="UTF-8" class="pull-right">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="DELETE">
                            <input class="btn btn-danger" type="submit" value="Delete Page">

                        </form>
                    </td>
                </tr>
            @endforeach
        </table>

    @else
        <p>No Pages</p>
    @endif
    @include('admin.admin_partials.admin_menu_bottom')
@endsection