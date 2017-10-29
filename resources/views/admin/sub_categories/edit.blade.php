@extends('layouts.app')

@section('content')
    @include('admin.admin_partials.admin_menu')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create SubCategory</div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="/admin/sub_categories/{{ $subCategory->id }}">
                            {{ csrf_field() }}


                            <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                                <label for="category_id" class="col-md-4 control-label">Category</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="category_id">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            @if ($subCategory->category_id == $category->id )
                                                <option selected="selected" value="{{ $category->id }}">{{ $category->name }}</option>
                                            @else
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">SubCategory</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ $subCategory->name }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('identifier') ? ' has-error' : '' }}">
                                <label for="identifier" class="col-md-4 control-label">Identifier</label>
                                <div class="col-md-6">
                                    <input id="identifier" type="text" class="form-control" value="{{ $subCategory->identifier }}" name="identifier" required autofocus>

                                    @if ($errors->has('identifier'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('identifier') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <input name="_method" type="hidden" value="PUT">
                                    <input class="btn btn-primary" type="submit" value="Submit">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.admin_partials.admin_menu_bottom')
@endsection