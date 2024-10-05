@php
$id=Auth::user()->id;
$user = App\Models\User::find($id);    
@endphp
<div class="dashboard_menu">
<ul class="nav nav-tabs flex-column" role="tablist">
<li class="nav-item">
<a class="nav-link active" id="dashboard-tab" href="{{route('dashboard')}}" role="tab" aria-controls="dashboard" aria-selected="false"><i class="ti-layout-grid2"></i>Dashboard</a>
</li>

<li class="nav-item">
<a class="nav-link" id="address-tab" href="{{route('user.profile')}}" role="tab" aria-controls="address" aria-selected="true"><i class="ti-location-pin"></i>My Profile</a>
</li>

<li class="nav-item">
<a class="nav-link" id="address-tab" href="{{route('change.password')}}" role="tab" aria-controls="address" aria-selected="true"><i class="ti-location-pin"></i>Change Password</a>
</li>

<li class="nav-item">
<a class="nav-link" id="orders-tab" href="{{route('my.orders')}}" role="tab" aria-controls="orders" aria-selected="false"><i class="ti-shopping-cart-full"></i>Orders</a>
</li>

<!--<li class="nav-item">-->
<!--<a class="nav-link" id="account-detail-tab" href="{{ route('return.order.list') }}" role="tab" aria-controls="account-detail" aria-selected="true"><i class="ti-id-badge"></i>Return Orders</a>-->
<!--</li>-->

<!--<li class="nav-item">-->
<!--<a class="nav-link" id="account-detail-tab" href="{{ route('cancel.orders') }}" role="tab" aria-controls="account-detail" aria-selected="true"><i class="ti-id-badge"></i>Cancel Orders</a>-->
<!--</li>-->

<li class="nav-item">
<a class="nav-link" href="{{ route('user.logout') }}"><i class="ti-lock"></i>Logout</a>
</li>
</ul>
</div>
 