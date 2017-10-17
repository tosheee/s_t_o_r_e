@extends('layouts.app')

@section('content')
    @include('admin.admin_partials.admin_menu')


    <h1>Edit Category</h1>
<a href="/admin/categories" class="btn btn-default">Go Back</a>

<form method="POST" action="/admin/categories/{{ $category->id }}" accept-charset="UTF-8" enctype="multipart/form-data">

    {{ csrf_field() }}

    <div class="form-group">
        <label for="name">Name Category</label>
        <input class="form-control" placeholder="Name" name="name" type="text" value="{{ $category->name }}" id="name">
    </div>

    <input name="_method" type="hidden" value="PUT">
    <input class="btn btn-primary" type="submit" value="Submit">
</form>

</main>
@include('admin.admin_partials.admin_menu_bottom')
@endsection