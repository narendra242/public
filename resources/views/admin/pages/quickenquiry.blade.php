@extends('admin.layouts.app')
@section('content')
<div class="card">
<div class="card-body">
<div class="row">
<div class="col-sm-12 col-md-12">
<div class="card-header">
<h3 class="card-title">{{$head}}</h3>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
<table class="table table-striped table-bordered dataTable" id="editable-datatable" style="cursor: pointer;" role="grid" aria-describedby="editable-datatable_info">
<thead>
<tr>
<th>SN</th>
<th>name</th>
<th>email</th>
<th>Phone</th>
<th>Action</th>
</tr>
</thead>
@if(!$datas->isEmpty())
@foreach($datas as $record)
<tr id="dels{{ $record->id }}">
<th scope="row">{{$loop->iteration}}</th>
<td><a class="text-red" title="{{ $record->messages }}">{{ $record->name }}</a></td>
<td>{{ $record->email }}</td>
<td>{{ $record->phone }}</td>
<td>
<a class="btn btn-danger btn-sm" title="Delete" id="delete_single"  data-url="enquiry/delete" data-id="{{ $record->id }}" data-token="{{ csrf_token() }}"> <i class="typcn typcn-delete"></i></a></td>
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
<!-- Modal -->

@endsection
