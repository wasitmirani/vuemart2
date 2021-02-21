<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr" >
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description"
        content="Vuemart Online Grocery Shopping">
    <meta name="keywords"
        content=" Vuemart Online Grocery Shopping">
    <meta name="author" content="Vuemart">
    <title> Vuemart - Online Grocery Shopping</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('app-assets/images/ico/favicon2.ico')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/charts/apexcharts.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/extensions/toastr.min.css')}}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/bootstrap-extended.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/colors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/components.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/themes/dark-layout.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/themes/bordered-layout.min.css')}}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/core/menu/menu-types/vertical-menu.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/dashboard-ecommerce.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/charts/chart-apex.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/fontawesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/extensions/ext-component-toastr.min.css')}}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click"
    data-menu="vertical-menu-modern" data-col="">
    <div id="app">
        <!-- BEGIN: Header-->
        {{-- Top NavBar --}}

        {{-- End TopNavbar --}}

        @component('layouts.navbar.topbar')

        @endcomponent
        <!-- END: Header-->
        {{-- @dd(Auth::user()->getPermissionsViaRoles()) --}}

        <!-- BEGIN: Main Menu-->
        <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
            <div class="navbar-header">
                <ul class="nav navbar-nav flex-row">
                    <li class="nav-item mr-auto"><a class="navbar-brand" href="{{route('index')}}"><span class="brand-logo">
                                <svg viewbox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" height="24">
                                    <defs>
                                        <lineargradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%"
                                            y2="89.4879456%">
                                            <stop stop-color="#000000" offset="0%"></stop>
                                            <stop stop-color="#FFFFFF" offset="100%"></stop>
                                        </lineargradient>
                                        <lineargradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%"
                                            x2="37.373316%" y2="100%">
                                            <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                                            <stop stop-color="#FFFFFF" offset="100%"></stop>
                                        </lineargradient>
                                    </defs>

                                </svg></span>
                            <h2 class="brand-text">Vuemart</h2>
                        </a></li>
                    <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i
                                class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i
                                class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary"
                                data-feather="disc" data-ticon="disc"></i></a></li>
                </ul>
            </div>
            <div class="shadow-bottom"></div>
            @component('layouts.navbar.mainmenu')

            @endcomponent
        </div>

        <!-- END: Main Menu-->

        <!-- BEGIN: Content-->
        <div class="app-content content ">
            <div class="content-overlay"></div>
            <div class="header-navbar-shadow"></div>
            {{-- Yield Content --}}
            @yield('content')

        </div>
        <!-- END: Content-->


    </div>
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    @component('layouts.footer.menu')

    @endcomponent

    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- BEGIN: Vendor JS-->
    <script src="{{asset('app-assets/vendors/js/vendors.min.js')}}" ></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->

    {{-- <script src="{{asset('app-assets/vendors/js/extensions/toastr.min.js')}}" ></script> --}}
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{asset('app-assets/js/core/app-menu.min.js')}}" ></script>
    <script src="{{asset('app-assets/js/core/app.min.js')}}" ></script>
    <script src="{{asset('app-assets/js/scripts/customizer.min.js')}}" ></script>
    <!-- END: Theme JS-->
    <!-- Scripts -->


    <!-- BEGIN: Page JS-->
    {{-- <script src="{{asset('app-assets/js/scripts/pages/dashboard-ecommerce.min.js')}}" ></script> --}}

     <script src="{{asset('app-assets/js/fontawesome.min.js')}}" ></script>


     <script >
        @auth
           window.authUser = {!! json_encode(Auth::user(), true) !!};
       @else
           window.authUser = [];
       @endauth
   </script>
     <script type="text/javascript">
        @auth
           window.Permissions = {!! json_encode(Auth::user()->getPermissionsViaRoles()->pluck('name'), true) !!};
        @else
           window.Permissions = [];
        @endauth
     </script>
    <!-- END: Page JS-->
    @stack('scripts')
    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })

    </script>
</body>
<!-- END: Body-->

</html>
