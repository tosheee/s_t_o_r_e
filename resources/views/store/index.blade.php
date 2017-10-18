@extends('layouts.app')

@section('content')

    <div class="col-md-2"> @include('partials.v_nav_bar') </div>

    <div class="col-md-9">
        <div class="row">
            @foreach($products as $product)
                <?php $descriptions = json_decode($product->description, true); ?>
                    <div class="col-sm-4">
                        <div class="block">
                            <div class="top">
                                <ul>
                                    <li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li>
                                    <li><span class="converse">Converse</span></li>
                                    <li><a href="{{ route('store.addToCart', ['id' => $product->id]) }}"><i class="fa fa-shopping-basket" aria-hidden="true"></i>
                                        </a></li>
                                </ul>
                            </div>

                            <div class="middle">
                                @if (isset($descriptions['main_picture_url']))
                                    <img src="{{ $descriptions['main_picture_url'] }}" alt="pic" />
                                @elseif(isset($descriptions['upload_basic_image']))
                                    <img src="/storage/upload_pictures/{{ $product->id }}/{{ $descriptions['upload_basic_image'] }}" alt="pic" />
                                @else
                                    <img src="/storage/upload_basic_image/noimage.jpg" alt="pic" />
                                @endif
                            </div>

                            <div class="bottom">
                                <div class="heading"><a href="/store/{{ $product->id }}">{{ $descriptions['title_product'] }}</a></div>
                                <div class="info">Classic red converse edition</div>
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
        </div>
    </div>

@endsection