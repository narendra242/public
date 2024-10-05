@extends('admin.layouts.app')
@section('content')
@php
$date =  Carbon\Carbon::now()->format('d F Y');
$today = App\Models\Order::where('order_date',$date)->sum('amount');
$month = date('F');
$month = App\Models\Order::where('order_month',$month)->sum('amount');
$year = date('Y');
$year = App\Models\Order::where('order_year',$year)->sum('amount');
$pending = App\Models\Order::where('status','pending')->get();
@endphp
<i class="typcn typcn-delete-outline" id="bannerClose" style="display: none;"></i>
<div class="row">
<div class="col-md-3 grid-margin stretch-card">
<div class="card">
<div class="card-body d-flex flex-column justify-content-between"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
<div class="d-flex justify-content-between align-items-center mb-2">
<p class="mb-0 text-muted">Today's Sale</p>
<p class="mb-0 text-muted"> </p>
</div>
<h4><i class="fa fa-rupee"></i> {{$today}}</h4>
<canvas id="balance-chart" height="80"></canvas>
</div>
</div>
</div>
<div class="col-md-3 grid-margin stretch-card">
<div class="card">
<div class="card-body d-flex flex-column justify-content-between"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
<div class="d-flex justify-content-between align-items-center mb-2">
<p class="mb-0 text-muted">Monthly Sale</p>
<p class="mb-0 text-muted"> </p>
</div>
<h4><i class="fa fa-rupee"></i> {{$month}}</h4>
<canvas id="sales-chart-a" class="mt-auto" height="65"></canvas>
</div>
</div>
</div>
<div class="col-md-3 grid-margin stretch-card">
<div class="card">
<div class="card-body d-flex flex-column justify-content-between"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
<div class="d-flex justify-content-between align-items-center mb-2">
<p class="mb-0 text-muted">Yearly Sale</p>
<p class="mb-0 text-muted"></p>
</div>
<h4><i class="fa fa-rupee"></i> {{$year}} </h4>
<canvas id="sales-chart-b" class="mt-auto" height="38"></canvas>
</div>
</div>
</div>
<div class="col-md-3 grid-margin stretch-card">
<div class="card">
<div class="card-body d-flex flex-column justify-content-between"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
<div class="d-flex justify-content-between align-items-center mb-2">
<p class="mb-0 text-muted">Pending Orders</p>
<p class="mb-0 text-muted">  </p>
</div>
<h4>{{ count($pending) }}</h4>
<canvas id="memory-chart" class="mt-auto"></canvas>
</div>
</div>
</div>
</div>
@php
$orders = App\Models\Order::where('status','pending')->orderBy('id','DESC')->get();
@endphp
<div class="row">
<div class="col-md-12">
<div class="card">
<div class="card-header">
<h3 class="card-title">Recent All Orders</h3>
</div>
<div class="table-responsive pt-3">
<table class="table table-striped project-orders-table">
<thead>
<tr>
<th class="ml-5">ID</th>
<th>Date</th>
<th>Invoice</th>
<th>Amount</th>
<th>Payment	</th>
<th>Status</th>
<th>Process</th>
</tr>
</thead>
<tbody>
@foreach($orders as $item)
<tr id="dels{{ $item->id }}">
<td>#{{$loop->iteration}}</td>
<td> <span class="text-green font-weight-600 d-block font-size-16"> 
    {{ $item->order_date }}
</span> </td>
<td>{{ $item->invoice_no }}</td>
<td>{{ $item->amount }}</td>
<td>{{ $item->payment_method }} ({{ $item->payment_type }}) <br><br>
 @if(!empty($item->payment_id))
<span class="badge badge-secondary badge-lg">{{ $item->payment_id }}</span>
<br><br>
@endif
@if($item->payment_status == 'success')
<span class="badge badge-success badge-lg">{{ $item->payment_status }}</span>
@else
<span class="badge badge-danger badge-lg">{{ $item->payment_status }}</span>
@endif
</td>
<td><span class="badge badge-danger badge-lg">{{ $item->status }}</span></td>
<td>
<div class="d-flex align-items-center">
<a class="btn btn-info btn-sm" href="{{ route('admin.pending.details', ['id' => $item->id]) }}"> <i class="typcn typcn-eye"></i></a> 
<a class="btn btn-danger btn-sm" id="delete_single"  data-url="delete/orders" data-id="{{ $item->id }}" data-token="{{ csrf_token() }}"> <i class="typcn typcn-delete"></i></a>    
</div>
</td>
</tr>
@endforeach
</tbody>
</table>
</div>
</div>
</div>
</div>
@endsection