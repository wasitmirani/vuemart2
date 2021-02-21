<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
    @component('layouts.frontend.seo.tag')
    @endcomponent

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="frontend\assets\img\favicon.png">

    <!-- CSS
    ========================= -->
    <!--bootstrap min css-->
    <link rel="stylesheet" href="{{asset('frontend\assets\css\bootstrap.min.css')}}">
    <!--owl carousel min css-->
    <link rel="stylesheet" href="{{asset('frontend\assets\css\owl.carousel.min.css')}}">
    <!--slick min css-->
    <link rel="stylesheet" href="{{asset('frontend\assets\css\slick.css')}}">
    <!--magnific popup min css-->
    <link rel="stylesheet" href="{{asset('frontend\assets\css\magnific-popup.css')}}">
    <!--font awesome css-->
    <link rel="stylesheet" href="{{asset('frontend\assets\css\font.awesome.css')}}">
    <!--ionicons css-->
    <link rel="stylesheet" href="{{asset('frontend\assets\css\ionicons.min.css')}}">
    <!--linearicons css-->
    <link rel="stylesheet" href="{{asset('frontend\assets\css\linearicons.css')}}">
    <!--animate css-->
    <link rel="stylesheet" href="{{asset('frontend\assets\css\animate.css')}}">
    <!--jquery ui min css-->
    <link rel="stylesheet" href="{{asset('frontend\assets\css\jquery-ui.min.css')}}">
    <!--slinky menu css-->
    <link rel="stylesheet" href="{{asset('frontend\assets\css\slinky.menu.css')}}">
    <!--plugins css-->
    <link rel="stylesheet" href="{{asset('frontend\assets\css\plugins.css')}}">

    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{asset('frontend\assets\css\style.css')}}">


        @livewireStyles

</head>

<body>

    <!--header area start-->

    <!--offcanvas menu area start-->
    <div class="off_canvars_overlay">

    </div>
    <div class="offcanvas_menu offcanvas_three">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="canvas_open">
                        <a href="javascript:void(0)"><i class="icon-menu"></i></a>
                    </div>
                    <div class="offcanvas_menu_wrapper">
                        <div class="canvas_close">
                            <a href="javascript:void(0)"><i class="icon-x"></i></a>
                        </div>

                        {{-- <div class="header_social text-right">
                            <ul>
                                <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                                <li><a href="#"><i class="ion-social-googleplus-outline"></i></a></li>
                                <li><a href="#"><i class="ion-social-youtube-outline"></i></a></li>
                                <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                                <li><a href="#"><i class="ion-social-instagram-outline"></i></a></li>
                            </ul>
                        </div> --}}

                        <div class="call-support">
                            @if(!empty(getAppSetting()->contact))
                            <p><a href="tel:{{getAppSetting()->contact}}">{{getAppSetting()->contact}}</a> Customer Support</p>
                            @endif

                        </div>
                        <div id="menu" class="text-left ">
                            <ul class="offcanvas_main_menu">
                                <li class="menu-item-has-children active">
                                    <a href="{{route('index')}}">Home</a>

                                <li class="menu-item-has-children">
                                    <a href="{{route('products')}}">Products</a>


                                </li>
                                <li class="menu-item-has-children">
                                    <a href="{{route('aboutus')}}">About Us </a>

                                </li>
                                @if(Auth::check())
                                <li class="menu-item-has-children">
                                    <a href="{{route('home')}}">My Dashboard</a>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                  document.getElementById('logout-form').submit();">
                                     {{ __('Logout') }}
                                 </a>

                                 <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                     @csrf
                                 </form>
                                </li>
                                @else
                                <li class="menu-item-has-children">
                                    <a href="{{route('login')}}"> Login</a>
                                </li>
                                @endif

                                <li class="menu-item-has-children">
                                    <a href="{{route('contactus')}}"> Contact Us</a>
                                </li>
                            </ul>
                        </div>
                        <div class="offcanvas_footer">
                            @if(!empty(getAppSetting()->email))
                            {{-- <p><span>Email:</span> <a href="mailto:{{getAppSetting()->email}}">{{getAppSetting()->email}}</a></p> --}}

                            <span><a href="mailto:{{getAppSetting()->email}}"><i class="fa fa-envelope-o"></i> {{getAppSetting()->email}}</a></span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--offcanvas menu area end-->
    <div class="home_three_container">

        @include('layouts.frontend.navbar.navbar')

        <!--header area end-->
         @yield('content')
        <!--footer area start-->

         @include('layouts.frontend.footer.footer')


        <!--footer area end-->
    </div>



<!--modernizr min js here-->


    <script src="{{asset('/frontend/assets/js/vendor/modernizr-3.7.1.min.js')}}" defer></script>
    <!--jquery min js-->
    <script src="{{asset('/frontend/assets/js/vendor/jquery-3.4.1.min.js')}}" defer></script>
    <!--popper min js-->
    <script src="{{asset('/frontend/assets/js/popper.js')}}" defer></script>
    <!--bootstrap min js-->
    <script src="{{asset('/frontend/assets/js/bootstrap.min.js')}}" defer></script>
    <!--owl carousel min js-->
    <script src="{{asset('/frontend/assets/js/owl.carousel.min.js')}}" defer></script>
    <!--slick min js-->
    <script src="{{asset('/frontend/assets/js/slick.min.js')}}" defer></script>
    <!--magnific popup min js-->
    <script src="{{asset('/frontend/assets/js/jquery.magnific-popup.min.js')}}" defer></script>
    <!--counterup min js-->
    {{-- <script src="{{asset('/frontend/assets/js/jquery.counterup.min.js')}}" defer></script>
    <!--jquery countdown min js-->
    <script src="{{asset('/frontend/assets/js/jquery.countdown.js')}}" defer></script> --}}
    <!--jquery ui min js-->
    <script src="{{asset('/frontend/assets/js/jquery.ui.js')}}" defer></script>
    <!--jquery elevatezoom min js-->
    <script src="{{asset('/frontend/assets/js/jquery.elevatezoom.js')}}" defer></script>
    <!--isotope packaged min js-->
    <script src="{{asset('/frontend/assets/js/isotope.pkgd.min.js')}}" defer></script>
    <!--slinky menu js-->
    <script src="{{asset('/frontend/assets/js/slinky.menu.js')}}" defer></script>

    <!-- tippy bundle umd js -->
    <script src="{{asset('/frontend/assets/js/tippy-bundle.umd.js')}}" defer></script>
    <!-- Plugins JS -->
    <script src="{{asset('/frontend/assets/js/plugins.js')}}" defer></script>

    <!-- Main JS -->
    <script src="{{asset('/frontend/assets/js/main.js')}}" defer></script>
     @livewireScripts
    @stack('scripts')

<script src="{{asset('js/axios.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>

@if(session('cartEmpty'))

Swal.fire({
  icon: 'warning',
  title: 'Oops...',
  text: "{{session('cartEmpty')}}",
  footer: '<a href="{{route('products')}}">Go to Shopping</a>'
})
@endif
function addtocart(item){



        let frmdata =new FormData();
        frmdata.append("product_id",item);



       axios.post("{{route('add.cart')}}",frmdata).then((res)=>{
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
                title: 'Add to cart '+res.data.name+' successfuly'
                })
            $(".totalitem").text(res.data.totalcart);


       });
    }



</script>





</body>

</html>
