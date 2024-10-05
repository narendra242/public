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
echo Form::model($get_record,array('id'=>'update','class' => 'coupon','url' => 'admin/coupon/update','autocomplete'=>false,'files'=>true,'method'=>'patch'));
echo Form::hidden('id');
} else {
echo Form::open(array('id'=>'create','class' => 'coupon','url' => 'admin/coupon/store','autocomplete'=>false,'files'=>true));
}
?>
<div class="card-body">
<div class="form-group">
<label>Coupon Name</label>
<?php echo Form::text('coupon_name', null,['class'=>'form-control']); ?>
<span class="text-danger small error-text coupon_name_error"> </span>
</div>
<div class="form-group">
<label>Coupon Discount(%)</label>
<?php echo Form::text('coupon_discount', null,['class'=>'form-control']); ?>
<span class="text-danger small error-text coupon_discount_error"> </span>
</div>

<div class="form-group">
<label>Shopping Amount</label>
<?php echo Form::text('shopping_amount', null,['class'=>'form-control']); ?>
<span class="text-danger small error-text shopping_amount_error"> </span>
</div>

<div class="form-group">
<label>Coupon Validity</label>
<?php echo Form::date('coupon_validity', null,['class'=>'form-control']); ?>
<span class="text-danger small error-text coupon_validity_error"> </span>
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