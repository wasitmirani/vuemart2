<div class="main-menu-content">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

        <li class="nav-item "><a class="d-flex align-items-center" href="{{ route('dashboard.home') }}"> <img
                    class="icon-img" src="{{ icons_img('dashboard.png', 'png') }}" alt="" srcset=""> <span
                    class="menu-title text-truncate " data-i18n="Dashboards" style="margin-left: 8px;">
                    Dashboard</span><span class="badge badge-light-warning badge-pill ml-auto mr-1"></span></a>
        </li>

        <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Apps &amp; Pages</span><i
                data-feather="more-horizontal"></i>
        </li>




        @hasanyrole('SuperAdmin|Admin')
        {{-- SuperAdmin Admin --}}


        <li class=" nav-item"><a class="d-flex align-items-center" href="#">
                <img class="icon-img" src="{{ icons_img('userm.png', 'png') }}" alt="" srcset="">
                <span class="menu-title text-truncate">Users Management</span></a>
            <ul class="menu-content">



                <li v-can="'UsersView'"><router-link class="d-flex align-items-center" to="/users">
                    <img class="subicon-img" src="{{ icons_img('user.png', 'png') }}" alt="" srcset="">
                    <span class="menu-item" data-i18n="List">Users</span></router-link>
                   </li>


                <li  v-can="'RolesView'"><router-link class="d-flex align-items-center" to="/roles">
                        <img class="subicon-img" src="{{ icons_img('role.png', 'png') }}" alt="" srcset="">
                        <span class="menu-item" style="margin-bottom: 5px;">Roles</span></router-link>
                </li>
                <li v-can="'PermissionsView'"><router-link class="d-flex align-items-center" to="/permissions">
                        <img class="subicon-img" src="{{ icons_img('permissions.png', 'png') }}" alt="" srcset="">
                        <span class="menu-item">Permissions</span></router-link>
                </li>
                {{-- <li><a class="d-flex align-items-center" href="app-invoice-add.html">

                        <img class="subicon-img" src="{{ icons_img('trash.png', 'png') }}" alt="" srcset="">
                        <span class="menu-item">Trash Users </span></a>
                </li> --}}
            </ul>
        </li>
        <li class=" nav-item"><a class="d-flex align-items-center" href="#">
            <img class="icon-img" src="{{ icons_img('mystore.png', 'png') }}" alt="" srcset="">
            <span class="menu-title text-truncate">My Store</span> <span
                class="badge badge-light-danger badge-pill ml-auto mr-2"></span></a>
        <ul class="menu-content">
            <li v-can="'VariationView'"><a class="d-flex align-items-center" href="#">
                    <img class="icon-img" src="{{ icons_img('variationlist.png', 'png') }}" alt="" srcset="">
                    <span class="menu-item">Variation's</span></a>
                <ul class="menu-content">
                    <li>
                        <router-link class="d-flex align-items-center" to="/categories" >
                            <img class="subicon-img" src="{{ icons_img('category.png', 'png') }}" alt="" srcset="">
                            <span class="menu-item">Categories </span></router-link>
                    </li>
                    <li><router-link class="d-flex align-items-center" to="/sub/categories" >
                            <img class="subicon-img" src="{{ icons_img('subcategory.png', 'png') }}" alt=""
                                srcset="">
                            <span class="menu-item">Sub Categories</span></router-link>
                    </li>
                </ul>
            </li>

            <li v-can="'ProductsView'">
                <router-link  class="d-flex align-items-center" to="/products">
                    <img class="icon-img" src="{{ icons_img('products.png', 'png') }}" alt="" srcset=""><span
                        class="menu-item">
                        Product's</span></router-link>
            </li>
            <li v-can="'OrdersView'"> <router-link class="d-flex align-items-center" to="/orders"> <img class="subicon-img"
                        src="{{ icons_img('orders.png', 'png') }}" alt="" srcset=""><span class="menu-item"
                        >Order's</span> <span
                        class="badge badge-light-danger badge-pill ml-auto mr-2"></span></router-link>
            </li>



        </ul>
    </li>
        @else
        <li class=" nav-item"><a class="d-flex align-items-center" href="#">
                <img class="icon-img" src="{{ icons_img('mystore.png', 'png') }}" alt="" srcset="">
                <span class="menu-title text-truncate">My Store</span> <span
                    class="badge badge-light-danger badge-pill ml-auto mr-2">0</span></a>
            <ul class="menu-content">
                <li><a class="d-flex align-items-center" href="#">
                        <img class="icon-img" src="{{ icons_img('variationlist.png', 'png') }}" alt="" srcset="">
                        <span class="menu-item">Variation's</span></a>
                    <ul class="menu-content">
                        <li>
                            <router-link class="d-flex align-items-center" to="/categories" >
                                <img class="subicon-img" src="{{ icons_img('category.png', 'png') }}" alt="" srcset="">
                                <span class="menu-item">Categories </span></router-link>
                        </li>
                        <li><router-link class="d-flex align-items-center" to="/sub/categories" >
                                <img class="subicon-img" src="{{ icons_img('subcategory.png', 'png') }}" alt=""
                                    srcset="">
                                <span class="menu-item">Sub Categories</span></router-link>
                        </li>
                    </ul>
                </li>
                 {{-- <li><a class="d-flex align-items-center" href="#">
                        <img class="icon-img" src="{{ icons_img('products.png', 'png') }}" alt="" srcset="">
                        <span class="menu-item">Variation's</span></a>
                    <ul class="menu-content">
                        <li>
                            <router-link class="d-flex align-items-center" to="/categories" >
                                <img class="subicon-img" src="{{ icons_img('category.png', 'png') }}" alt="" srcset="">
                                <span class="menu-item">Categories </span></router-link>
                        </li>
                        <li><router-link class="d-flex align-items-center" to="/sub/categories" >
                                <img class="subicon-img" src="{{ icons_img('subcategory.png', 'png') }}" alt=""
                                    srcset="">
                                <span class="menu-item">Sub Categories</span></router-link>
                        </li>
                    </ul>
                </li> --}}
                <li>
                    <router-link  class="d-flex align-items-center" to="/products">
                        <img class="icon-img" src="{{ icons_img('products.png', 'png') }}" alt="" srcset=""><span
                            class="menu-item">
                            Product's</span></router-link>
                </li>
                <li><router-link class="d-flex align-items-center" to="/orders"> <img class="subicon-img"
                            src="{{ icons_img('orders.png', 'png') }}" alt="" srcset=""><span class="menu-item"
                            >Order's</span> <span
                            class="badge badge-light-danger badge-pill ml-auto mr-2">0</span></router-link>
                </li>



            </ul>
        </li>

        @endhasanyrole




        @hasanyrole('SuperAdmin|Admin')
        <li class=" navigation-header" v-can="'TrashView'"><span >Trash Records &amp; Deleted</span><i
                data-feather="more-horizontal"></i>
        </li>
        <li class=" nav-item" v-can="'TrashView'"><a class="d-flex align-items-center" href="#" >
                <img class="icon-img" src="{{ icons_img('garbage.png', 'png') }}" alt="" srcset=""><span
                    class="menu-title text-truncate" data-i18n="Form Elements">Trash</span></a>
            <ul class="menu-content">
                <li><router-link class="d-flex align-items-center" to="/trashed/categories">

                        <img class="subicon-img" src="{{ icons_img('delete.png', 'png') }}" alt="" srcset="">
                        <span class="menu-item">Deleted Category</span> </router-link>
                </li>
                <li><router-link class="d-flex align-items-center" to="/trashed/sub/categories">

                        <img class="subicon-img" src="{{ icons_img('delete.png', 'png') }}" alt="" srcset="">
                        <span class="menu-item">Deleted Sub Category</span> <span
                            class="badge badge-light-danger badge-pill ml-auto mr-2"></span></router-link>
                </li>
                <li><router-link class="d-flex align-items-center" to="/trashed/products">

                    <img class="subicon-img" src="{{ icons_img('delete.png', 'png') }}" alt="" srcset="">
                    <span class="menu-item">Deleted Products</span> <span
                        class="badge badge-light-danger badge-pill ml-auto mr-2"></span></router-link>
            </li>
            </ul>
        </li>
        @endhasanyrole
        @hasanyrole('SuperAdmin|Admin')
        <li class=" navigation-header" v-can="'SeoToolView'"><span data-i18n="Forms &amp; Tables">Seo &amp; Content</span><i
                data-feather="more-horizontal"></i>
        </li>
        <li class=" nav-item" v-can="'SeoToolView'"><a class="d-flex align-items-center" href="#">
                <img class="icon-img" src="{{ icons_img('seo.png', 'png') }}" alt="" srcset=""><span
                    class="menu-title text-truncate" data-i18n="Form Elements">Seo Tool</span></a>
            <ul class="menu-content">
                <li><router-link class="d-flex align-items-center" to="/seo/tools">

                        <img class="subicon-img" src="{{ icons_img('seoop.png', 'png') }}" alt="" srcset="">
                        <span class="menu-item">SEO Optimization</span></router-link>
                </li>
            </ul>
        </li>
        @else
        <li class=" navigation-header"><span data-i18n="Forms &amp; Tables">Seo &amp; Content</span><i
            data-feather="more-horizontal"></i>
            </li>
            <li class=" nav-item"><a class="d-flex align-items-center" href="#">
                    <img class="icon-img" src="{{ icons_img('seo.png', 'png') }}" alt="" srcset=""><span
                        class="menu-title text-truncate" data-i18n="Form Elements">Seo Tool</span></a>
                <ul class="menu-content">
                    <li><router-link class="d-flex align-items-center" to="/seo/tools">

                            <img class="subicon-img" src="{{ icons_img('seoop.png', 'png') }}" alt="" srcset="">
                            <span class="menu-item">SEO Optimization</span></router-link>
                    </li>
                </ul>
            </li>
        @endhasanyrole

        <li class=" navigation-header"><span data-i18n="Forms &amp; Tables">Sales &amp; Reports</span><i
                data-feather="more-horizontal"></i>
        </li>
        <li class=" nav-item"><a class="d-flex align-items-center" href="#">
                <img class="icon-img" src="{{ icons_img('sale.png', 'png') }}" alt="" srcset=""><span
                    class="menu-title text-truncate" data-i18n="Form Elements">Sales</span></a>
            <ul class="menu-content">
                <li><router-link class="d-flex align-items-center" to="/sale/reports">

                        <img class="subicon-img" src="{{ icons_img('charts.png', 'png') }}" alt="" srcset="">
                        <span class="menu-item"> Sale Report</span></router-link>
                </li>





            </ul>
        </li>



        <li class=" navigation-header"><span data-i18n="Charts &amp; Maps">Profile &amp; Setting</span><i
                data-feather="more-horizontal"></i>
        </li>
        <li class=" nav-item"><a class="d-flex align-items-center" href="#">
            <img class="icon-img" src="{{ icons_img('settings.png', 'png') }}" alt="" srcset=""><span
                    class="menu-title text-truncate" data-i18n="setting">Setting</span></a>
            <ul class="menu-content">

                <li><router-link class="d-flex align-items-center" to="/app/setting">
                    <img class="subicon-img" src="{{ icons_img('app.png', 'png') }}" alt="" srcset="">
                    <span
                            class="menu-item" >App Setting</span></router-link>
                </li>
                <li v-can="'AppSliderView'"><router-link class="d-flex align-items-center" to="/app/slider">
                    <img class="subicon-img" src="{{ icons_img('slider.png', 'png') }}" alt="" srcset="">
                    <span
                            class="menu-item" >App Slider</span></router-link>
                </li>
            </ul>
        </li>



        <li class=" nav-item">

                    <a class="d-flex align-items-center" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                                  <img class="icon-img" src="{{ icons_img('logout.png', 'png') }}" alt="" srcset="">

                                  <span
                                  class="menu-title text-truncate" data-i18n="Disabled Menu">      {{ __('Logout') }}</span>

                 </a>

                 <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                     @csrf
                 </form>

        </li>

    </ul>
</div>
