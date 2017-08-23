@extends('layouts.app')

@section('content')
    <h3>Categories</h3>

    <a class="btn btn-primary" href="/admin/categories/create">Create Post</a>
    <br>
    <br>
    @if(count($categories) > 0)
        <table class="table table-striped">
            <tr>
                <th>Title</th>
                <th></th>
                <th></th>
            </tr>
            @foreach($categories as $category)
                <tr>
                    <td><a href="/admin/categories/{{ $category->id }}">{{ $category->name }}</a></td>
                    <td><a class="btn btn-default" href="/admin/categories/{{ $category->id }}/edit">Edit</a></td>
                    <td>

                        <form method="POST" action="/admin/categories/{{ $category->id }}" accept-charset="UTF-8" class="pull-right">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="DELETE">
                            <input class="btn btn-danger" type="submit" value="Delete">

                        </form>

                    </td>
                </tr>
            @endforeach
        </table>

    @else
        <p>No category for Category</p>
    @endif
@endsection