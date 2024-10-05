@extends('admin.layouts.app')
@section('content')
<div class="card">
<div class="card-body">
<form action="{{ route('admin.product') }}" method="GET">
<div class="row">
<div class="col-md-3 pull-left">    
<select type="text" name="cat_id" class="form-control p-2">
<option value="0">None</option>

@if($categories)
@foreach($categories as $category) 
<?php $dash=''; ?>
<option {{GeneralHelper::match($category->id,@Request::get('cat_id'))}} value="{{$category->id}}">{{$category->title}}</option>
@if(count($category->subcategory))
@include('admin/pages/subCategoryList-option',['subcategories' => $category->subcategory])
@endif
@endforeach
@endif
</select>
</div>
<div class="col-md-2 pull-left">
<input type="submit" class="btn btn-danger" value="Filter">
</div>

<div class="col-sm-7">
 <button type="button" onclick="window.location='{{ route('admin.product.create')}}'" class="btn btn-success float-right mb-2"><i class="typcn typcn-plus"></i> </button>
</div>

<div class="col-sm-12">
<div class="card-header">
<h3 class="card-title">{{$head}}</h3>
</div>
</div>
</div>
</form>
  <div class="row">
   <div class="col-sm-12">
    <table class="table table-striped table-bordered dataTable" id="editable-datatable" style="cursor: pointer;" role="grid" aria-describedby="editable-datatable_info">
    <thead>
    <tr>
        <th>SN</th>
        <th>Product Name</th>
        <th>Product Price</th>
        <th>Quantity</th>
        <th>Discount</th>
        <th>Status</th>
        <th>Image</th>
        <th>Action</th>
    </tr>
    </thead>
    @if(!$datas->isEmpty())
    @foreach($datas as $record)
    <tr id="dels{{ $record->id }}">
    <th scope="row">{{$loop->iteration}}</th>
    <td style="width: 25%;">{{ $record->title }}</td>
    <td><i class="fa fa-rupee"></i> {{$record->price }}</td>
    <td>{{ $record->quantity }}</td>
    <td>
    @if($record->discount == NULL)
    <span class="badge badge-pill badge-danger">No Discount</span>
    @else
    {{$record->discount}}%  <span class="badge badge-pill badge-success"><i class="fa fa-rupee"></i> {{$record->ProductDiscount($record->price,$record->discount)}}</span>
    @endif
  </td>
     <td><input data-id="{{$record->id}}" data-url="product/changeStatus" data-table="products" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive"   <?php echo $record->status ? 'checked' : '';?> ></td>
    <td> @if(!empty($record->image))
    <img width="50" src="<?php echo asset("product_images/$record->image")?>">
    @else
    <img width="80" src="<?php echo asset("images/no-image-available.jpg")?>"> 
    @endif</td>
    <td>
    <a class="btn btn-info btn-sm" title="Edit Product" href="{{ route('admin.product.edit', ['id' => $record->id]) }}"> <i class="typcn typcn-edit"></i></a> 
    <a class="btn btn-danger btn-sm" data-toggle="modal" data-id="{{ $record->id }}" id="serviceinfos" data-url="{{ route('admin.product.getimages', $record->id) }}" > <i class="typcn typcn-image"></i></a>  
    <a class="btn btn-danger btn-sm" title="Delete" id="delete_single"  data-url="product/delete" data-id="{{ $record->id }}" data-token="{{ csrf_token() }}"> <i class="typcn typcn-delete"></i></a></td>
    </tr>
    @endforeach
    @else
   <tr>
   <td  colspan="8">No record found</td>
   </tr>
   @endif
    </tbody>

    </table>
    </div>
    </div>
    {!! $datas->links('pagination::bootstrap-4')!!}
    </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="empModal" role="dialog">
          <div class="modal-dialog">
          <!-- Modal content-->
           <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Images</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
       
            </div>
            <div class="modal-footer">
             <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
           </div>
          </div>
         </div>
 
    @endsection
 