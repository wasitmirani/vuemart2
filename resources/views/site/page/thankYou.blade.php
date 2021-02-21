@extends('layouts.frontend.master')
@section('content')

     <!--error section area start-->
     <div class="error_section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="error_form">
                        <h3 class="text-danger">Thank You</h3>
                        <h6>Thank you for your shopping from <span class="text-danger">{{config('app.name')}}</span> </h6>



                        <a href="{{route('index')}}" class="cart-button btn btn-primary">Back to home page</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--error section area end-->


@endsection
