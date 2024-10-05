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
echo Form::model($get_record,array('id'=>'update','class' => 'tag','url' => 'admin/tag/update','autocomplete'=>false,'files'=>true,'method'=>'patch'));
echo Form::hidden('id');
} else {
echo Form::open(array('id'=>'create','class' => 'tag','url' => 'admin/tag/store','autocomplete'=>false,'files'=>true));
}
?>
<div class="card-body">
<div class="form-group">
<label>Title</label>
<?php echo Form::text('title', null,['id' => 'title','class'=>'form-control']); ?>
<span class="text-danger small error-text title_error"></span>
</div>

<div class="form-group">
<label>Slug Url</label>
<?php echo Form::text('slug_url', null,['class'=>'form-control']); ?>
<span class="text-danger small error-text slug_url_error"> </span>
</div>



<div class="form-group">
<label>Title Tag</label>
<?php echo Form::textarea('title_tag', null,['class'=>'form-control title_tag','rows' => 0, 'cols' => 0]); ?>
<span class="text-danger"> </span>
</div>

<div class="form-group">
<label>Canonical Tag</label>
<?php echo Form::textarea('canonical_tag', null,['class'=>'form-control canonical_tag','rows' => 0, 'cols' => 0]); ?>
<span class="text-danger"> </span>
</div>

<div class="form-group">
<label>Meta Keywords</label>
<?php echo Form::textarea('meta_keyword', null,['class'=>'form-control meta_keyword','rows' => 0, 'cols' => 0]); ?>
<span class="text-danger"> </span>
</div>

<div class="form-group">
<label>Meta Description</label>
<?php echo Form::textarea('meta_description', null,['class'=>'form-control meta_description','rows' => 0, 'cols' => 0]); ?>
<span class="text-danger"> </span>
</div>
 
 
 
<div class="form-group">
<label>Sort Order</label>
<select name="sort_order" id="sort_order" class="form-control">
{{ GeneralHelper::sortOrder(@$get_record->id,"tags","id","title") }}
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