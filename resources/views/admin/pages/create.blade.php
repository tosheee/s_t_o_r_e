@extends('layouts.app')

@section('content')
    @include('admin.admin_partials.admin_menu')

    <div class="basic-grey">
        <form class="form-horizontal" method="POST" action="{{ route('pages.store') }}">
            {{ csrf_field() }}

            <label>
                <span>Name Page:</span>
                <input type="text" name="name_page" value="" id="admin_product_description" class="label-values"/>
            </label>

            <label>
                <span style="margin: 0;">Active Page: </span>
                <input type="radio" name="active_page" value="1" checked> Yes:
                <input type="radio" name="active_page" value="0"> Not:
            </label>
            <br>

            <label>
                <span>Url Page:</span>
                <input type="text" name="url_page" value="" id="admin_product_description" class="label-values"/>
            </label>

            <span>Content:</span>
            <label>
                <textarea name="content" id="editor-page-create" ></textarea>
            </label>

            <div class="actions">
                <input type="submit" name="commit" value="Create Page" class="btn btn-success">
            </div>

        </form>
    </div>


    <script src="{{ URL::to('/') }}/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>

    <script>
        CKEDITOR.replace( 'editor-page-create' );
    </script>

    @include('admin.admin_partials.admin_menu_bottom')
@endsection
