<div>

    <!--breadcrumbs area start-->
    <div class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                       <h3>Checkout</h3>
                        <ul>
                            <li><a href="{{route('index')}}">home</a></li>
                            <li>Checkout</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs area end-->

    <!--Checkout page section-->
    <div class="Checkout_section mt-70">
       <div class="container">
            <div class="row">
               <div class="col-12">
                    <div class="user-actions">
                        @if(!Auth::check())
                        <h3>
                            <i class="fa fa-file-o" aria-hidden="true"></i>
                            Returning customer?
                            <a class="Returning" href="#checkout_login" data-bs-toggle="collapse" aria-expanded="true">Click here to login</a>

                        </h3>
                        @endif
                         <div id="checkout_login" class="collapse" data-parent="#accordion">
                            <div class="checkout_info">
                                <p>If you have shopped with us before, please enter your details in the boxes below. If you are a new customer please proceed to the Billing & Shipping section.</p>

                                @component('site.components.loginForm')

                                @endcomponent
                            </div>
                        </div>
                    </div>
                    {{-- <div class="user-actions">
                        <h3>
                            <i class="fa fa-file-o" aria-hidden="true"></i>
                            Returning customer?
                            <a class="Returning" href="#checkout_coupon" data-bs-toggle="collapse" aria-expanded="true">Click here to enter your code</a>

                        </h3>
                         <div id="checkout_coupon" class="collapse" data-parent="#accordion">
                            <div class="checkout_info coupon_info">
                                <form action="#">
                                    <input placeholder="Coupon code" type="text">
                                    <button type="submit">Apply coupon</button>
                                </form>
                            </div>
                        </div>
                    </div> --}}
               </div>
            </div>
            <div class="checkout_form">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <form wire:submit.prevent="proceedOrder" id="billingform">
                            <h3>Billing Details</h3>
                            <div class="row">

                                <div class="col-lg-6 mb-20">
                                    <label>Full Name <span>*</span></label>
                                    <input type="text" class="form-control   @error('name') border border-danger @enderror" wire:model="name">
                                    @error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-lg-6 mb-20">
                                    <label>Phone<span>*</span></label>
                                    <input type="text" class="@error('phone') border border-danger @enderror" wire:model="phone">
                                    @error('phone') <span class="error text-danger">{{ $message }}</span> @enderror

                                </div>
                                 <div class="col-lg-12">
                                    <label> Email Address   <span>*</span></label>
                                      <input type="text"  class="@error('email') border border-danger @enderror" wire:model="email">
                                      @error('email') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>



                                <div class="col-12 mb-20">
                                    <label>Street address  <span>*</span></label>
                                    <input placeholder="House number and street name" class="@error('address') border border-danger @enderror" type="text" wire:model="address" >
                                    @error('address') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-12 mb-20">
                                    <input placeholder="Apartment, suite, unit etc. (optional)" type="text" wire:model="houseaddress">
                                </div>
                                <div class="col-12 mb-20">
                                    <label>Town <span>*</span></label>
                                    <input type="text"  class="@error('town') border border-danger @enderror"  wire:model="town">
                                    @error('town') <span class="error">{{ $message }}</span> @enderror
                                </div>
                                 <div class="col-12 mb-20">
                                    <label>City / State / County <span>*</span></label>
                                    <input type="text"  value="Sukkur,Sindh,Pakistan" placeholder="Sukkur,Sindh,Pakistan"  wire:model="state" readonly>
                                </div>


                                <div class="col-12">
                                    <div class="order-notes">
                                         <label for="order_note">Order Notes</label>
                                        <textarea id="order_note" placeholder="Notes about your order, e.g. special notes for delivery."  wire:model="ordernotes"></textarea>
                                    </div>
                                </div>
                            </div>

                    </div>
                    <div class="col-lg-6 col-md-6">

                            <h3>Your order </h3>
                            <div class="order_table table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($mycart as $item)
                                        <tr>
                                            <td> {{$item->name}} <strong> | ${{$item->unitPrice}} x {{$item->qty }} </strong></td>
                                            <td> ${{$item->qty*$item->unitPrice }}</td>
                                        </tr>
                                        @endforeach


                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th><strong>Sub total</strong> (items {{$mycart->count()}})</th>
                                            <td>${{$subtotal}}</td>
                                        </tr>
                                        @if($discountSum>0)
                                        <tr class="text-success">
                                            <th>Discount</th>
                                            <td><strong>${{$discountSum}}</strong></td>
                                        </tr>
                                        @endif
                                        <tr class="order_total">
                                            <th><strong> Order Total</strong></th>
                                            <td><strong class="text-danger">${{$subtotal-$discountSum}}</strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="payment_method">

                                <button class="btn btn-primary cart-button" type="submit">Proceed to Order</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Checkout page section end-->
</div>
@push('scripts')
{{-- <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>

<script>
  // when life is settled, load up the fun stuff

  document.addEventListener('DOMContentLoaded', function () {
    // const el=billingform
    // el.scrollIntoView({
    //   behavior: 'smooth',
    // });

    new Vue({
      el: '#app',
      // define data - initial display text
      data: {
        m1: "You got to let me know"
      }
    })
  })
</script> --}}
@endpush
