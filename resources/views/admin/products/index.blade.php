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
                    <td>{{ $product->active }}</td>
                    <td>
                        <?php $descriptions = json_decode($product->description, true); ?>
                            {{ $descriptions['article_id'] }}
                            <a href="/admin/products/{{ $product->id }}">{{ $descriptions['title_product'] }}</a>
                            {{ $descriptions['product_status'] }}
                            {!! $descriptions['general_description'] !!}
                            {{ $descriptions['price'] }}
                            {{ $descriptions['currency'] }}
                            {{ $descriptions['main_picture_url'] }}

                            @foreach( $descriptions['gallery'] as $description)
                                   {{ $description["picture_url"] }}
                            @endforeach

                            @foreach( $descriptions['properties'] as $key => $property)
                                @if ($key % 2 == 0)
                                       {{ $property['name'] }}
                                @else
                                       {{ $property['text'] }}
                                @endif
                            @endforeach
                    </td>

                    <td><a class="btn btn-default" href="/admin/products/{{ $product->id }}/edit">Edit</a></td>

                    <td>
                        <form method="POST" action="/admin/product/{{ $product->id }}" accept-charset="UTF-8" class="pull-right">
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