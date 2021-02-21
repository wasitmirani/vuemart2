<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="style.css">
        <title>Receipt</title><link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<style>
* {
    font-size: 13px;

    font-weight: 100
}


td,
th,
tr,
table {
    border-top: 1px solid black;
    border-collapse: collapse;

}

td.item,
th.item {
    width:90px;
    max-width: 100px;
}

td.qty,
th.qty {
    width: 10px;
    max-width: 20px;
    word-break: break-all;
}

td.price,
th.price {
    width: 10px;
    max-width: 10px;
    word-break: break-all;
}

.centered {
    text-align: center;
    align-content: center;
}

.ticket {
    width: 302px;
    max-width: 302px;
}

img {
    max-width: inherit;
    width: inherit;
}

@media print {
    .hidden-print,
    .hidden-print * {
        display: none !important;
    }
}
</style>
    </head>
    <body>


<!------ Include the above in your HEAD tag ---------->

<div class="container" style="width:320.88px;">
    <div class="row">
        <div class="col-xs-12">
    		<div class="invoice-title">
    			<h2 style="marign-left:50px;">Vuemart.pk</h2>
    		<div>
    		    <strong> <h3 class="pull-right">Invoice {{ $order->id }}</h3></strong>

    					<strong>Order Date:</strong><br>
    				{{ $order->created_at->format('M-d-Y') }}<br><br>

    		</div>

    		</div>

    		<div class="row">
    			<div class="col-xs-12">
    				<address>
    				<strong><h4>Customer</h4> </strong>
    					<strong>Name:</strong> <span>{{ $order->name }}</span><br>
    					<strong>Phone:</strong> <span>{{ $order->user_phone }}</span><br>
    					<strong>Billing Address:</strong> <span>{{ $order->address }}</span>
    				</address>
    			</div>
    		</div>

    	</div>
    </div>

    <div class="row">
    	<div class="col-md-12">
    		<div class="">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>Order summary</strong></h3>
    			</div>
    			<div class="">

    					<table class="table table-condensed">
    						<thead>
                                <tr>
        				<td class="text-left"><strong>Product Name</strong></td>
        								<td class="text-right"><strong>Units</strong></td>
        							<td class="text-right"><strong>Price</strong></td>

        							<td class="text-right"><strong>Qty</strong></td>

        					<td class="text-center"><strong>Total</strong></td>
                                </tr>
    						</thead>
    						<tbody >

    							   @foreach ($order->orderIteams as $item)
    							<tr>
    								<td  class="text-left">{{$item->name}}</td>
    								<td class="text-right">{{$item->units}}</td>
    								<td class="text-right">{{$item->unitPrice}}</td>

    								<td class="text-right">{{$item->qty}}</td>
    						<td class="text-right" style="">{{$item->qty * $item->unitPrice }}</td>
    							</tr>
                                     @endforeach

    							<tr>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line text-center"><strong>Subtotal</strong></td>
    						<td class="thick-line text-right">${{$order->total_unitprice}}</td>
    							</tr>
                                @if($order->total_discount>0)
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Disount</strong></td>
    								<td class="no-line text-right">${{$order->total_discount}}</td>
    							</tr>
                                @endif
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Total</strong></td>
    								<td class="no-line text-right">${{$order->total_unitprice-$order->total_discount}}</td>




    							</tr>

    						</tbody>
    					</table>

    						<address>
                                Thank for shopping from {{config('app.name')}}. We look forward to seeing you again. Have a great day!
    						</address>

    			</div>
    		</div>
    	</div>
    </div>
</div>

        <!--<div class="ticket">-->
        <!--    <img src="./logo.png" alt="Logo">-->
        <!--    <p class="centered">RECEIPT EXAMPLE-->
        <!--        <br>Address line 1-->
        <!--        <br>Address line 2</p>-->
        <!--    <table>-->
        <!--        <thead>-->
        <!--            <tr>-->
        <!--                <th class="quantity">Q.</th>-->
        <!--                <th class="description">Description</th>-->
        <!--                <th class="price">$$</th>-->
        <!--            </tr>-->
        <!--        </thead>-->
        <!--        <tbody>-->
        <!--            <tr>-->
        <!--                <td class="quantity">1.00</td>-->
        <!--                <td class="description">ARDUINO UNO R3</td>-->
        <!--                <td class="price">$25.00</td>-->
        <!--            </tr>-->
        <!--            <tr>-->
        <!--                <td class="quantity">2.00</td>-->
        <!--                <td class="description">JAVASCRIPT BOOK</td>-->
        <!--                <td class="price">$10.00</td>-->
        <!--            </tr>-->
        <!--            <tr>-->
        <!--                <td class="quantity">1.00</td>-->
        <!--                <td class="description">STICKER PACK</td>-->
        <!--                <td class="price">$10.00</td>-->
        <!--            </tr>-->
        <!--            <tr>-->
        <!--                <td class="quantity"></td>-->
        <!--                <td class="description">TOTAL</td>-->
        <!--                <td class="price">$55.00</td>-->
        <!--            </tr>-->
        <!--        </tbody>-->
        <!--    </table>-->
        <!--    <p class="centered">Thanks for your purchase!-->
        <!--        <br>parzibyte.me/blog</p>-->
        <!--</div>-->
<!--        <button id="btnPrint" class="hidden-print">Print</button>-->
<!--        <script>-->
<!--const $btnPrint = document.querySelector("#btnPrint");-->
<!--$btnPrint.addEventListener("click", () => {-->
<!--    window.print();-->
<!--});</script>-->
    </body>
</html>
