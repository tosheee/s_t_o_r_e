@extends('layouts.app')

@section('content')
    @include('admin.admin_partials.admin_menu')


    <a href="/admin/product" class="btn btn-default">Go Back</a>
<h1>{{ $category->name }}</h1>

<div class="well">

    <a href="/admin/categories/{{ $category->id }}/edit" class="btn btn-default"> Edit </a>
    <form method="POST" action="/admin/categories/{{ $category->id }}" accept-charset="UTF-8" class="pull-right">
        {{ csrf_field() }}
        <input name="_method" type="hidden" value="DELETE">
        <input class="btn btn-danger" type="submit" value="Delete">

    </form>

</div>
    @include('admin.admin_partials.admin_menu_bottom')
@endsection