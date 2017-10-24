@extends('layouts.app')

@section('content')

    @include('admin.admin_partials.admin_menu')

    <a class="btn btn-primary" href="/admin/products/create">Create Product</a>

    <br>
    <br>
    @if(count($subCategories) > 0)
        <table class="table table-striped">
            <tr>
                <th>Category</th>
                <th>SubCategory</th>
                <th>Identifier</th>
                <th>Active</th>
                <th>Product Information</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            @foreach($products as $product)
                <tr>
                    @foreach($categories as $category)
                        @if($product->category_id == $category->id)
                            <td>{{ $category->name }} </td>
                        @endif
                    @endforeach

                    @foreach($subCategories as $subCategory)
                        @if($product->sub_category_id == $subCategory->id)
                            <td>{{ $subCategory->name }} </td>
                        @endif
                    @endforeach


                    <td>{{ $product->identifier }}</td>
                    <td>{{ $product->active == 1 ? 'Active' : 'Not' }}</td>
                    <td>
                        <?php $descriptions = json_decode($product->description, true); ?>

                            @if(isset($descriptions['article_id']))
                                {{ $descriptions['article_id'] }}
                            @endif

                            @if(isset($descriptions['title_product']))
                                <a href="/admin/products/{{ $product->id }}">{{ $descriptions['title_product'] }}</a>
                            @endif

                                <div class="middle">
                                @if (isset($descriptions['main_picture_url']))
                                    <img style="margin: 0 auto; width: 120px;height: 100px;" src="{{ $descriptions['main_picture_url'] }}" alt="pic" />
                                @elseif(isset($descriptions['upload_main_picture']))
                                    <img style="margin: 0 auto; width: 120px;height: 100px;" src="/storage/upload_pictures/{{ $product->id }}/{{ $descriptions['upload_main_picture'] }}" alt="pic" />
                                @else
                                    <img style="margin: 0 auto; width: 120px;height: 100px;" src="/storage/upload_picture/noimage.jpg" alt="pic" />
                                @endif
                            </div>
                    </td>

                    <td><a class="btn btn-default" href="/admin/products/{{ $product->id }}/edit">Edit</a></td>

                    <td>
                        <form method="POST" action="/admin/products/{{ $product->id }}" accept-charset="UTF-8" class="pull-right">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="DELETE">
                            <input class="btn btn-danger" type="submit" value="Delete">

                        </form>
                    </td>
                </tr>
            @endforeach
        </table>

    @else
        <p>No category for SubCategory</p>
    @endif
    @include('admin.admin_partials.admin_menu_bottom')
@endsection