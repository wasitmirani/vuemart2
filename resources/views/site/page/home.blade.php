@extends('layouts.frontend.master')
@section('content')
        <!--slider area start-->
        <section class="slider_section slider_s_four mt-30">
            <div class="container">
                <div class="row">
                    {{-- Slider --}}
                    <div class="col-lg-9 offset-lg-3">
                        <div class="slider_area owl-carousel">
                            @foreach ($sliders as $item)


                            <div class="single_slider d-flex align-items-center"
                                data-bgimg="/admin/img/slider/{{$item->thumbnail}}">
                                <div class="slider_content slider_c_three c_four">
                                    <h1 class="text-light" >{{$item->heading}}</h1>
                                    <p  class="text-light">
                                        {{$item->subheading}}
                                 </p>
                                 @if(!empty($item->link))
                                 <a href="{{$item->link}}">Show Now </a>
                                 @else
                                    <a href="{{route('products')}}">Show Now </a>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--slider area end-->

        <!--shipping area start-->
        <div class="shipping_area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="single_shipping">
                            <div class="shipping_icone">
                                <img style="width: 30px;" src="{{asset('/frontend/icons/calendar.png')}}" alt="">
                            </div>
                            <div class="shipping_content">
                                <h6  class="mt-2">Same Day Delivery</h6>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="single_shipping col_2">
                            <div class="shipping_icone">
                                <img style="width: 30px;" src="{{asset('/frontend/icons/delivery.png')}}" alt="">
                            </div>
                            <div class="shipping_content">
                                <h6 class="mt-2" >Free Delivery on Order </h6>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="single_shipping col_3">
                            <div class="shipping_icone">
                                 <img style="width: 30px;" src="{{asset('/frontend/icons/satisfaction.png')}}" alt="">

                            </div>
                            <div class="shipping_content">
                                <h6  class="mt-2">100% Satisfaction Guarantee</h6>


                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!--shipping area end-->

        <!--banner area start-->

        <!--banner area end-->

        <!--home three bg area start-->
        {{-- Feature Products --}}
        <div class="home4_gallery_area color_four">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-4">
                        <div class="home4_gallery_left">
                            <div class="custom_product4">
                                <div class="section_title">
                                    <h2>Featured Products</h2>
                                </div>
                                <div class="small_product_area product_carousel smallp4_left_column1 owl-carousel">
                                    <div class="product_items">
                                        @foreach ($featuredProducts->slice(0,5) as $product)
                                        <article class="single_product">
                                            <figure>
                                                @component('site.components.productthumbnail',['product'=>$product,'widget'=>'featuredproduct'])
                                                @endcomponent

                                                @component('site.components.productcontent',['product'=>$product])

                                                @endcomponent
                                            </figure>
                                        </article>

                                        @endforeach


                                    </div>

                                    @if($featuredProducts->count()>6)
                                    <div class="product_items">
                                          @foreach ($featuredProducts->slice(7,12) as $product)
                                        <article class="single_product">
                                            <figure>

                                                @component('site.components.productthumbnail',['product'=>$product,'widget'=>'featuredproduct'])
                                                @endcomponent

                                                @component('site.components.productcontent',['product'=>$product])

                                                @endcomponent
                                            </figure>
                                        </article>

                                        @endforeach
                                    </div>
                                    @endif

                                    @if($featuredProducts->count()>12)
                                    <div class="product_items">
                                          @foreach ($featuredProducts->slice(12,18) as $product)
                                        <article class="single_product">
                                            <figure>


                                                @component('site.components.productthumbnail',['product'=>$product,'widget'=>'featuredproduct'])

                                                @endcomponent
                                                    @component('site.components.productcontent',['product'=>$product])

                                                @endcomponent


                                            </figure>
                                        </article>

                                        @endforeach
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="banner_thumb">
                                <a href="{{route('products')}}"><img src="frontend\assets\img\bg\banner14.jpg" alt=""></a>
                            </div>
                             <div class="banner_thumb mt-1">
                                <a href="{{route('products')}}"><img src="frontend\assets\img\bg\banner17.jpg" alt=""></a>
                            </div>
                             <div class="banner_thumb mt-1">
                                <a href="{{route('products')}}"><img src="frontend\assets\img\bg\banner7.jpg" alt=""></a>
                            </div>


                        </div>
                    </div>
                    {{-- New Products --}}
                    <div class="col-lg-9 col-md-8">
                        <div class="home4_gallery_right">
                            <!--product area start-->
                            <div class="product_area mb-65">
                                <div class="product_tab_btn product_tab_style4">
                                    <ul class="nav" role="tablist" id="nav-tab">
                                        <li>
                                            <a class="active" data-toggle="tab" href="#plant1" role="tab"
                                                aria-controls="plant1" aria-selected="true">
                                                New Products
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="product_container">
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="plant1" role="tabpanel">
                                            <div class="product_carousel product3_column3 owl-carousel">
                                            @foreach ($latestProducts as $product)
                                                 <div class="product_items">
                                                    <article class="single_product">
                                                        <figure>
                                                              @component('site.components.productthumbnail',['product'=>$product,'widget'=>'newproduct'])
                                                               @endcomponent

                                                                @component('site.components.newProductContent',['product'=>$product])

                                                                @endcomponent
                                                        </figure>
                                                    </article>

                                                </div>
                                            @endforeach


                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!--product area end-->

                            <!--banner area start-->
                            <div class="banner4_right_side">
                                <div class="banner_thumb">
                                    <a href="{{route('products')}}"><img src="frontend\assets\img\bg\banner15.jpg" alt=""></a>
                                </div>
                                <div class="banner_thumb">
                                    <a href="{{route('products')}}"><img src="frontend\assets\img\bg\banner16.jpg" alt=""></a>
                                </div>

                            </div>
                            <!--banner area end-->

                            <!--small product area-->
                            <div class="small_product4_right">
                                <div class="section_title">
                                    <h2>Best Sellers</h2>
                                </div>
                                <div class="small_product_area product_carousel smallp_column2 owl-carousel">
                                    <div class="product_items">
                                        @foreach($randomProducts->slice(0,2) as $product)
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
                                    @if($randomProducts->count()>2)
                                     <div class="product_items">
                                        @foreach($randomProducts->slice(3,2) as $product)
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
                                    @endif
                                       @if($randomProducts->count()>4)
                                        <div class="product_items">
                                            @foreach($randomProducts->slice(5,2) as $product)
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
                                       @endif
                                        @if($randomProducts->count()>6)
                                        <div class="product_items">
                                            @foreach($randomProducts->slice(7,2) as $product)
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
                                       @endif
                                </div>
                            </div>
                            <!--small product end-->
                            <div class="small_product4_right">
                                <div class="section_title">
                                    <h2>Our Products</h2>
                                </div>
                                <div class="small_product_area product_carousel smallp_column2 owl-carousel">
                                    <div class="product_items">
                                        @foreach($getProductsByCategory->slice(0,2) as $product)
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
                                    @if($getProductsByCategory->count()>2)
                                     <div class="product_items">
                                        @foreach($getProductsByCategory->slice(3,2) as $product)
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
                                    @endif
                                       @if($getProductsByCategory->count()>4)
                                        <div class="product_items">
                                            @foreach($getProductsByCategory->slice(5,2) as $product)
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
                                       @endif
                                        @if($getProductsByCategory->count()>6)
                                        <div class="product_items">
                                            @foreach($getProductsByCategory->slice(7,2) as $product)
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
                                       @endif
                                </div>
                            </div>
                            <!--product area start-->
                            {{-- <div class="product_area product_margin4">
                                <div class="product_header product_header4">
                                    <div class="section_title">
                                        <h2>Our Products</h2>
                                    </div>
                                    <div class="product_tab_btn" id="nav-tab2">
                                        <ul class="nav" role="tablist">
                                            @foreach ($getProductsByCategory as $category)
                                            @if(!empty($category->products) &&  !empty($category))
                                            <li>
                                                <a class="@if($loop->iteration==1) active @endif" data-toggle="tab" href="#cat{{$category->id}}" role="tab"
                                                    aria-controls="cat{{$category->id}}" aria-selected="true">
                                                   {{Str::limit($category->name,10, '...')}}
                                                </a>
                                            </li>
                                            @endif
                                            @endforeach


                                        </ul>
                                    </div>
                                </div>
                                <div class="product_container">
                                    <div class="tab-content">
                                        @foreach ($getProductsByCategory as $category)
                                        @if(!empty($category->products) && !empty($category))
                                        <div class="tab-pane fade @if($loop->iteration==1) show active @endif" id="cat{{$category->id}}" role="tabpanel">
                                            <div class="product_carousel product_column4 owl-carousel">

                                                @foreach ($category->products as $product)


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
                                        @endif
                                       @endforeach
                                    </div>
                                </div>
                            </div> --}}
                            <!--product area end-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--home three bg area end-->

        <!--brand area start-->
        <div class="brand_area">

        </div>
        <!--brand area end-->

@endsection
