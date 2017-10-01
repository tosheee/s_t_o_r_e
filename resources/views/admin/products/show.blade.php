@extends('layouts.app')

@section('content')

    @include('admin.admin_partials.admin_menu')

        <?php $descriptions = json_decode($product->description, true); ?>


        <a href="/admin/categories" class="btn btn-default">Go Back</a>
        <a class="btn btn-default" href="/admin/products/{{ $product->id }}/edit">Edit</a>

        <form method="POST" action="/admin/product/{{ $product->id }}" accept-charset="UTF-8" class="pull-right">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="DELETE">
            <input class="btn btn-danger" type="submit" value="Delete">

        </form>

        <hr>

        <ul>
            <li>
            @foreach($categories as $category)
                @if($product->category_id == $category->id)
                    {{ $category->name }}
                @endif
            @endforeach
               /
            @foreach($subCategories as $subCategory)
                @if($product->sub_category_id == $subCategory->id)
                    {{ $subCategory->name }} </li>
                @endif
            @endforeach
        <ul>



        <div class="col-xs-4 item-photo">
            <img style="max-width:100%;" src=" {{ $descriptions['main_picture_url'] }}" />
        </div>

        <div class="col-xs-5" style="border:0px solid gray">



            <h3>{{ $descriptions['title_product'] }}</h3>



            <h5 style="color:#337ab7">vendido por <a href="#">Samsung</a> · <small style="color:#337ab7">(5054 ventas)</small></h5>

            <!-- Precios -->
            <h6 class="title-price"><small>Price Offer</small></h6>
            <h3 style="margin-top:0px;">{{ $descriptions['price'] }} {{ $descriptions['currency'] }}</h3>

            <!-- Detalles especificos del producto -->
            <div class="section">
                <h6 class="title-attr" style="margin-top:15px;" ><small>COLOUR</small></h6>

                <div>
                    <div class="attr" style="width:25px;background:#5a5a5a;"></div>
                    <div class="attr" style="width:25px;background:white;"></div>
                </div>

            </div>

            <div class="section" style="padding-bottom:5px;">
                <h6 class="title-attr"><small>CAPACIDAD</small></h6>
                <div>
                    <div class="attr2">16 GB</div>
                    <div class="attr2">32 GB</div>
                </div>
            </div>


            <div class="section" style="padding-bottom:20px;">
                <h6 class="title-attr"><small>CANTIDAD</small></h6>

                <div>
                    <div class="btn-minus"><span class="glyphicon glyphicon-minus"></span></div>
                    <input value="1" />
                    <div class="btn-plus"><span class="glyphicon glyphicon-plus"></span></div>
                </div>

            </div>

            <!-- Botones de compra -->
            <div class="section" style="padding-bottom:20px;">
                <button class="btn btn-success"><span style="margin-right:20px" class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Agregar al carro</button>
                <h6><a href="#"><span class="glyphicon glyphicon-heart-empty" style="cursor:pointer;"></span> Agregar a lista de deseos</a></h6>
            </div>
        </div>

        <div class="col-xs-9">
            <ul class="menu-items">
                <li class="active">Product information</li>
                <li></li>
                <li>Vendor</li>
            </ul>

            <div style="width:100%;border-top:1px solid silver">
                <p style="padding:15px;">
                    <small> {!! $descriptions['general_description'] !!} </small>
                </p>
                <small>
                    <ul>
                        @foreach( $descriptions['properties'] as $key => $property)
                            <li>
                            @if ($key % 2 == 0)
                                {{ $property['name'] }} :
                            @else
                                {{ $property['text'] }}
                            @endif
                            </li>
                        @endforeach
                    </ul>
                </small>
            </div>
        </div>


    @include('admin.admin_partials.admin_menu_bottom')
@endsection