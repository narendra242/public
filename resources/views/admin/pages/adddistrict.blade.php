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

echo Form::model($get_record,array('id'=>'update','class' => 'district','url' => 'admin/district/update','autocomplete'=>false,'files'=>true,'method'=>'patch'));

echo Form::hidden('id');

} else {

echo Form::open(array('id'=>'create','class' => 'district','url' => 'admin/district/store','autocomplete'=>false,'files'=>true));

}

?>

<div class="card-body">



<div class="form-group">

<label>Division Name</label>

{!! Form::select('division_id', $divisions, old('division_id'), ['class' => 'form-control', 'required']) !!}

<span class="text-danger small error-text division_id_error"> </span>

</div>



<div class="form-group">

<label>Title</label>

<?php echo Form::text('district_name', null,['class'=>'form-control']); ?>

<span class="text-danger small error-text district_name_error"></span>

</div>

 


<div class="form-group">

<label>Sort Order</label>

<select name="sort_order" id="sort_order" class="form-control">

{{ GeneralHelper::sortOrder(@$get_record->id,"ship_districts","id","district_name") }}

</select>

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

</div>

@endsection