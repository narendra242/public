@extends('layouts.nav')
@section('content')
 
<section class="breadcrumb-option">
<div class="container">
<div class="row">
<div class="col-lg-12">
<div class="breadcrumb__hidden">
<div class="breadcrumb__links">
<a href="{{url('/')}}">Home</a>
<span>Online Payment</span>
</div>
</div>
</div>
</div>
</div>
</section>
<div class="body-content">
<div class="container">

<div class="checkout-box ">
 <div class="row">
<div class="col-md-6">
@if($message = Session::get('error'))
<div class="alert alert-danger alert-dismissible fade in" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">×</span>
</button>
<strong>Error!</strong> {{ $message }}
</div>
@endif

@if($message = Session::get('success'))
<div class="alert alert-success alert-dismissible fade {{ Session::has('success') ? 'show' : 'in' }}" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">×</span>
</button>
<strong>Success!</strong> {{ $message }}
</div>
@endif
{!! Session::forget('success') !!}
<!-- checkout-progress-sidebar -->

<div class="checkout-progress-sidebar ">
<div class="panel-group">
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="unicase-checkout-title">Your Shopping Amount</h4>
</div>

<div class="">
<ul class="nav nav-checkout-progress list-unstyled">
<li>
@if(Session::has('coupon'))
<strong>SubTotal:</strong> ${{$cartTotal}} <hr>
<strong>Coupon Name: </strong>{{session()->get('coupon')['coupon_name']}}
({{session()->get('coupon')['coupon_discount']}}%)
<hr>
<strong>Coupon Amount:</strong> <i class="fa fa-{{$data['curIcons']}}"></i> {{session()->get('coupon')['discount_amount']}}
<hr>
<strong>Grand Total:</strong> <i class="fa fa-{{$data['curIcons']}}"></i> {{session()->get('coupon')['total_amount']}}
<hr>
@else
<strong>SubTotal: </strong><i class="fa fa-{{$data['curIcons']}}"></i>{{$cartTotal}} <hr>
<strong>SubTotal: </strong> <i class="fa fa-{{$data['curIcons']}}"></i>{{$cartTotal}} 
@endif
</li>
</ul>		
</div>
</div>
</div>
</div> 
<!-- checkout-progress-sidebar -->				
</div>

<div class="col-md-6">
<!-- checkout-progress-sidebar -->
<div class="checkout-progress-sidebar ">
<div class="panel-group">
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="unicase-checkout-title">Select Payment Method</h4>
</div>
<form action="{{ route('razorpay.payment.store') }}" method="POST" >
@csrf 
<script src="https://checkout.razorpay.com/v1/checkout.js"
data-key="{{ env('RAZORPAY_KEY') }}"
data-amount="{{$data['amount']}}"
data-buttontext="Pay Razorpay"
data-name="{{$data['name']}}"
data-email="{{$data['email']}}"
data-phone="{{$data['phone']}}"
data-post_code="{{$data['post_code']}}"
data-division="{{$data['division']['division_name']}}"
data-district="{{$data['district']['district_name']}}"
data-state="{{$data['state']['state_name']}}"
data-notes="Razorpay payment"
data-image="{{asset('images/logo.png')}}"
data-prefill.name="{{$data['name']}}"
data-prefill.email="{{$data['email']}}"
data-theme.color="#ff7529">
</script>
</form>
</div>
</div>
</div> 
 <!-- checkout-progress-sidebar -->				
</div>

</div><!-- /.row -->
</div><!-- /.checkout-box -->

</div><!-- /.container -->
</div><!-- /.body-content -->
  
@endsection