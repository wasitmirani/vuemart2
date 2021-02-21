 <footer class="footer_widgets color_four">
            <div class="footer_top">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-12 col-sm-7">
                            <div class="widgets_container contact_us">
                                <div class="footer_logo">
                                    <a href="{{route('index')}}"><img style="width:150px;" src="frontend\assets\img\logo\logo.png" alt=""></a>
                                </div>
                                @if(!empty(getAppSetting()->tagcontent))
                                <p class="footer_desc"> {{ Str::limit(getAppSetting()->tagcontent,100,'...')}}</p>
                                @endif
                                @if(!empty(getAppSetting()->address1))
                                <p><span>Address:</span><span class="text-primary">  {{getAppSetting()->address1 ." ".getAppSetting()->address2 . "" .getAppSetting()->zipcode . " , " . getAppSetting()->city ." ,".getAppSetting()->state." " . getAppSetting()->country}}</span></p>
                                @endif
                                @if(!empty(getAppSetting()->email))
                                <p><span>Email:</span> <a href="mailto: {{getAppSetting()->email}}">{{getAppSetting()->email}}</a></p>
                                @endif
                                @if(!empty(getAppSetting()->contact))
                                <p><span>Call us:</span> <a href="tel:{{getAppSetting()->contact}}">{{getAppSetting()->contact}}</a> </p>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-5">
                            <div class="widgets_container widget_menu">
                                <h3>Information</h3>
                                <div class="footer_menu">

                                    <ul>
                                        <li><a href="{{url('/about')}}">About Us</a></li>
                                        <li><a href="#">Delivery Information</a></li>
                                        <li><a href="#"> Privacy Policy</a></li>
                                        <li><a href="#"> Terms & Conditions</a></li>
                                        <li><a href="{{url('contact-us')}}"> Contact Us</a></li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-4">
                            <div class="widgets_container widget_menu">
                                <h3>Extras</h3>
                                <div class="footer_menu">
                                    <ul>
                                        <li><a href="{{route('index')}}">Home</a></li>
                                        <li><a href="{{route('products')}}">Products</a></li>
                                        <li><a href="{{route('products')}}">Categories</a></li>
                                        <li><a href="{{route('member.dashboard')}}"> Order History</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-8">
                            <div class="widgets_container widget_newsletter">
                                <h3>Sign up newsletter</h3>
                                <p class="footer_desc">Get updates by subscribe our weekly newsletter</p>
                                <div class="subscribe_form">
                                    <form id="mc-form" class="mc-form footer-newsletter">
                                        <input id="mc-email" type="email" autocomplete="off"
                                            placeholder="Enter you email">
                                        <button id="mc-submit">Subscribe</button>
                                    </form>
                                    <!-- mailchimp-alerts Start -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer_bottom">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-7">
                            <div class="copyright_area">
                                <p>Copyright © 2021 <a href="{{route('index')}}">Vuemart</a> . All Rights Reserved.Design by <a
                                        href="{{route('index')}}">Vuemart</a></p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-5">
                            <div class="footer_payment">
                                <ul>
                                    @if(!empty(getAppSetting()->facebook))
                                    <li><a href="{{getAppSetting()->facebook}}">

                                        <i class="fa fa-facebook text-primary"></i>
                                    </a></li>
                                    @endif
                                    @if(!empty(getAppSetting()->instagram))
                                    <li><a href="{{getAppSetting()->instagram}}">

                                        <i class="fa fa-instagram text-danger"></i>
                                    </li>
                                    @endif
                                    @if(!empty(getAppSetting()->twitter))
                                    <li><a href="{{getAppSetting()->twitter}}">

                                        <i class="fa-twitter-square text-primary"></i>
                                        {{-- <img src="frontend\assets\img\icon\twitter.png" alt=""> --}}
                                    </a></li>
                                    @endif

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
