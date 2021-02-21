<div class="col-lg-6 col-md-6">
    <div class="account_form">
        <h2>login</h2>
        <form action="{{route('login')}}" method="POST">
            @csrf
            <p>
                <label> email <span>*</span></label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror">
                @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
             </p>
             <p>
                <label>Passwords <span>*</span></label>
                <input type="password" class="form-control " name="password"  class="form-control @error('password') is-invalid @enderror">

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
             </p>
            <div class="login_submit">
               {{-- <a href="#">Lost your password?</a> --}}

                <button type="submit" >login</button>

            </div>
        </form>
            <hr>
            <h4 class="text-center"> Login to your account</h4>
            <div class="row justify-content-center">

                <div class="col-md-8">
                <a href="{{route('auth.google')}}" style="color: white;">
                <button class="btn-google login-icons btn-lg" style="background: #c71e25 none repeat scroll 0 0;
                color: #fff;">
                   <i class="fa fa-google"></i>
                    Google</button>
                </a>
                {{-- <a href="{{route('auth.facebook')}}" style="color: white;">
                <button class="btn-facebook login-icons btn-lg" style="background: #395b9a none repeat scroll 0 0;
                color: #fff;">
                    <i class="fa fa-facebook"></i>
                    Facebook</button>
                </a> --}}
             </div>

        </div>


     </div>
</div>
