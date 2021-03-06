@extends('layouts.app')

@section('content')
    <div class="col-md-2"> @include('partials.v_nav_bar') </div>

    <div class="container">
        <div class="row" >
            @if(Session::has('cart'))
                <div class="col-sm-10">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Продукт</th>
                                <th></th>
                                <th class="text-center">Цена</th>
                                <th class="text-center">Обща цена</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <?php $descriptions = json_decode($product['item']->description, true); ?>
                                <tr>
                                    <td class="col-sm-8 col-md-6">
                                        <div class="media">

                                            @if (isset($descriptions['main_picture_url']))
                                                <a class="thumbnail pull-left" href="/store/{{ $product['item']->id}}"> <img  style="margin: 0 auto; width: 150px;height: 150px;" src="{{ $descriptions['main_picture_url'] }}" alt="pic" /></a>
                                            @elseif(isset($descriptions['upload_main_picture']))
                                                <a class="thumbnail pull-left" href="/store/{{ $product['item']->id }}">  <img  style="margin: 0 auto; width: 150px;height: 100px;" src="/storage/upload_pictures/{{ $product['item']->id }}/{{ $descriptions['upload_main_picture'] }}" alt="pic" /></a>
                                            @else
                                                <a class="thumbnail pull-left" href="/store/{{ $product['item']->id }}">  <img style="margin: 0 auto; width: 150px;height: 100px;" src="/storage/common_pictures/noimage.jpg" alt="pic" /></a>
                                            @endif

                                            @if(isset($descriptions['price']))
                                                <div class="media-body" >
                                                    <h4 class="media-heading" style="padding-left: 10px;"><a href="/store/{{ $product['item']->id }}">{{ $descriptions['title_product'] }}</a></h4>
                                                    <h5 class="media-heading"><a href="#"></a></h5>
                                                    <span  style="padding-left: 10px;">Статус: </span><span class="text-success"><strong>{{ $descriptions['product_status'] }}</strong></span>
                                                </div>
                                            @endif
                                        </div>
                                    </td>

                                    <td align="center">
                                        <div>
                                            <div class="price clearfix">

                                                <div class="product-count">
                                                    <input type="text" class="count-textbox" value="1" id="quantity-product" readonly>
                                                    <button class="minus-button"><i class="fa fa-chevron-down" aria-hidden="true"></i></button>
                                                    <button class="plus-button"><i class="fa fa-chevron-up" aria-hidden="true"></i></button>
                                                    <input id="id-product" type="hidden" name="q" value=""/>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    @if(isset($descriptions['price']))
                                        <td class="col-sm-1 col-md-1 text-center">
                                            <strong>{{ $descriptions['price'] }} {{ $descriptions['currency'] }}</strong></td>
                                        <td class="col-sm-1 col-md-1 text-center"><strong>{{ $product['qty'] * $descriptions['price'] }} {{ $descriptions['currency'] }} </strong></td>
                                    @endif

                                    <td class="col-sm-1 col-md-1">
                                        <a  class="btn btn-danger" href="{{ route('store.remove', [ 'id' => $product['item']['id']]) }}">Изтрий</a>
                                    </td>
                                </tr>
                            @endforeach

                        <tr style="border: 0;">
                            <td>   </td>
                            <td>   </td>
                            <td>   </td>
                            <td><h5>Цена без доставка:</h5></td>
                            @if(isset($descriptions['currency']))
                                <td class="text-right"><h5><strong>{{ $totalPrice }} {{ $descriptions['currency'] }}</strong></h5></td>
                            @endif
                        </tr>
                        <tr style="border: 0;">
                            <td>   </td>
                            <td>   </td>
                            <td>   </td>
                            <td><h5>Доставка:</h5></td>
                            @if(isset($descriptions['currency']))
                                <td class="text-right"><h5><strong>0.00 {{ $descriptions['currency'] }}</strong></h5></td>
                            @endif
                        </tr>
                        <tr>
                            <td>   </td>
                            <td>   </td>
                            <td>   </td>
                            <td><h3>Общо:</h3></td>
                            @if(isset($descriptions['currency']))
                                <td class="text-center"><h3><strong>{{ $totalPrice }} {{ $descriptions['currency'] }}</strong></h3></td>
                            @endif
                        </tr>
                        <tr>
                            <td>   </td>
                            <td>   </td>
                            <td>   </td>
                            <td>
                                <a href="/store" class="btn btn-default">Продължи с пазаруването</a>
                            </td>
                            <td>
                                <a href="/checkout" class="btn btn-success">Продължи поръчката</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
            </div>
        </div>
    </div>

    @else
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <h2>No items in Cart! </h2>
            </div>
        </div>
    @endif

@endsection