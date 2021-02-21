
@if($cart->count()<1)
<br>

<h4 class="mt-4 mb-4">Cart Is Empty<a href="{{route('products')}}" class="text-primary">  Go to shopping</a> </h4>
@endif
@foreach ($cart as $item)
<div class="cart_item">
    <div class="cart_img">
        <a href="#"><img src="{{productImage(!empty($item->product->ProductImages[0]->thumbnail)? $item->product->ProductImages[0]->thumbnail : "")}}"
                alt=""></a>
    </div>
    <div class="cart_info">

        <a  role="button" >{{$item->name}}</a>
        <p>{{$item->qty}} x <span> {{$item->unitPrice}} </span> === <span class="float-right"><b>${{$item->qty*$item->unitPrice}}</b></span></p>
    </div>
    <div class="cart_remove">
        <a role="button" class="removeCart" onclick="removeCart({{$item->id}})"><i class="icon-x"></i></a>
    </div>
</div>
@if($loop->iteration==5)
<a href="{{route('mycart.view')}}"> <span class="mt-2 text-danger" >View more items....</span></a>
@break
@endif
@endforeach
@if(!empty($totalcart))
<input type="hidden" name="totalcart" id="updatecart" value="{{ $totalcart}}">
@else
<input type="hidden" name="totalcart" id="updatecart" value="0">
 @endif
@if($cart->count()>0)
<div class="mini_cart_table">
    <div class="cart_table_border">
        <div class="cart_total">

            <span>Sub total:</span>
            <span class="price">${{$subtotal}}</span>
        </div>
        @if($discountSum>0)
        <div class="cart_total">

            <span>Discount</span>
            <span class="price">${{$discountSum}}</span>
        </div>
        @endif
        <div class="cart_total mt-10">
            <span>total:</span>
            <span class="price">${{$subtotal-$discountSum}}</span>
        </div>
    </div>
</div>
@endif



