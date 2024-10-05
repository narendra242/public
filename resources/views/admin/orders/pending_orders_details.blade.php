@extends('admin.layouts.app')
@section('content')
<div class="card">
<div class="card-body">
<!-- Content Wrapper. Contains page content -->
<div class="container-full">
<!-- Content Header (Page header) -->
<div class="row">
<div class="col-sm-12 col-md-11">
<div class="card-header">
<h3 class="card-title">{{$head}}</h3>
</div>
</div>
</div>

<!-- Main content -->
<section class="content">
<div class="row">
<div class="col-md-6 col-12">
<div class="box box-bordered border-primary">
<div class="box-header with-border">
<h4 class="card-description pt-3 pl-3"><strong>Shipping Details</strong> </h4>
</div>


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
<th> District : </th>
<th> {{ $order->district->district_name }} </th>
</tr>

<tr>
<th> State : </th>
<th>{{ $order->state }} </th>
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
</div> <!--  // cod md -6 -->

<div class="col-md-6 col-12">
<div class="box box-bordered border-primary">
<div class="box-header with-border">
<h4 class="card-description pt-3 pl-3"><strong>Order Details</strong><span class="text-danger"> Invoice : {{ $order->invoice_no }}</span></h4>
</div>

<table class="table table-striped table-bordered">

@if(!empty($order->user->name))
<tr>
<th>  Name : </th>
<th> {{ $order->user->name }} </th>
</tr>
@endif

<tr>
<th>  Phone : </th>
<th> {{ $order->phone }} </th>
</tr>

<tr>
<th> Payment Type : </th>
<th> {{ $order->payment_method }} </th>
</tr>

<tr>
<th> Tranx ID : </th>
<th> {{ $order->transaction_id }} </th>
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

<tr>
<th></th>
<th>
@if($order->status == 'pending')
<a href="{{ route('admin.pending-confirm',$order->id) }}" class="btn btn-block btn-success" id="confirm">Confirm Order</a>

@elseif($order->status == 'confirm')
<a href="{{ route('admin.confirm.processing',$order->id) }}" class="btn btn-block btn-success" id="processing">Processing Order</a>

@elseif($order->status == 'processing')
<a href="{{ route('admin.processing.picked',$order->id) }}" class="btn btn-block btn-success" id="picked">Picked Order</a>

@elseif($order->status == 'picked')
<a href="{{ route('admin.picked.shipped',$order->id) }}" class="btn btn-block btn-success" id="shipped">Shipped Order</a>

@elseif($order->status == 'shipped')
<a href="{{ route('admin.shipped.delivered',$order->id) }}" class="btn btn-block btn-success" id="delivered">Delivered Order</a>

@endif
</th>
</tr>

</table>
</div>
</div> <!--  // cod md -6 -->

<div class="col-md-12 col-12">
<div class="box box-bordered border-primary">
<div class="box-header with-border">
</div>

<table class="table table-striped table-bordered">

<tbody>
<tr>
<td width="10%">
<label for=""><strong>Image</strong> </label>
</td>

<td width="20%">
<label for=""><strong> Product Name</strong> </label>
</td>

<td width="10%">
<label for=""><strong> Product Code</strong></label>
</td>


<td width="10%">
<label for=""><strong> Color </strong></label>
</td>

<td width="10%">
<label for=""><strong> Size</strong> </label>
</td>

<td width="10%">
<label for=""><strong> Quantity</strong> </label>
</td>

<td width="10%">
<label for=""><strong> Price </strong></label>
</td>
</tr>

@foreach($orderItem as $item)
<tr>
<td width="10%">
<label for="image"><img src="<?= (isset($item->product->image))?asset("product_images/".$item->product->image):asset('images/nocat_img.jpg') ?>" height="50px;" width="50px;"> </label>
</td>

<td width="20%">
<label for="product_title"> {{ $item->product->title }} <br>
 @if($item->user_name == NULL)
        Name:{{ $item->user_name }} 
        @endif</label>
</td>


<td width="10%">
<label for=""> {{ $item->product->product_code }}</label>
</td>

<td width="10%">
<label for="">
@if($item->color == NULL)
----
@else
{{ $item->color }}
@endif   
</label>
</td>

<td width="10%">
<label for="">
@if($item->size == NULL)
----
@else
{{ $item->size }}
@endif    
</label>
</td>

<td width="10%">
<label for=""> {{ $item->qty }}</label>
</td>

<td width="15%">
<label for=""><i class="fa fa-rupee"></i> {{$item->price }}  ( <i class="fa fa-rupee"></i> {{ $item->price * $item->qty}} ) </label>
</td>
</tr>
@endforeach
</tbody>

</table>
</div>
</div>  <!--  // cod md -12 -->

</div>
<!-- /. end row -->
</section>
<!-- /.content -->
</div>
</div>
</div>
@endsection