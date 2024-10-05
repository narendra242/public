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
<h3 class="card-title">Return Request</h3>
</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Date </th>
								<th>Invoice </th>
								<th>Amount </th>
								<th>Payment </th>
								<th>Status </th>
								<th>Action</th>

							</tr>
						</thead>
						<tbody>
	 @foreach($orders as $item)
	 <tr>
		<td> {{ $item->order_date }}  </td>
		<td> {{ $item->invoice_no }}  </td>
		<td> ${{ $item->amount }}  </td>

		<td> {{ $item->payment_method }}  </td>
		<td>
		@if($item->return_order == 1)
      <span class="badge badge-pill badge-primary">Pending </span>
       @elseif($item->return_order == 2)
       <span class="badge badge-pill badge-success">Success </span>
		@endif

	  </td>

		<td width="25%">
		<a href="{{ route('admin.return.approve',$item->id) }}" class="btn btn-danger">Approve </a>
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