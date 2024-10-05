@extends('layouts.nav')
@section('content')
<!-- Breadcrumb Section Begin -->
<div class="breadcrumb-container">  
<div class="wrapper">
<ol class="breadcrumb">
<li class="breadcrumb-item active"><a href="{{route('mycart')}}">Cart</a></li>
<li class="breadcrumb-item active">Cash on Delivary</li>
</ol>
</div>
</div>



<div class="body-content">
<div class="container">
<div class="checkout-box ">
<h2>Your order has been placed!</h2>
<p>Your order has been successfully processed!<br>
Please direct any questions you have to the store owner.<br>
Thanks for shopping with us online! </p>      
</div><!-- /.checkout-box -->
</div><!-- /.container -->
</div><!-- /.body-content -->

@endsection