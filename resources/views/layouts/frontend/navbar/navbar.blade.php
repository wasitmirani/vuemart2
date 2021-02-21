  <header>
            <div class="main_header header_four color_four">

                <div class="header_middle">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                <div class="logo">
                                    <a href="{{route('index')}}"><img style="width:80px;"  src="frontend\assets\img\logo\logo.png" alt=""></a>
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-6 col-sm-7 col-8">
                                <div class="header_right_info">
                                    <!--main menu start-->
                                    <div class="main_menu menu_four">
                                        <nav>
                                            <ul>
                                                <li><a class="active" href="{{route('index')}}">Home</a>

                                                </li>
                                                <li class="mega_items"><a href="{{route('products')}}">Products</a>
                                                </li>
                                                <li><a href="{{route('aboutus')}}">About Us </a></li>
                                                @if(!Auth::check())
                                                <li><a href="{{route('login')}}">Login</a></li>
                                                @endif
                                                @if(Auth::check())
                                                <li><a role="button">My Account<i class="fa fa-angle-down"></i></a>
                                                    <ul class="sub_menu pages">
                                                        <li><a href="{{route('home')}}">Dashboard</a></li>
                                                        <li>
                                                        <a href="{{ route('logout') }}"
                                                        onclick="event.preventDefault();
                                                                      document.getElementById('logout-form').submit();">
                                                         {{ __('Logout') }}
                                                     </a>

                                                     <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                         @csrf
                                                     </form>
                                                    </li>
                                                    </ul>
                                                </li>
                                                @endif
                                                 <li><a href="{{route('contactus')}}"> Contact Us</a></li>


                                            </ul>
                                        </nav>
                                    </div>
                                    <!--main menu end-->
                                    <div class="header_account_area">
                                        {{-- @if(!Auth::check())
                                        <div class="header_account_list register">
                                            <ul>


                                                <li><a href="{{route('login')}}">Login</a></li>
                                            </ul>
                                        </div>
                                        @endif --}}


                                        @livewire('cart-items')

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header_bottom">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-3 col-md-6">
                                <div class="categories_menu @if(request()->route()->getName()=="index") categories_three @endif">
                                    <div class="categories_title">
                                        <h2 class="categori_toggle">All Cattegories</h2>
                                    </div>
                                    <div class="categories_menu_toggle">
                                        @php
                                          $categories=getCategories();
                                        @endphp

                                        <ul>
                                            @forelse ($categories as $category)
                                              <li @if($category->subCategories->count() >0) class="menu_item_children" @endif>
                                                  <a href="{{route('products',['category'=>'true','categoryid'=>$category->id])}}">
                                                <img src="{{categoryImage($category->thumbnail)}}" alt="" class="avatar">
                                                {{Str::limit($category->name,18,'....')}}
                                                  @if(!empty($category->subCategories) &&  $category->subCategories->count() >0)
                                                 <i
                                                        class="fa fa-angle-right"></i>
                                                @endif
                                                    </a>

                                                @if(!empty($category->subCategories) &&  $category->subCategories->count() >0)
                                                <ul class="categories_mega_menu column_2">

                                                     <li class="menu_item_children">
                                                         <a href="{{route('products',['category'=>'true','categoryid'=>$category->id])}}">
                                                            <span class="text-danger">
                                                                <b> {{ $category->name}}</b>

                                                            </span>
                                                            </a>


                                                        <ul class="categorie_sub_menu">
                                                            @foreach ($category->subCategories as $subcategory)
                                                            <li><a href="{{route('products',['subcategory'=>'true','subcategoryid'=>$subcategory->id])}}">{{$subcategory->name}}</a></li>
                                                             @if($loop->iteration ==7)
                                                               @break
                                                             @endif
                                                            @endforeach

                                                        </ul>


                                                    </li>
                                                </ul>
                                                @endif


                                            </li>

                                            @empty

                                            @endforelse

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="search_container">
                                    <form action="{{route('products')}}">

                                        <div class="search_box">
                                            <input placeholder="Search product..." name="query" type="text">
                                            <button type="submit"><span class="lnr lnr-magnifier"></span></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="">
                                    @if(!empty(getAppSetting()->contact))
                                    <p><a href="tel:{{getAppSetting()->contact}}">{{getAppSetting()->contact}}</a> Customer Support</p>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
