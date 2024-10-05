@extends('admin.layouts.app')
@section('content')
<div class="card-body card card-primary">
<div class="card-header">
<h3 class="card-title">{{$head}}</h3>
</div>
<!-- /.card-header -->
<!-- form start -->
<?php  
if(isset($get_record)){
echo Form::model($get_record,array('id'=>'update','class' => 'resize/createsize','url' => 'admin/resize/updatesize','autocomplete'=>false,'files'=>true,'method'=>'patch'));
echo Form::hidden('id');
} else {
echo Form::open(array('id'=>'create','class' => 'resize/createsize','url' => 'admin/resize/storesize','autocomplete'=>false,'files'=>true));
}
?>
<div class="card-body">
<div class="form-group">
<label class="ltitle">Select Page</label>
{{ Form::select('sec_id', GeneralHelper::getsize(), null, array('class' => 'form-control')) }}
</div>
<div class="form-group">
<label>Width</label>
<?php echo Form::text('sec_width', null,['class'=>'form-control']); ?>
<span class="text-danger text-small  error-text sec_width_error"> </span>
</div>
<div class="form-group">
<label>Height</label>
<?php echo Form::text('sec_height', null,['class'=>'form-control']); ?>
<span class="text-danger text-small  error-text sec_height_error"> </span>
</div>
<div class="form-group">
<label class="ltitle">Status</label>
<?php echo Form::select('status', array(1 => 'Yes', 0 => 'No'), null, array('class' => 'form-control')); ?>
</div>
<div class="form-group">
<?php echo Form::submit('Submit',['class' => 'btn btn-large btn-primary openbutton']); ?>
</div>
<?php echo Form::close(); ?>
</div>
<div class="row">
    <div class="col-md-12 table-responsive">
   <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Sr no</th>
      <th scope="col">Title</th>
      <th scope="col">Width</th>
      <th scope="col">Height</th>
 	  <th scope="col">Action</th>      
    </tr>
  </thead>
  <tbody>
   @if(!$sizes->isEmpty())
        @foreach($sizes as $record)
    <tr id="dels{{ $record->id }}">
      <th scope="row">{{ $record->sec_id }}</th>
      <td scope="row">{{ GeneralHelper::getsize($record->sec_id)}}</td>
	  <td>{{ $record->sec_width }}</td>
      <td>{{ $record->sec_height }}</td>
      <td>
        <a class="btn btn-info btn-sm" href="{{ route('admin.resize.editsize', ['id' => $record->id]) }}"> <i class="typcn typcn-edit"></i></a> 
        <a class="btn btn-danger btn-sm" id="delete_single" data-url="resize/deletesize"  data-id="{{ $record->id }}" data-token="{{ csrf_token() }}"> <i class="typcn typcn-delete"></i></a></td>
    </tr>
     @endforeach
     @else
    <tr>
     <td colspan="4">No record found</td>
    </tr>
    @endif
  </tbody>
</table>
    </div>
    </div>
  </div>
@endsection