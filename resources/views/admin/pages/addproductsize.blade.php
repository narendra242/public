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
echo Form::model($get_record,array('id'=>'update','class' => 'size','url' => 'admin/size/update','autocomplete'=>false,'files'=>true,'method'=>'patch'));
echo Form::hidden('id');
} else {
echo Form::open(array('id'=>'create','class' => 'size','url' => 'admin/size/store','autocomplete'=>false,'files'=>true));
}
?>
<div class="card-body">
<div class="form-group">
<label>Name</label>
<?php echo Form::text('title', null,['class'=>'form-control']); ?>
<span class="text-danger small error-text name_error"> </span>
</div>
 
 
<div class="form-group">
<label>Sort Order</label>
<select name="sort_order" id="sort_order" class="form-control">
{{ GeneralHelper::sortOrder(@$get_record->id,"sizes","id","title") }}
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