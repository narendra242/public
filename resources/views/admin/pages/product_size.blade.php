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
<button type="button" onclick="window.location='{{ route('admin.size.create')}}'" class="btn btn-success float-right mb-2" title="Add"><i class="typcn typcn-plus"></i> </button>
</div>
</div>

<div class="row">
<div class="col-sm-12 table-responsive">
<table class="table table-striped table-bordered dataTable" id="editable-datatable" style="cursor: pointer;" role="grid" aria-describedby="editable-datatable_info">
<thead>
<tr>
<th>SN</th>
<th>Name</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>
@if(!$datas->isEmpty())
@foreach($datas as $record)
<tr id="dels{{ $record->id }}">
<th scope="row">{{$loop->iteration}}</th>
<td>{{ $record->title }}</td>
<td><input data-id="{{$record->id}}" data-url="size/changeStatus" data-table="sizes" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive"   <?php echo $record->status ? 'checked' : '';?> ></td>

<td>
<a class="btn btn-info btn-sm" href="{{ route('admin.size.edit', ['id' => $record->id]) }}"> <i class="typcn typcn-edit"></i></a> 
<a class="btn btn-danger btn-sm" id="delete_single"  data-url="size/delete" data-id="{{ $record->id }}" data-token="{{ csrf_token() }}"> <i class="typcn typcn-delete"></i></a></td>
</tr>
@endforeach
@else
<tr>
<td  colspan="4">No record found</td>
</tr>
@endif
</tbody>

</table>
</div>
</div>
</div>
</div>
@endsection
