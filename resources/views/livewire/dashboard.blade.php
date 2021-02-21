<div>
     <!--breadcrumbs area start-->
     <div class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                       <h3>My Account</h3>
                        <ul>
                            <li><a href="{{route('index')}}">home</a></li>
                            <li>My account</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs area end-->


    <!-- my account start  -->
    <section class="main_content_area">
        <div class="container">
            <div class="account_dashboard">
                <div class="row">
                    @if(session('update_user'))
                                                <h5 class="alert alert-success">{{session('update_user')}}</h5>
                                                @endif
                    <div class="col-sm-12 col-md-3 col-lg-3">
                        <!-- Nav tabs -->
                        <div class="dashboard_tab_button">
                            <ul role="tablist" class="nav flex-column dashboard-list" id="nav-tab">
                                <li><a href="#account-details" data-toggle="tab" class="nav-link active">Account details</a></li>
                                <li> <a href="#orders" data-toggle="tab" class="nav-link ">Orders</a></li>



                                <li>
                                <a class="nav-link" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();">
                                 {{ __('Logout') }}
                             </a>

                             <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                 @csrf
                             </form>
                            </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-9 col-lg-9">
                        <!-- Tab panes -->
                        <div class="tab-content dashboard_content">

                            <div class="tab-pane fade  " id="orders">
                                <h3>Orders</h3>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Order Invoice no</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>SubTotal</th>
                                                <th>Discount</th>
                                                <th>Total</th>
                                                {{-- <th>Actions</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($myorders as $item)
                                            <tr>
                                                <td>#00{{$item->id}}</td>
                                                <td>{{$item->created_at->format('M-d-Y')}}</td>
                                                @switch($item->status)
                                                    @case(1)
                                                    <td><span class='text-warning mr-1'>Pending </span></td>
                                                        @break
                                                    @case(2)
                                                    <td> <span class='text-success mr-1'>Accepted </span></td>


                                                        @break
                                                        @case(0)
                                                        <td>  <span class='text-danger mr-1'>Cancel </span></td>
                                                        @break
                                                    @default

                                                @endswitch

                                                <td>${{$item->total_unitprice}}</td>
                                                <td>${{$item->total_discount}}</td>
                                                <td>${{$item->total_unitprice-$item->total_discount}}</td>
                                                {{-- <td><a href="cart.html" class="view">view</a></td> --}}
                                            </tr>
                                            @endforeach


                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            {{-- <div class="tab-pane" id="address">
                               <p>The following addresses will be used on the checkout page by default.</p>
                                <h4 class="billing-address">Billing address</h4>

                                <p><strong>{{Auth::user()->name}}</strong></p>
                                <textarea  class="form-control"   name="address" id=""  rows="2">{{Auth::user()->address}}</textarea>

                            </div> --}}
                            <div class="tab-pane fade show active" id="account-details">
                                <h3>Account details </h3>
                                <div class="login">
                                    <div class="login_form_container">
                                        <div class="account_login_form">
                                            <form wire:submit.prevent="updateUser" id="billingform">

                                                <div class="row">

                                                    <div class="col-lg-6 mb-20">
                                                        <label>Full Name <span>*</span></label>
                                                        <input value="Test" type="text" class="form-control   @error('name') border border-danger @enderror" wire:model="name">
                                                        @error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                                                    </div>

                                                    <div class="col-lg-6 mb-20">
                                                        <label>Phone<span>*</span></label>
                                                        <input type="text" class="@error('phone') border border-danger @enderror" wire:model="phone">
                                                        @error('phone') <span class="error text-danger">{{ $message }}</span> @enderror

                                                    </div>
                                                     <div class="col-lg-12">
                                                        <label> Email Address   <span>*</span></label>
                                                          <input type="text"  class="@error('email') border border-danger @enderror" wire:model="email" readonly>
                                                          @error('email') <span class="error text-danger">{{ $message }}</span> @enderror
                                                    </div>



                                                    <div class="col-12 mb-20">
                                                        <label>Billing Addresss  <span>*</span></label>
                                                        <input placeholder="House number and street name" class="@error('address') border border-danger @enderror" type="text" wire:model="address" >
                                                        @error('address') <span class="error text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                                <div class="payment_method">

                                                    <button class="btn btn-primary cart-button" type="submit">Update</button>

                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- my account end   -->
</div>
