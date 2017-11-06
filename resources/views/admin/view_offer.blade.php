@extends('layouts.app')

@section('content')
    @include('admin.admin_partials.admin_menu')
    <br>
    <br>

    <input type="button" class="btn btn-info" onclick="printDiv('printableArea')" value="Принтирай офертата" />
    <br/><br/>

    <div id="printableArea" style="font-size: 16px;">
 <div style="margin-left: 40%;">
     <table>
        <tr><td>ОНЛАЙН МАГАЗИН ЗА ЦВЕТЯ И РАСТЕНИЯ</td></tr>
     <tr><td><h2>Флоро Мания</h2></td></tr>

     <tr><td><i class="fa fa-phone" aria-hidden="true"></i> 0988 883 562</td></tr>
     <tr><td><i class="fa fa-globe" aria-hidden="true"></i> www.floromaniq.com</td></tr>
     <tr><td><i class="fa fa-envelope-open" aria-hidden="true"></i> floromaniq@abv.bg</td></tr>
     </table>
 </div>



        <table class="table table-striped">
            <tr>

                <th style="color: #ffffff; background-color: #084951">Име на клиент</th>
                <th style="color: #ffffff; background-color: #084951">Телефонен номер</th>
                <th style="color: #ffffff; background-color: #084951">Имейл</th>
                <th style="color: #ffffff; background-color: #084951">Адрес</th>
                <th style="color: #ffffff; background-color: #084951">Начин на плащане</th>
                <th style="color: #ffffff; background-color: #084951">Начин за доставка</th>
                @if(!empty($order->note))
                    <th style="color: #ffffff; background-color: #084951">Бележка от клиента</th>
                @endif

                @if(!empty($order->company))
                    <th style="color: #ffffff; background-color: #084951">Фирма</th>
                @endif
                @if(!empty($order->bulstat))
                    <th style="color: #ffffff; background-color: #084951">Булстат</th>
                @endif
            </tr>

            <tr>

                <td>{{ $order->name}} {{ $order->last_name}}</td>
                <td>{{ $order->phone }}</td>
                <td>{{ $order->email }}</td>
                <td>{{ $order->address }}</td>
                <td>{{ $order->payment_method }}</td>
                <td>{{ $order->delivery_method }}</td>

                @if(!empty($order->note))
                    <td>{{ $order->note }}</td>
                @endif

                @if(!empty($order->company))
                    <td>{{ $order->company }}</td>
                @endif

                @if(!empty($order->company))
                    <td>{{ $order->bulstat }}</td>
                @endif
            </tr>
        </table>

        <table class="table table-striped">
            <tr>
                <th>Количество</th>
                <th>Общо</th>
                <th>Продукт</th>
                <th>Единична цена</th>
            </tr>

            <?php $products = unserialize(base64_decode($order->cart)) ?>

            @foreach($products->items as $product)

                <?php $descriptions = json_decode($product['item']['description'], true); ?>
                <tr>
                    <td>{{ $product['qty'] }} бр.</td>
                    <td>{{ $product['total_item_price'] }} лв.</td>
                    <td>{{ $descriptions['title_product'] }}</td>
                    <td>{{ $descriptions['price']}} лв.</td>
                </tr>
            @endforeach
        </table>

        <p>
            <p style="font-size: 16px;"> Общо количество: <strong>{{ $products->totalQty}} бр.</strong></p>
            <p style="font-size: 16px;">Обща сума: <strong>{{ $products->totalPrice }} лв.</strong></p>
        </p>

</div>

    <script type="text/javascript" charset="utf-8">

            function printDiv(divName) {
                var printContents = document.getElementById(divName).innerHTML;
                var originalContents = document.body.innerHTML;
                document.body.innerHTML = printContents;
                window.print();
                document.body.innerHTML = originalContents;
            }

    </script>


    @include('admin.admin_partials.admin_menu_bottom')
@endsection