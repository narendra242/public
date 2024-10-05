@extends('admin.layouts.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="container-full">
<!-- Content Header (Page header) -->
<!-- Main content -->
<section class="card">
<div class="row">

<div class="col-12">
<div class="box">
<div class="card-header">
<h3 class="card-title">Product Stock List <span class="badge badge-pill badge-danger"> {{ count($products) }} </span></h3>
</div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Image </th>
                    <th>Product En</th>
                    <th>Product Price </th>
                    <th>Quantity </th>
                    <th>Discount </th>
                    <th>Status </th>


                </tr>
            </thead>
            <tbody>
@foreach($products as $item)
<tr>
<td> <img src="<?php echo asset("product_images/$item->image")?>" style="width: 60px; height: 50px;">  </td>
<td style="width:25%;">{{ $item->title }}</td>
<td><i class="fa fa-rupee"></i> {{ $item->price }} </td>
<td>{{ $item->quantity }} Pic</td>
<td> 
@if($item->discount == NULL)
<span class="badge badge-pill badge-danger">No Discount</span>
@else
{{$item->discount}}% <span class="badge badge-pill badge-danger"><i class="fa fa-rupee"></i> {{$item->ProductDiscount($item->price,$item->discount)}} </span>
@endif
</td>
<td>
@if($item->status == 1)
<span class="badge badge-pill badge-success"> Active </span>
@else
<span class="badge badge-pill badge-danger"> InActive </span>
@endif

</td>

</tr>
@endforeach
</tbody>

</table>
</div>
    </div>
    <!-- /.box-body -->
    </div>
    <!-- /.box -->


</div>
<!-- /.col -->

</div>
<!-- /.row -->
</section>
<!-- /.content -->

</div>




@endsection