@extends('layouts.app')

@section('content')
    @include('admin.admin_partials.admin_menu')
    <br>
    <br>
    @if(count($orders) > 0)
        @foreach($orders as $order)
            <table class="table table-striped">
                <tr style="color: #ffffff; background-color: #084951">
                    <th >Order id</th>
                    <th>Name Client</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Payment method</th>
                    <th>Delivery method</th>
                    <th>Note</th>
                    <th>Company</th>
                    <th>Bulstat</th>
                </tr>

                @if($order->completed_order == 1)
                    <tr style="background-color:#e3efd2">
                @else
                    <tr>
                @endif
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
                          @if($order->completed_order == 1)
                              <tr style="background-color:#e3efd2">
                          @else
                              <tr>
                          @endif
                              <th>Total Quantity</th>
                              <th>Total Price</th>
                              <th>Products</th>
                              <th>Price</th>
                          </tr>
                          <?php $products = unserialize(base64_decode($order->cart)) ?>
                          @foreach($products->items as $product)
                              <?php $descriptions = json_decode($product['item']['description'], true); ?>
                              @if($order->completed_order == 1)
                                  <tr style="background-color:#e3efd2">
                              @else
                                  <tr>
                              @endif
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
                    Completed Order: <strong class="completed-order">{{ $order->completed_order }} </strong>
                </tr>
                <script>
                   $(document).ready(function(){
                       $('.completed-order').html();

                    });

                </script>

                <div>
                    <a class="btn btn-info" href="/admin/dashboard/{{ $order->id }}">View Offer</a>

                    @if($order->completed_order == 1)
                        <a class="btn btn-warning" href="/admin/completed_order/{{ $order->id }}">Uncompleted Order</a>
                    @else
                        <a class="btn btn-primary" href="/admin/completed_order/{{ $order->id }}">Completed Order</a>
                    @endif

                    <form method="POST" action="/admin/dashboard/{{ $order->id }}" accept-charset="UTF-8" class="pull-right">
                        {{ csrf_field() }}
                        <input name="_method" type="hidden" value="DELETE">
                        <input class="btn btn-danger" type="submit" value="Delete Order">
                    </form>
                </div>
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