@extends('layouts.nav')
@section('content')
<div class="breadcrumb_section bg_gray page-title-mini">
<div class="container"><!-- STRART CONTAINER -->
<div class="row align-items-center">
<div class="col-md-6">
<div class="page-title">
<h1>Cancel Order</h1>
</div>
</div>
<div class="col-md-6">
<ol class="breadcrumb justify-content-md-end">
<li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li> 
<li class="breadcrumb-item active">Cancel Order</li>
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
<h3 class="card-title">Cancel Order</h3>
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


      @forelse($orders as $order)
      <tr>
        <td><label for="label"> {{ $order->order_date }}</label></td>
        <td><label for="label"> ${{ $order->amount }}</label></td>
        <td><label for="label"> {{ $order->payment_method }}</label></td>
        <td><label for="label"> {{ $order->invoice_no }}</label></td>
        <td><label for="label"> <span class="badge badge-pill badge-warning" style="background: #418DB9;">{{ $order->status }} </span> </label></td>
        <td><a href="{{ url('user/order_details/'.$order->id ) }}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> View</a> <a target="_blank" href="{{ url('user/invoice_download/'.$order->id ) }}" class="btn btn-sm btn-danger" style="margin-top: 5px;"><i class="fa fa-download" style="color: white;"></i> Invoice </a></td>
      </tr>
        @empty
        <tr>
        <td colspan="6"> 
        <h2 class="text-danger small">Order Not Found</h2>
        </td>
        </tr>
        @endforelse
      
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