<div>
   <!--breadcrumbs area start-->
   <div class="breadcrumbs_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <ul>
                        <li><a href="{{route('index')}}">home</a></li>
                        <li>{{$this->product->name}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->

<!--product details start-->
<div class="product_details mt-70 mb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product-details-tab">
                    <div id="img-1" class="zoomWrapper single-zoom">
                        <a href="#">
                            <img id="zoom1" src="{{productImage(!empty($product->ProductImages[0]->thumbnail)? $product->ProductImages[0]->thumbnail : "")}}"
                            alt="">

                        </a>
                    </div>
                    <div class="single-zoom-thumb">
                        <ul class="s-tab-zoom owl-carousel single-product-active" id="gallery_01">
                            @foreach ($product->ProductImages as $item)

                            <li>
                                <a href="#" class="elevatezoom-gallery active" data-update="" data-image="{{productImage(!empty($item->thumbnail)? $item->thumbnail : "")}}" data-zoom-image="{{productImage(!empty($item->thumbnail)? $item->thumbnail : "")}}">
                                    <img src="{{productImage(!empty($item->thumbnail)? $item->thumbnail : "")}}" alt="zo-th-1">
                                </a>

                            </li>
                            @endforeach




                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="product_d_right">
                   <form>

                        <h1><a href="#">{{$this->product->name}}</a></h1>
                        {{-- <div class="product_nav">
                            <ul>
                                <li class="prev"><a href="product-details.html"><i class="fa fa-angle-left"></i></a></li>
                                <li class="next"><a href="variable-product.html"><i class="fa fa-angle-right"></i></a></li>
                            </ul>
                        </div> --}}

                        <div class="price_box">
                            <span class="current_price">${{$this->product->unitPrice-$this->product->discount_price}}</span>

                            @if($this->product->discount_price > 0)
                            <span class="old_price">{{$this->product->unitPrice}}</span>
                            @endif

                        </div>
                        <div class="product_desc">
                            <p>{{$this->product->description}}</p>
                        </div>

                        <div class="product_variant quantity">
                            <label>quantity</label>
                            <input min="1" max="100" value="1" wire:model="qty" type="number">
                            <button class="button" type="button" wire:click="addCart({{$product}})">add to cart</button>

                        </div>

                        <div class="product_meta">
                            <span>Category: <a href="#">{{$this->product->category->name}}</a></span>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<!--product details end-->



<!--product area start-->
<section class="product_area related_products">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section_title">
                    <h2>Related Products	</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="product_carousel product_column5 owl-carousel">
                    @foreach ($relatedProducts as $product)
                    <article class="single_product">
                        <figure>

                            @component('site.components.productthumbnail',['product'=>$product,'widget'=>'bestproduct'])
                            @endcomponent
                            @component('site.components.bestselleerProducts',['product'=>$product])

                            @endcomponent


                        </figure>
                    </article>
                    @endforeach


                </div>
            </div>
        </div>
    </div>
</section>
<!--product area end-->

 <!--product area start-->
<section class="product_area upsell_products">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section_title">
                    <h2>Upsell Products	</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="product_carousel product_column5 owl-carousel">
                    @foreach ($upsellProducts as $product)
                    <article class="single_product">
                        <figure>

                            @component('site.components.productthumbnail',['product'=>$product,'widget'=>'bestproduct'])
                            @endcomponent
                            @component('site.components.bestselleerProducts',['product'=>$product])

                            @endcomponent


                        </figure>
                    </article>
                    @endforeach


                </div>
            </div>
        </div>
    </div>
</section>
<!--product area end-->
</div>
@push('scripts')
<script>
    // Your JS here.

        window.livewire.on('cartupdate', () => {
            const Toast = Swal.mixin({
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 1200,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
                })

                Toast.fire({
                icon: 'success',
                title: 'Add to cart {!! $product->name !!} successfuly'
                })
            });

</script>
@endpush

