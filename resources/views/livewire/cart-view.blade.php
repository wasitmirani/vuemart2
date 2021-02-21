<div>

     <!--breadcrumbs area start-->
     <div class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                       <h3>Cart</h3>
                        <ul>
                            <li><a href="{{route('index')}}">home</a></li>
                            <li>Shopping Cart</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs area end-->

     <!--shopping cart area start -->
    <div class="shopping_cart_area mt-70">
        <div class="container">
            <form action="#">
                <div class="row">
                    <div class="col-12">
                        <div class="table_desc">
                            <div class="cart_page">
                                <table>
                            <thead>
                                <tr>
                                    <th class="product_remove">Delete</th>
                                    <th class="product_thumb">Image</th>
                                    <th class="product_name">Product</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-price">Discount</th>
                                    <th class="product_quantity">Quantity</th>
                                    <th class="product_total">Total</th>
                                </tr>
                            </thead>

                                @foreach ($cart as $item)


                                <tr>
                                   <td class="product_remove"><a href="#" wire:click="deleteItem({{ $item->id }})"><i class="fa fa-trash-o text-danger"></i></a></td>
                                    <td class="product_thumb"><a href="#">

                                        <img src="{{productImage(!empty($item->product->ProductImages[0]->thumbnail)? $item->product->ProductImages[0]->thumbnail : "")}}"
                                             alt="">
                                            </a>
                                    </td>
                                    <td class="product_name"><a href="#">{{$item->name}}</a></td>
                                    <td class="product-price">${{$item->unitPrice}}</td>
                                    <td class="product-price">${{$item->discount_price}}</td>
                                    <td class="product_quantity">
                                        {{$item->qty}}
                                        {{-- <input min="1" max="100" value="{{$item->qty}}" type="number"  wire:model="newQty{{$item->id}}" wire:change="updateQty({{$item}})"></td> --}}
                                    <td class="product_total">${{$item->unitPrice-$item->discount_price}}</td>


                                </tr>
                                @endforeach



                            </tbody>
                        </table>
                            </div>

                        </div>
                     </div>
                 </div>
                 <!--coupon code area start-->
                <div class="coupon_area">
                    <div class="row">

                        <div class="col-lg-6 col-md-6">
                            <div class="coupon_code right">
                                <h3>Cart Totals</h3>
                                <div class="coupon_inner">
                                   <div class="cart_subtotal">
                                       <p>Subtotal</p>
                                       <p class="cart_amount">${{$subtotal}}</p>
                                   </div>
                                   <div class="cart_subtotal ">
                                       <p>Discount</p>
                                       <p class="cart_amount"><span></span> ${{$discountSum}}</p>
                                   </div>
                                   <a href="#">Calculate Total</a>

                                   <div class="cart_subtotal">
                                       <p>Total</p>
                                       <p class="cart_amount">${{$subtotal - $discountSum}}</p>
                                   </div>
                                   <div class="checkout_btn">
                                       <a href="{{route('checkout')}}">Proceed to Checkout</a>
                                   </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--coupon code area end-->
            </form>
        </div>
    </div>
     <!--shopping cart area end -->
</div>
