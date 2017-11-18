@extends('layouts.app')

@section('content')


    <div class="col-md-2"> @include('partials.v_nav_bar') </div>
    <div class="col-md-9">
        @if(count($products) > 0 )
        <div class="row">

            @foreach($products as $product)
                <?php $descriptions = json_decode($product->description, true); ?>
                    <div class="col-sm-4">
                        <div class="block">
                            <div class="top">
                                <ul>
                                    <li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li>

                                    @foreach($subCategories as $subCategory)
                                        @if($product->sub_category_id == $subCategory->id)
                                            <li><span class="converse">{{ $subCategory->name }} </span></li>
                                        @endif
                                    @endforeach

                                    <li>
                                        <a href="">
                                            <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="middle">
                                @if (isset($descriptions['main_picture_url']))
                                    <img src="{{ $descriptions['main_picture_url'] }}"  />
                                @elseif(isset($descriptions['upload_main_picture']))
                                    <img src="/storage/upload_pictures/{{ $product->id }}/{{ $descriptions['upload_main_picture'] }}" alt="pic" />
                                @else
                                    <img src="/storage/upload_pictures/noimage.jpg" alt="pic" />
                                @endif
                            </div>

                            <div class="bottom">
                                <div class="heading"><a href="/store/{{ $product->id }}">{{ $descriptions['title_product'] }}</a></div>
                                <div class="info"></div>
                                <div class="style">{{ $descriptions['product_status'] }}</div>
                                <div class="price"> {{ $descriptions['price'] }} {{ $descriptions['currency'] }}
                                @if (isset($descriptions['old_price']))
                                    <span class="old-price">{{ $descriptions['old_price'] }} {{ $descriptions['currency'] }}</span>
                                @endif
                                </div>
                            </div>

                        </div>
                    </div>
            @endforeach
                <div style="margin-left: 40%">
                    {{ $products->links() }}
                </div>
            @else
                <div style="text-align: center;">
                    Резултати от търсенето: <p style="color: #ff7a11;font-size: large;">Няма намерени резултати!</p>
                    <div style="margin-top: -30%">
                        @include('partials.flowers_error')
                    </div>
                </div>
            @endif
        </div>

    </div>

@endsection