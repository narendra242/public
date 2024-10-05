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
echo Form::model($get_record,array('id'=>'update','class' => 'banner','url' => 'admin/banner/update','autocomplete'=>false,'files'=>true,'method'=>'patch'));
echo Form::hidden('id');
} else {
echo Form::open(array('id'=>'create','class' => 'banner','url' => 'admin/banner/store','autocomplete'=>false,'files'=>true));
}
?>
<div class="card-body">
<div class="form-group">
<label>Title</label>
<?php echo Form::text('title', null,['class'=>'form-control']); ?>
<span class="text-danger small title_error"> </span>
</div>

<div class="form-group">
<label>Web Url</label>
<?php echo Form::text('web_url', null,['class'=>'form-control']); ?>
<span class="text-danger weburl_error"></span>
</div>

<div class="form-group">
<label>Description</label>
<?php echo Form::textarea('description', null,['class'=>'form-control','rows' => 0, 'cols' => 0]); ?>
<?php echo $errors->has('description')?$errors->first('description'):''; ?> 
</div>

<div class="form-group">
<label class="ltitle">Banner Upload</label>
<div class="input-group">
<div class="custom-file">
<?php echo Form::file('image',array('class' => 'custom-file-input')); ?>
<label class="custom-file-label">Choose file</label>
</div>
</div>
<?php  if(isset($get_record)){ 
if(!empty($get_record->image)){ ?>
<img width="100" src="<?php echo asset("banner_images/".$get_record->image."")?>">
<?php }} ?>

<span class="text-danger small image_error"> <?php echo $errors->has('image')?$errors->first('image'):''; ?></span>

</div>

<div class="form-group">
<label>Image Alt [SEO]</label>
<?php echo Form::textarea('alt_tag', null,['class'=>'form-control','rows' => 0, 'cols' => 0]); ?>
</div>
 
 
<div class="form-group">
<label>Sort Order</label>
<select name="sort_order" id="sort_order" class="form-control form-control-sm">
<?php echo GeneralHelper::sortOrder(@$get_record->id,"banners","id","title");  ?>
</select>
</div>

<div class="form-group">
<label class="ltitle">Status</label>
<?php echo Form::select('status', array(1 => 'Yes', 0 => 'No'), null, array('class' => 'form-control form-control-sm')); ?>
</div>
</div>
<!-- /.card-body -->
<div class="card-footer">
<?php echo Form::submit('Submit',['class' => 'btn btn-primary']); ?>  
</div>
<?php echo Form::close(); ?>
</div>
@endsection