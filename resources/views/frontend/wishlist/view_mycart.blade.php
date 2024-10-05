@extends('layouts.nav')
@section('content')
<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini">
<div class="container"><!-- STRART CONTAINER -->
<div class="row align-items-center">
<div class="col-md-6">
<div class="page-title">
<h1>Shopping Cart</h1>
</div>
</div>
<div class="col-md-6">
<ol class="breadcrumb justify-content-md-end">
<li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li> 
<li class="breadcrumb-item active">Cart</li>
</ol>
</div>
</div>
</div><!-- END CONTAINER-->
</div>
<!-- END SECTION BREADCRUMB -->
<!-- END MAIN CONTENT -->
<div class="main_content">
<!-- START SECTION SHOP -->
<div class="section">
<div class="container">
<div class="row">
<div class="col-12">
<div class="table-responsive shop_cart_table">
<table class="table">
<thead>
<tr>
<th class="product-thumbnail">&nbsp;</th>
<th class="product-name">Product</th>
<th class="product-price">Price</th>
<th class="product-quantity">Quantity</th>
<th class="product-subtotal">Total</th>
<th class="product-remove">Remove</th>
</tr>
</thead>
<tbody id="cartPage"></tbody>
<tfoot>
<tr>
<td colspan="6" class="px-0">
<div class="row g-0 align-items-center">

<div class="col-lg-4 col-md-6 mb-3 mb-md-0">
@if(Session::has('coupon'))
@else
<div class="coupon field_form input-group" id="couponField">
<input type="text" id="coupon_name" class="form-control form-control-sm" placeholder="Enter Coupon Code..">
<div class="input-group-append">
<button class="btn btn-fill-out btn-sm" type="submit" onclick="applyCoupon()">Apply Coupon</button>
</div>
</div>
@endif
</div>
<div class="col-lg-8 col-md-6  text-start  text-md-end">
<button onclick="cartAllRemove()" class="btn btn-line-fill btn-sm" type="submit">Remove All</button>
</div>
</div>
</td>
</tr>
</tfoot>
</table>
</div>
</div>
</div>
<div class="row">
<div class="col-12">
<div class="medium_divider"></div>
<div class="divider center_icon"><i class="ti-shopping-cart-full"></i></div>
<div class="medium_divider"></div>
</div>
</div>
<div class="row">
<div class="col-md-6"></div>
<div class="col-md-6">
<div class="border p-3 p-md-4">
<div class="heading_s1 mb-3">
<h6>Cart Totals</h6>
</div>
<div class="table-responsive">
<table class="table">
<tbody id="couponCalField">
</tbody>
</table>
</div>
<a href="{{route('checkout')}}" class="btn btn-fill-out">Proceed To CheckOut</a>
</div>
</div>
</div>
</div>
</div>
<!-- END SECTION SHOP -->

</div>
<!-- END MAIN CONTENT -->
 
 
@endsection