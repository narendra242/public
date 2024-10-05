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
<h3 class="card-title">Orders List</h3>
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

    <td> <span class="badge badge-pill badge-primary">{{ $item->status }} </span>  </td>

    <td width="25%">
<a href="{{ route('admin.pending.details',$item->id) }}" class="btn btn-info" title="Edit Data"><i class="typcn typcn-eye"></i> </a>

<a target="_blank" href="{{ route('admin.invoice.download',$item->id) }}" class="btn btn-danger" title="Invoice Download">
 <i class="typcn typcn-download"></i></a>
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