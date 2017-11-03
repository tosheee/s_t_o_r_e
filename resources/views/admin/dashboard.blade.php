@extends('layouts.app')

@section('content')
    @include('admin.admin_partials.admin_menu')
    <br>
    <br>
    @if(count($orders) > 0)
        @foreach($orders as $order)
            <table class="table table-striped">
                <tr>
                    <th style="color: #ffffff; background-color: #084951">Order id</th>
                    <th style="color: #ffffff; background-color: #084951">Name Client</th>
                    <th style="color: #ffffff; background-color: #084951">Phone</th>
                    <th style="color: #ffffff; background-color: #084951">Email</th>
                    <th style="color: #ffffff; background-color: #084951">Address</th>
                    <th style="color: #ffffff; background-color: #084951">Payment method</th>
                    <th style="color: #ffffff; background-color: #084951">Delivery method</th>
                    <th style="color: #ffffff; background-color: #084951">Note</th>
                    <th style="color: #ffffff; background-color: #084951">Company</th>
                    <th style="color: #ffffff; background-color: #084951">Bulstat</th>
                </tr>

                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->name}} {{ $order->last_name}}</td>
                    <td>{{ $order->phone }}</td>
                    <td>{{ $order->email }}</td>
                    <td>{{ $order->address }}</td>
                    <td>{{ $order->payment_method }}</td>
                    <td>{{ $order->delivery_method }}</td>
                    <td>{{ $order->note }}</td>
                    <td>{{ $order->company }}</td>
                    <td>{{ $order->bulstat }}</td>
                </tr>

                <tr>
                      <table class="table table-striped">
                          <tr>
                              <th>Total Quantity</th>
                              <th>Total Price</th>
                              <th>Products</th>
                              <th>Price</th>
                          </tr>

                          <?php $products = unserialize(base64_decode($order->cart)) ?>

                          @foreach($products->items as $product)

                              <?php $descriptions = json_decode($product['item']['description'], true); ?>
                              <tr>
                                  <td>{{ $product['qty'] }} units</td>
                                  <td>{{ $product['total_item_price'] }} лв.</td>
                                  <td><a href="/admin/products/{{ $product['item']['id'] }}">{{ $descriptions['title_product'] }}</a></td>
                                  <td>{{ $descriptions['price']}} лв.</td>
                              </tr>
                          @endforeach
                      </table>
                </tr>

                <tr>
                    Total Quantity: <strong>{{ $products->totalQty}} units</strong>
                    Total Price: <strong>{{ $products->totalPrice }} лв.</strong>
                </tr>

                <form method="POST" action="/admin/dashboard/{{ $order->id }}" accept-charset="UTF-8" class="pull-right">
                    {{ csrf_field() }}
                    <input name="_method" type="hidden" value="DELETE">
                    <input class="btn btn-danger" type="submit" value="Delete Order">
                </form>
            </table>
            <br/>
            <br/>
            <br/>
            <br/>
            @endforeach

        {{ $orders->links() }}

    @else
        <p>No Orders</p>
    @endif









    @include('admin.admin_partials.admin_menu_bottom')
@endsection