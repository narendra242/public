@extends('admin.layouts.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="container-full">
<!-- Content Header (Page header) -->

<!-- Main content -->
<section class="card">
<div class="row">

<div class="col-12">

<div class="card-body">
<div class="card-header">
<h3 class="card-title">Publish All Review</h3>
</div>
    <!-- /.box-header -->
    <div class="box-body">
    <div class="table-responsive">
    <table id="example1" class="table table-bordered table-striped">
    <thead>
    <tr>
    <th>Name/Email/Phone  </th>
    <th>Photo</th>
    <th>Product</th>
    <th>comments</th>
    <th>Status </th>
    <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($review as $item)
    <tr>
    <td>
    <b>Name:</b> {{ $item->name }}<br><br>
    <b>Email:</b> {{ $item->email }}<br><br>
    <b>Phone:</b> {{ $item->phone }}
    </td>
    <td>  
    @if(!empty($item->photo))
    <img width="50" src="<?php echo asset("uploads/$item->photo")?>">
    @else
    <img width="80" src="<?php echo asset("images/no-image-available.jpg")?>"> 
    @endif </td>
    <td> {{ $item->product->title }}  </td>
    <td> {{ $item->comments }}  </td>
    
    <td>
    @if($item->status == 0)
    <span class="badge badge-pill badge-primary">Pending </span>
    @elseif($item->status == 1)
    <span class="badge badge-pill badge-success">Publish </span>
    @endif
    
    </td>

    <td width="25%">
    <a href="{{ route('admin.delete.review',$item->id) }}" class="btn btn-danger" id="delete">Delete </a>
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