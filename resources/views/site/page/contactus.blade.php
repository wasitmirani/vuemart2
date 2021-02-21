
@extends('layouts.frontend.master')
@section('content')


<!--breadcrumbs area start-->
<div class="breadcrumbs_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                   <h3>Contact Us</h3>
                    <ul>
                        <li><a href="{{route('index')}}">home</a></li>
                        <li>contact us</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->

<!--contact map start-->
{{-- <div class="contact_map mt-70">
   <div class="map-area">
      <div id="googleMap"></div>
   </div>
</div> --}}
<!--contact map end-->

<!--contact area start-->
<div class="contact_area">
    <div class="container">
        <div class="row mt-2 justify-content-center">
            <div class="col-lg-6 col-md-6">
               <div class="contact_message content">
                    <h2>{{config('app.name')}}</h2>
                    @if(!empty(getAppSetting()->tagcontent))
                    <p class="footer_desc"> {{ Str::limit(getAppSetting()->tagcontent,100,'...')}}</p>
                    @endif
                    <ul>
                        @if(!empty(getAppSetting()->address1))
                        <li><i class="fa fa-map-marker"></i>

                            <p>  {{getAppSetting()->address1 ." ".getAppSetting()->address2 . "" .getAppSetting()->zipcode . " , " . getAppSetting()->city ." ,".getAppSetting()->state." " . getAppSetting()->country}}</span></p>

                        </li>
                        @endif
                        @if(!empty(getAppSetting()->email))
                        <li><i class="fa fa-envelope-o"></i>  <a href="mailto: {{getAppSetting()->email}}">{{getAppSetting()->email}}</a></li>
                        @endif
                        @if(!empty(getAppSetting()->contact))
                        <li><i class="fa fa-phone"></i><a href="tel:{{getAppSetting()->contact}}">{{getAppSetting()->contact}}</a> </li>
                        @endif
                    </ul>



                </div>
            </div>

        </div>
    </div>
</div>
@endsection

<!--contact area end-->
