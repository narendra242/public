@extends('layouts.nav')
@section('content')
<div class="breadcrumb_section bg_gray page-title-mini">
<div class="container"><!-- STRART CONTAINER -->
<div class="row align-items-center">
<div class="col-md-6">
<div class="page-title">
<h1>Orders</h1>
</div>
</div>
<div class="col-md-6">
<ol class="breadcrumb justify-content-md-end">
<li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li> 
<li class="breadcrumb-item active">Orders</li>
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
    <h3>My Orders</h3>
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
    <label for=""> Order</label>
    </td>
    <td>
    <label for=""> Action </label>
    </td>
    </tr>
    @foreach($orders as $order)
    <tr>
    <td>
    <label for=""> {{ $order->order_date }}</label>
    </td>
    <td>
    <label for=""> <i class="fa fa-rupee"></i> {{ $order->amount }}</label>
    </td>
    <td>
    <label for=""> {{ $order->payment_method }}</label>
    </td>
    <td>
    <label for=""> {{ $order->invoice_no }}</label>
    </td>
    <td>
    <label for="">
    @if($order->status == 'pending')
    <span class="badge badge-pill badge-danger" style="background: #800080;"> Pending </span>
    @elseif($order->status == 'confirm')
    <span class="badge badge-pill badge-danger" style="background: #0000FF;"> Confirm </span>
    @elseif($order->status == 'processing')
    <span class="badge badge-pill badge-danger" style="background: #FFA500;"> Processing </span>
    @elseif($order->status == 'picked')
    <span class="badge badge-pill badge-danger" style="background: #808000;"> Picked </span>
    @elseif($order->status == 'shipped')
    <span class="badge badge-pill badge-danger" style="background: #808080;"> Shipped </span>
    @elseif($order->status == 'delivered')
    <span class="badge badge-pill badge-danger" style="background: #008000;"> Delivered </span>
    @if($order->return_order == 1)
    <span class="badge badge-pill badge-danger" style="background:red;">Return Requested </span>
    @endif
    @else
    <span class="badge badge-pill badge-danger" style="background: #FF0000;"> Cancel </span>
    @endif
    </label>
    </td>
    <td>
    <a href="{{ url('user/order_details/'.$order->id ) }}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> View</a>
    <a target="_blank" href="{{ url('user/invoice_download/'.$order->id ) }}" class="btn btn-sm btn-danger"><i class="fa fa-download mt-2" style="color: white;"></i> Invoice </a>
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
 
@endsection