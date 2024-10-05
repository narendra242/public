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



<div class="col-sm-12 table-responsive">



<table class="table table-striped table-bordered dataTable" id="editable-datatable" style="cursor: pointer;" role="grid" aria-describedby="editable-datatable_info">



<thead>



<tr>



<th>SN</th>



<th>Date</th>



<th>Invoice</th>



<th>Amount</th>



<th>Payment</th>



<th>Status</th>



<th>Action</th>



</tr>



</thead>



@if(!$orders->isEmpty())



@foreach($orders as $record)



<tr id="dels{{ $record->id }}">



<th scope="row">{{$loop->iteration}}</th>



<td>{{ $record->order_date }}</td>



<td>{{ $record->invoice_no }}</td>



<td><i class="fa fa-rupee"></i> {{ $record->amount }}</td>



<td>{{ $record->payment_method }} ({{ $record->payment_type }}) <br><br>
 @if(!empty($record->payment_id))
<span class="badge badge-secondary badge-lg">{{ $record->payment_id }}</span>
<br><br>
@endif
@if($record->payment_status == 'success')
<span class="badge badge-success badge-lg">{{ $record->payment_status }}</span>
@else
<span class="badge badge-danger badge-lg">{{ $record->payment_status }}</span>
@endif
</td>



<td><span class="badge badge-pill badge-primary">{{ $record->status }} </span></td>

<td>

<a class="btn btn-info btn-sm" href="{{ route('admin.pending.details', ['id' => $record->id]) }}"> <i class="typcn typcn-eye"></i></a> 

</td>

</tr>

@endforeach

@else

<tr>

<td  colspan="7">No record found</td>

</tr>

@endif

</tbody>

</table>



</div>



</div>



</div>



</div>



@endsection



