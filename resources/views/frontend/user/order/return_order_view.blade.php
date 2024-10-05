@extends('layouts.nav')
@section('content')
<div class="breadcrumb_section bg_gray page-title-mini">
<div class="container"><!-- STRART CONTAINER -->
<div class="row align-items-center">
<div class="col-md-6">
<div class="page-title">
<h1>Return Orders</h1>
</div>
</div>
<div class="col-md-6">
<ol class="breadcrumb justify-content-md-end">
<li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li> 
<li class="breadcrumb-item active">Return Orders</li>
</ol>
</div>
</div>
</div><!-- END CONTAINER-->
</div>



<div class="main_content">
<!-- START SECTION SHOP -->
<div class="section">
<div class="container">
<div class="row">
<div class="col-lg-3 col-md-4">
@include('frontend.common.user_sidebar')    
</div>
<div class="col-lg-9 col-md-8">
<div class="card">
<div class="card-header">
<h3>All Return Order List</h3>
</div>
<div class="table-responsive">
<table class="table table-striped table-bordered">
<tbody>

<tr style="background: #e2e2e2;">
<td>
<label for=""> Date</label>
</td>

<td>
<label for=""> Total</label>
</td>

<td>
<label for=""> Payment</label>
</td>


<td>
<label for=""> Invoice</label>
</td>

<td>
<label for=""> Order Reason</label>
</td>

<td>
<label for=""> Order Status </label>
</td>

</tr>


@foreach($orders as $order)
<tr>
<td>
<label for=""> {{ $order->order_date }}</label>
</td>

<td>
<label for=""><i class="fa fa-rupee"></i>{{$order->amount }}</label>
</td>


<td>
<label for=""> {{ $order->payment_method }}</label>
</td>

<td>
<label for=""> {{ $order->invoice_no }}</label>
</td>

<td>
<label for=""> {{ $order->return_reason }}</label>
</td>

<td>
<label for="">
@if($order->return_order == 0)
<span class="badge badge-pill badge-danger" style="background: #418DB9;"> No Return Request </span>
@elseif($order->return_order == 1)
<span class="badge badge-pill badge-danger" style="background: #800000;"> Pedding </span>
<span class="badge badge-pill badge-danger" style="background:red;">Return Requested </span>

@elseif($order->return_order == 2)
  <span class="badge badge-pill badge-danger" style="background: #008000;">Success </span>
  @endif

</label>
</td>

</tr>
@endforeach





</tbody>

</table>

</div>
</div>
</div>
</div>
</div>
</div>
<!-- END SECTION SHOP -->

</div>
<!-- END MAIN CONTENT -->
 
@endsection