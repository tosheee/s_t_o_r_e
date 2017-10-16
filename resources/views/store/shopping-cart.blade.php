@extends('layouts.app')

@section('content')

    <div class="col-md-2"> @include('partials.v_nav_bar') </div>

    <div class="col-md-9">
        <div class="row">

            @if(Session::has('cart'))

                <div class="row">
                    <div class="col-sm-6 col-md-6">
                        <ul style="box-shadow: 5px 5px 5px 5px; padding: 5%; background-color:rgba(226, 250, 255, 0.100) " class="list-group">


                            @foreach($products as $product)
                                <?php $descriptions = json_decode($product['item']->description, true); ?>

                                    <li class="list-group-item">

                                        <span class="badge">{{ $product['qty']}}</span>




                                    <div class="middle">
                                        @if (isset($descriptions['main_picture_url']))
                                            <img  style="margin: 0 auto; width: 250px;height: 200px;" src="{{ $descriptions['main_picture_url'] }}" alt="pic" />
                                        @elseif(isset($descriptions['upload_basic_image']))
                                            <img  style="margin: 0 auto; width: 250px;height: 200px;" src="/storage/upload_pictures/{{ $product->id }}/{{ $descriptions['upload_basic_image'] }}" alt="pic" />
                                        @else
                                            <img style="margin: 0 auto; width: 250px;height: 200px;" src="/storage/upload_basic_image/noimage.jpg" alt="pic" />
                                        @endif
                                    </div>

                                        <div class="bottom">
                                            <div class="heading"><a href="/store/">{{ $descriptions['title_product'] }}</a></div>
                                            <div class="info">Classic red converse edition</div>
                                            <div class="style">{{ $descriptions['product_status'] }}</div>
                                            <div class="price"> {{ $product['price'] }}{{ $descriptions['currency'] }} <span class="old-price">$75.00</span></div>
                                        </div>










                                    <div class="btn-group">
                                        <button class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">
                                            Action <span class="caret"></span>
                                        </button>




                                        <ul class="dropdown-menu">
                                            <li><a href="">Reduce by 1</a></li>
                                            <li><a href="">Reduce All</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <br>
                            @endforeach


                        </ul>
                    </div>



                        <div class="col-sm-3 col-md-3" >
                            <strong>Total: {{ $totalPrice }}</strong>
                            <a href="{{ route('checkout') }}" type="button" class="btn btn-success">Checkout</a>
                        </div>
                </div>




                <hr>


            @else
                <div class="row">
                    <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                        <h2>No items in Cart! </h2>
                    </div>
                </div>
            @endif
        </div>
    </div>


@endsection