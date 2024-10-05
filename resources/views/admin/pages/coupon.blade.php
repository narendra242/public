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
<button type="button" onclick="window.location='{{ route('admin.coupon.create')}}'" class="btn btn-success float-right mb-2" title="Add"><i class="typcn typcn-plus"></i> </button>
</div>
</div>
<div class="row">
<div class="col-sm-12 table-responsive">
<table class="table table-striped table-bordered dataTable" id="editable-datatable" style="cursor: pointer;" role="grid" aria-describedby="editable-datatable_info">
<thead>
<tr>
<th>SN</th>
<th>Coupon Name</th>
<th>Coupon Discount(%)</th>
<th>Coupon Validity</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>
@if(!$datas->isEmpty())
@foreach($datas as $record)
<tr id="dels{{ $record->id }}">
<th scope="row">{{$loop->iteration}}</th>
<td>{{ $record->coupon_name }}</td>
<td>{{ $record->coupon_discount }}%</td>
<td>{{Carbon\Carbon::parse($record->coupon_validity)->format('D, d F Y')}}</td>
<td>@if($record->coupon_validity >= Carbon\Carbon::now()->format('Y-m-d'))
<span class="btn btn-success btn-sm rounded-pill waves-light">Valid</span>
@else
<span class="btn btn-danger btn-sm  rounded-pill waves-effect waves-light">InValid</span>
@endif </td>
<td>
<a class="btn btn-info btn-sm" href="{{ route('admin.coupon.edit', ['id' => $record->id]) }}"> <i class="typcn typcn-edit"></i></a> 
<a class="btn btn-danger btn-sm" id="delete_single"  data-url="coupon/delete" data-id="{{ $record->id }}" data-token="{{ csrf_token() }}"> <i class="typcn typcn-delete"></i></a></td>
</tr>
@endforeach
@else
<tr>
<td  colspan="6">No record found</td>
</tr>
@endif
</tbody>
</table>
</div>
</div>
</div>
</div>
@endsection
