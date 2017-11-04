@extends('layouts.app')

@section('content')
    @include('admin.admin_partials.admin_menu')

    <div class="basic-grey">
        <form class="form-horizontal" method="POST" action="/admin/pages/{{ $page->id }}">
            {{ csrf_field() }}

            <label>
                <span>Name Page:</span>
                <input type="text" name="name_page" value="{{ $page->name_page }}" id="admin_product_description" class="label-values"/>
            </label>

            <label>
                <span style="margin: 0;">Active Page: </span>
                <input type="radio" name="active_page" value="1" {{ $page->active_page == 1 ? 'checked' : '' }}> Yes
                <input type="radio" name="active_page" value="0" {{ $page->active_page == 1 ? '' : 'checked' }}> Not
            </label>
            <br>

            <label>
                <span>Url Page:</span>
                <input type="text" name="url_page" value="{{ $page->url_page }}" id="admin_product_description" class="label-values"/>
            </label>

            <span>Content:</span>
            <label>
                <textarea name="content" id="editor-page-create" >{!! $page->content !!}</textarea>
            </label>

            <div class="actions">
                <input name="_method" type="hidden" value="PUT">
                <input type="submit" name="commit" value="Edit Page" class="btn btn-success">
            </div>
        </form>
    </div>


    <script src="{{ URL::to('/') }}/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>

    <script>
        CKEDITOR.replace( 'editor-page-create' );
    </script>

@include('admin.admin_partials.admin_menu_bottom')
@endsection