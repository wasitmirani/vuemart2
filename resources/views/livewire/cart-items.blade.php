
<div>



<div class="header_account_list  mini_cart_wrapper" >
    <a role="button" id="loadcart"><span class="lnr lnr-cart" ></span><span class="item_count totalitem" >{{$this->cart->count()}}</span></a>
    {{-- <input type="button" value="view Cart" wire:click="updateCart"> --}}
     <!--mini cart-->
     <div class="mini_cart">
         <div class="cart_gallery">
             <div class="cart_close">
                 <div class="cart_text">
                     <h3>My cart <span class="item_count totalitem" >{{$this->cart->count()}}</span></h3>

                 </div>
                 <div class="mini_cart_close">
                     <a href="javascript:void(0)"><i class="icon-x"></i></a>
                 </div>

             </div>
             <div id="updateCart">





              </div>
         </div>

         <div class="mini_cart_footer">

                 <a href="{{route('mycart.view')}}">
                    <div class="cart-button btn btn-primary">
                    <i class="fa fa-shopping-cart"></i> View cart
                    </div>
                </a>


                 <a href="{{route('checkout')}}">


                    <div class="cart-button btn btn-primary">
                        <i class="fa fa-sign-in"></i>
                        Checkout
                    </div>
                      </a>


         </div>

     </div>
     <!--mini cart end-->
</div>



</div>
@push('scripts')
<script src="{{asset('js/axios.js')}}"></script>
<script>
    document.addEventListener('livewire:load', function () {


    $("#loadcart").click(function(){



        axios.get('{{route("my-cart")}}').then((res)=>{
            $("#updateCart").empty();
            $("#updateCart").html(res.data);
            $(".totalitem").text(res.data.totalcart);
        });
  })

})

function removeCart(id)
  {

        axios.get("{{url('remove/cart/')}}/"+id).then((res)=>{
            $("#updateCart").empty();
            $("#updateCart").html(res.data);

           let totalcart=document.getElementById('updatecart').value;

           console.log(totalcart);
            $(".totalitem").text(totalcart);

        });
 }
</script>
@endpush

