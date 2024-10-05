@extends('admin.layouts.app')

@section('content')

<div class="card">

<div class="card-body">

<div class="row">

<div class="col-sm-12 col-md-11">

<div class="card-header">

<h3 class="card-title">{{$head}} <span class="badge badge-pill badge-danger"> {{ count($users) }} </span></h3>

</div>

</div>

</div>



<div class="row">

<div class="col-sm-12 table-responsive">

<table class="table table-striped table-bordered dataTable" id="editable-datatable" style="cursor: pointer;" role="grid" aria-describedby="editable-datatable_info">

<thead>

<tr>

<th>SN</th>

<th>Image</th>

<th>Name</th>

<th>Email</th>

<th>Phone</th>
<th>Status</th>
<th>Action</th>
</tr>

</thead>

@if(!$users->isEmpty())

@foreach($users as $record)

<tr id="dels{{ $record->id }}">

<th scope="row">{{ $record->id }}</th>

<td>  <img width="50" src="{{(!empty($record->profile_photo_path))?url('uploads/user_images/'.$record->profile_photo_path):url('uploads/no_image.jpg')}}"></td>

<td>{{ $record->name }}</td>

<td>{{ $record->email }}</td>

<td>{{ $record->phone }}</td>

<td>
@if($record->UserOnline())
<span class="badge badge-pill badge-success">Active Now</span>
@else
<span class="badge badge-pill badge-danger">{{ Carbon\Carbon::parse($record->last_seen)->diffForHumans() }}</span>
@endif
</td>

<td>

<a class="btn btn-info btn-sm" href=""> <i class="typcn typcn-edit"></i></a>

<a class="btn btn-danger btn-sm" id="delete_singles"  data-url="" data-id="{{ $record->id }}" data-token="{{ csrf_token() }}"> <i class="typcn typcn-delete"></i></a>

</td>

</tr>

@endforeach

@else

<tr>

<td colspan="7">No record found</td>

</tr>

@endif

</tbody>



</table>

</div>

</div>

</div>

</div>

@endsection

