@extends('admin.layouts.app')
@section('content')
<div class="card">
<div class="card-body">
 
<div class="row">
<div class="col-sm-12 col-md-11">
<div class="card-header">
<h3 class="card-title">{{$head}}</h3>
</div>
</div>
<div class="col-sm-12 col-md-1">
<button type="button" onclick="window.location='{{ route('admin.general.create')}}'" class="btn btn-success float-right mb-2" title="Add"><i class="typcn typcn-plus"></i> </button>
</div>
</div>
        
    <div class="row">
    <div class="col-sm-12">
    <table class="table table-striped table-bordered dataTable" id="editable-datatable" style="cursor: pointer;" role="grid" aria-describedby="editable-datatable_info">
    <thead>
    <tr>
        <th>SN</th>
        <th>Title</th>
        <th>Status</th>
        <th>Image</th>
        <th>Action</th>
    </tr>
    </thead>
	@if(!$generals->isEmpty())
    @foreach($generals as $record)
    <tr id="dels{{ $record->id }}">
    <th scope="row">{{$loop->iteration}}</th>
    <td>{{ $record->title }}</td>
     <td><input data-id="{{$record->id}}" data-url="general/changeStatus" data-table="generals" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive"   <?php echo $record->status ? 'checked' : '';?> ></td>
    <td> @if(!empty($record->image))
    <img width="50" src="<?php echo asset("general_images/$record->image")?>">
    @else
    <img width="50" src="<?php echo asset("images/no-image-available.jpg")?>"> 
    @endif</td>
    <td>
    <a  class="btn btn-info btn-sm" href="{{ route('admin.general.edit', ['id' => $record->id]) }}"> <i class="typcn typcn-edit"></i></a> 
    <a class="btn btn-danger btn-sm" id="delete_single"  data-url="general/delete" data-id="{{ $record->id }}" data-token="{{ csrf_token() }}"> <i class="typcn typcn-delete"></i></a></td>
    </tr>
    @endforeach
    @else
   <tr>
   <td  colspan="5">No record found</td>
   </tr>
   @endif
    </tbody>

    </table>
    </div>
    </div>
    </div>
    </div>
@endsection
 