@extends('layouts.nav')
@section('content')
<div class="breadcrumb_section bg_gray page-title-mini">
<div class="container"><!-- STRART CONTAINER -->
<div class="row align-items-center">
<div class="col-md-6">
<div class="page-title">
<h1>Order Detail</h1>
</div>
</div>
<div class="col-md-6">
<ol class="breadcrumb justify-content-md-end">
<li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li> 
<li class="breadcrumb-item active">Order Detail</li>
</ol>
</div>
</div>
</div><!-- END CONTAINER-->
</div>
<!-- Breadcrumb Section Begin -->
<div class="main_content">
  <!-- START SECTION SHOP -->
  <div class="section">
  <div class="container">
  <div class="row">
  <div class="col-lg-3 col-md-4">
  @include('frontend.common.user_sidebar')    
  </div>
  <div class="col-lg-9 col-md-8">
  <div class="row">
  <div class="col-md-5">
  <div class="card">
  <div class="card-header"><h4>Shipping Details</h4></div>
  <div class="card-body" style="background: #E9EBEC;">
  <table class="table table-striped table-bordered">
  <tr>
  <th> Shipping Name : </th>
    <th> {{ $order->name }} </th>
  </tr>

  <tr>
  <th> Shipping Phone : </th>
    <th> {{ $order->phone }} </th>
  </tr>

  <tr>
  <th> Shipping Email : </th>
    <th> {{ $order->email }} </th>
  </tr>

  <tr>
  <th> Division : </th>
    <th> {{ $order->division->division_name }} </th>
  </tr>

  <tr>
  <th> District : </th>
    <th> {{ $order->district->district_name }} </th>
  </tr>

  <tr>
  <th> State : </th>
    <th>{{ $order->state->state_name }} </th>
  </tr>

  <tr>
  <th> Post Code : </th>
    <th> {{ $order->post_code }} </th>
  </tr>

  <tr>
  <th> Order Date : </th>
    <th> {{ $order->order_date }} </th>
  </tr>

  </table>


  </div>

  </div>

  </div> <!-- // end col md -5 -->

  <div class="col-md-5">
    <div class="card">
      <div class="card-header"><h4>Order Details
<span class="text-danger"> Invoice : {{ $order->invoice_no }}</span></h4>
      </div>
     <div class="card-body" style="background: #E9EBEC;">
     <table class="table table-striped table-bordered">
        <tr>
          <th>  Name : </th>
           <th> {{ $order->user->name }} </th>
        </tr>

         <tr>
          <th>  Phone : </th>
           <th> {{ $order->user->phone }} </th>
        </tr>

         <tr>
          <th> Payment Type : </th>
           <th> {{ $order->payment_method }} </th>
        </tr>


         <tr>
          <th> Invoice  : </th>
           <th class="text-danger"> {{ $order->invoice_no }} </th>
        </tr>

         <tr>
          <th> Order Total : </th>
           <th><i class="fa fa-rupee"></i> {{ $order->amount }} </th>
        </tr>

        <tr>
          <th> Order : </th>
           <th>
            <span class="badge badge-pill badge-danger" style="background: #418DB9;">{{ $order->status }} </span> </th>
        </tr>

       </table>


     </div>

    </div>

  </div> <!-- // 2ND end col md -5 -->
</div>  

<div class="row">
  <div class="col-md-12 mt-5">
  
  <div class="table-responsive">
    <table class="table table-striped table-bordered">
      <tbody>
  
        <tr style="background: #e2e2e2;">
          <td>
            <label for=""> Image</label>
          </td>
  
          <td>
            <label for=""> Product Name </label>
          </td>
  
          <td>
            <label for=""> Product Code</label>
          </td>
  
  
          <td>
            <label for=""> Color </label>
          </td>
  
           <td>
            <label for=""> Size </label>
          </td>
  
           <td>
            <label for=""> Quantity </label>
          </td>
  
          <td>
            <label for=""> Price </label>
          </td>
          </tr>
  
  
        @foreach($orderItem as $item)
          <tr>
          <td>
            <label for=""><img src="<?= (isset($item->product->image))?asset("product_images/".$item->product->image):asset('images/nocat_img.jpg') ?>" height="50px;" width="50px;"> </label>
          </td>
  
          <td>
            <label for=""> {{ $item->product->title }}</label>
          </td>
  
  
           <td>
            <label for=""> {{ $item->product->product_code }}</label>
          </td>
  
          <td>
            <label for=""> 
          @if($item->color == NULL)
          ----
          @else
          {{ $item->color }}
          @endif
            </label>
          </td>
  
          <td>
            <label for="">   
          @if($item->size == NULL)
          ----
          @else
          {{ $item->size }}
          @endif</label>
          </td>
  
           <td >
            <label for=""> {{ $item->qty }}</label>
          </td>
  
          <td width="15%">
          <label for=""> <i class="fa fa-rupee"></i>{{ $item->price }}  ( <i class="fa fa-rupee"></i>{{ $item->price * $item->qty}} ) </label>
          </td>
  
        </tr>
        @endforeach
  
      </tbody>
  
    </table>
  
  </div>
  
  </div> <!-- / end col md 8 -->
  </div>
  @if($order->status !== "delivered")
@else
@php
$order = App\Admin\Models\Order::where('id',$order->id)->where('return_reason','=',NULL)->first();
@endphp
@if($order)
<form action="{{ route('return.order',$order->id) }}" method="post">
@csrf
<div class="form-group">
<label for="label"> Order Return Reason:</label>
<textarea name="return_reason" id="" class="form-control" cols="30" rows="05">Return Reason</textarea>
</div>
<button type="submit" class="btn btn-danger">Order Return</button>
</form>
@else
<span class="badge badge-pill badge-warning" style="background: red">You Have send return request for this product</span>
@endif
@endif
<br><br>
</div>
  </div>
  </div>
  </div>
  <!-- END SECTION SHOP -->
  
  </div>
  <!-- END MAIN CONTENT -->


 
@endsection