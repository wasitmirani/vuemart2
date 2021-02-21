<div>
   <!--breadcrumbs area start-->
    <div class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <h3>Products</h3>
                        <ul>
                            <li><a href="{{route('index')}}">home</a></li>
                            <li>Products</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs area end-->

    <!--shop  area start-->
    <div class="shop_area shop_reverse mt-70 mb-70">
        <div class="container">

            <div class="row">
                <div class="col-lg-3 col-md-12">
                   <!--sidebar widget start-->
                    <aside class="sidebar_widget">
                        <div class="widget_inner">

                            <div class="widget_list widget_color">
                                <h3>Select By Categories</h3>
                                <ul>
                                    <li>
                                        <a  role="button" wire:click="allProducts()">All Categories </a>
                                    </li>
                                    @foreach ($this->categories as $category)
                                    <li>
                                        <a  role="button" wire:click="productsByCategory({{$category->id}})">{{$category->name}}  <span class="badge bg-danger">{{$category->total}}</span></a>
                                    </li>
                                    @endforeach


                                </ul>
                            </div>

                            {{-- <div class="widget_list widget_manu">
                                <h3>Manufacturer</h3>
                                <ul>
                                    <li>
                                        <a href="#">Brake Parts <span>(6)</span></a>
                                    </li>
                                    <li>
                                        <a href="#">Accessories <span>(10)</span></a>
                                    </li>
                                    <li>
                                        <a href="#">Engine Parts <span>(4)</span></a>
                                    </li>
                                    <li>
                                        <a href="#">hermes <span>(10)</span></a>
                                    </li>
                                    <li>
                                        <a href="#">louis vuitton <span>(8)</span></a>
                                    </li>

                                </ul>
                            </div> --}}
                            @if(!empty($this->selectedCategory))
                            <div class="widget_list tags_widget">
                                <h3>Selected Category</h3>
                                <div class="row">
                                    <div class="tag_cloud">
                                        <a href="#">{{$this->selectedCategory->name}}</a>
                                    </div>
                                    <div class="mini_cart_close">
                                        <a href="javascript:void(0)" wire:click="clearCategory"><i class="icon-x"></i></a>
                                    </div>
                                </div>

                            </div>
                            @endif


                            <div class="widget_list banner_widget">
                                <div class="banner_thumb">
                                    <a href="#"><img src="frontend\assets/img/bg/banner17.jpg" alt=""></a>
                                </div>
                            </div>
                        </div>
                    </aside>
                    <!--sidebar widget end-->
                </div>

                <div class="col-lg-9 col-md-12">
                    <p>Products of {{$products->count()}} results</p>
                    <!--shop wrapper start-->
                    <!--shop toolbar start-->
                    <div class="shop_toolbar_wrapper">
                        <div class="shop_toolbar_btn">

                            <button data-role="grid_3" type="button" class="active btn-grid-3" data-toggle="tooltip" title="3"></button>

                            <button data-role="grid_4" type="button"  class=" btn-grid-4" data-toggle="tooltip" title="4"></button>

                            <button data-role="grid_list" type="button"  class="btn-list" data-toggle="tooltip" title="List"></button>
                        </div>
                        {{-- <div class="niceselect_option" class="float-right">

                        </div> --}}
                        <div class="page_amount col-xs-12 ">
                            <input type="search"  class="form-control" placeholder="Search Products" wire:model="query" />

                        </div>
                    </div>
                     <!--shop toolbar end-->
                     <div class="row shop_wrapper">
                        <div wire:loading>
                           <img src="{{url('/frontend/icons/loading.gif')}}" alt="" srcset="">
                        </div>

                        @forelse ($products as $product)


                        <div class="col-lg-4 col-md-4 col-sm-6 col-12 ">
                            <div class="single_product">

                                    <div class="product_thumb">


                                        @if(!empty($product->productImages) && $product->productImages->count()>0)

                                        <a class="primary_img" href="{{route('product.view',['slug'=>$product->slug,'id'=>$product->id])}}" >
                                            <img  style="height: 200px;width: 100%;"
                                                src="{{ productImage(!empty($product->productImages[0]->thumbnail) ?  $product->productImages[0]->thumbnail : "")}}" alt=""></a>

                                        @else
                                        <a class="primary_img" href="{{route('product.view',['slug'=>$product->slug,'id'=>$product->id])}}">
                                            <img style="height: 200px;width: 100%;"
                                                src="{{ productImage("")}}" alt=""></a>
 \
                                        @endif


                                    </div>

                                <div class="product_content grid_content">

                                        <h4 class="product_name"><a href="{{route('product.view',['slug'=>$product->slug,'id'=>$product->id])}}">
                                            {{Str::limit($product->name,20,'...')}}</a></h4>
                                        @if(!empty($product->category))
                                        <p><b><a role="button"  wire:click="productsByCategory({{$product->category->id}})">{{$product->category->name}}</a></b></p>
                                        @endif
                                        <div class="price_box">
                                            <span class="current_price">${{($product->unitPrice-$product->discount_price )}}</span>
                                                        @if($product->discount_price > 0)
                                                        <span class="old_price">${{$product->unitPrice}}</span>
                                                        @endif

                                        </div>
                                        <button class="cart-button btn-sm btn-primary" type="button" data-tippy="Add to cart"
                                        data-tippy-placement="top"
                                        data-tippy-arrow="true"
                                        onclick="addtocart({{$product->id}})">Add to cart
                      </button>
                                    </div>
                                <div class="product_content list_content">
                                    <h4 class="product_name"><a href="{{route('product.view',['slug'=>$product->slug,'id'=>$product->id])}}">{{$product->name}}</a></h4>
                                    @if(!empty($product->category))
                                    <p><b><a role="button"  wire:click="productsByCategory({{$product->category->id}})">{{$product->category->name}}</a></b></p>
                                    @endif
                                    <div class="price_box">
                                        <span class="current_price">${{($product->unitPrice-$product->discount_price )}}</span>
                                                    @if($product->discount_price > 0)
                                                    <span class="old_price">${{$product->unitPrice}}</span>
                                                    @endif

                                    </div>
                                    <div class="product_desc">
                                        <small>{{$product->description}}</small>
                                    </div>
                                    <div class="action_links list_action_right">
                                        <button class="cart-button btn-sm btn-primary" type="button" data-tippy="Add to cart"
                                        data-tippy-placement="top"
                                        data-tippy-arrow="true"
                                        onclick="addtocart({{$product->id}})">Add to cart
                               </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <picture>


                            <img class="pr-1" src="{{asset('frontend/assets/img/icon/404.jpg')}}" alt="">
                        </picture>
                        @endforelse


                    </div>

                    <div class="shop_toolbar t_bottom">
                        <div class="pagination">
                            {{ $products->appends(request()->except('page'))->links('vendor.livewire.bootstrap') }}

                        </div>
                    </div>


                    <!--shop toolbar end-->
                    <!--shop wrapper end-->
                </div>
            </div>
        </div>
    </div>
    <!--shop  area end-->
</div>
