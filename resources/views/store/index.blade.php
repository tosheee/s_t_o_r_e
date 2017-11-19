@extends('layouts.app')

@section('content')


    <div class="col-md-2"> @include('partials.v_nav_bar') </div>
    <div class="col-md-10">
        @if(count($products) > 0 )
        <div class="row">


            <div class="product_grid">
                <ul class="product_list">
                    @foreach($products as $product)
                        <?php $descriptions = json_decode($product->description, true); ?>
                        <li class="product_item">
                            @if ($product->sale == 1)
                                <div class="product_sale">
                                    <p>Разпродажба</p>
                                </div>
                            @elseif($product->recommended == 1)
                                <div class="product_recommended">
                                    <p>Препоръчан</p>
                                </div>
                            @elseif($product->best_sellers == 1)
                                <div class="product_best_sale">
                                    <p>Най-продаван</p>
                                </div>
                            @endif
                            <div class="product_image">

                                @if (isset($descriptions['main_picture_url']))
                                    <img src="{{ $descriptions['main_picture_url'] }}"  />
                                @elseif(isset($descriptions['upload_main_picture']))
                                    <img src="/storage/upload_pictures/{{ $product->id }}/{{ $descriptions['upload_main_picture'] }}" alt="pic" />
                                @else
                                    <img src="/storage/upload_pictures/noimage.jpg" alt="pic" />
                                @endif

                                <div class="product_buttons">
                                    <button class="product_heart"><i class="fa fa-heart"></i></button>
                                    <button class="product_compare"><i class="fa fa-random"></i></button>
                                    <button class="add-product-button add_to_cart" alt="Добави в количката" >
                                        <i class="fa fa-shopping-cart" ></i>
                                        <input id="quantity-product" type="hidden" value="1"  >
                                        <input id="id-product" type="hidden" value="{{ $product->id }}"/>
                                    </button>

                                    <div class="quick_view">
                                        <a href="/store/{{ $product->id }}"><h6>Виж подробности</h6></a>
                                    </div>
                                </div>

                            </div>
                            <div class="product_values">
                                <div class="product_title">
                                    <h5>{{ $descriptions['title_product'] }}</h5>
                                </div>
                                <br/><br/>
                                <div class="product_price">
                                    <a href="#">
                                        <span class="price_new">{{ $descriptions['price'] }} {{ $descriptions['currency'] }}</span></a>
                                        <span class="price_old">{{ isset($descriptions['old_price']) ? $descriptions['old_price'].' '.$descriptions['currency']  : '' }}</span>
                                        <br>
                                </div>

                                <div class="product_desc">
                                    @foreach($subCategories as $subCategory)
                                        @if($product->sub_category_id == $subCategory->id)
                                        <p class="truncate" style="text-align:center ">{{ $subCategory->name }} </p>
                                        @endif
                                    @endforeach
                                </div>

                                <div class="product_buttons">
                                    <button class="product_heart"><i class="fa fa-heart"></i></button>
                                    <button class="product_compare"><i class="fa fa-random"></i></button>
                                    <button class="add_to_cart"><i class="fa fa-shopping-cart"></i></button>
                                </div>
                            </div>
                        </li>


                    @endforeach
                </ul>
            </div>

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