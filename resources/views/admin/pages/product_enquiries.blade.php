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
</div>

<div class="row">
<div class="col-sm-12">
<table class="table table-striped table-bordered dataTable" id="editable-datatable" style="cursor: pointer;" role="grid" aria-describedby="editable-datatable_info">
<thead>
<tr>
<th width="130">SN</th>
<th width="133">Name</th>
<th width="132">Email</th>
<th width="138">Phone</th>
<th width="122">City</th>
<th width="144">Page Url</th>
<th width="167">Message</th>
<th width="43">Action</th>
</tr>
</thead>
@if(!$datas->isEmpty())
@foreach($datas as $record)
<tr id="dels{{ $record->id }}">
<th scope="row">{{$loop->iteration}}</th>
<td>{{ $record->name }}</td>
<td>{{ $record->email }}</td>
<td>{{ $record->phone }}</td>
<td>{{ $record->city }}</td>
<td><a href="{{ $record->page_url }}"><i class="typcn typcn-globe"></i>Click here</a></td>
<td>{{ $record->messages }}</td>
<td>
<a class="btn btn-danger btn-sm" id="delete_single"  data-url="product/enquirydelete" data-id="{{ $record->id }}" data-token="{{ csrf_token() }}"> <i class="typcn typcn-delete"></i></a></td>
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
@endsection
