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
echo Form::model($get_record,array('id'=>'update','class' => 'blogcat','url' => 'admin/blogcat/update','autocomplete'=>false,'files'=>true,'method'=>'patch'));
echo Form::hidden('id');
} else {
echo Form::open(array('id'=>'create','class' => 'blogcat','url' => 'admin/blogcat/store','autocomplete'=>false,'files'=>true));
}
?>
<div class="card-body">
<div class="form-group">
<label>Title</label>
<?php echo Form::text('title', null,['class'=>'form-control']); ?>
<span class="text-danger small error-text title_error"> <?php echo $errors->has('title')?$errors->first('title'):''; ?></span>
</div>
<div class="form-group">
<label>Slug Url</label>
<?php echo Form::text('slug_url', null,['class'=>'form-control']); ?>
<span class="text-danger small error-text slug_url_error"> <?php echo $errors->has('slug_url')?$errors->first('slug_url'):''; ?></span>
</div>
<div class="form-group">
<label>Description</label>
<?php echo Form::textarea('description', null,['class'=>'ckeditor','rows' => 0, 'cols' => 0]); ?>
<span class="text-danger"> <?php echo $errors->has('description')?$errors->first('description'):''; ?></span>
</div> 
<div class="form-group">
<label>Title Tag</label>
<?php echo Form::textarea('title_tag', null,['class'=>'form-control','rows' => 0, 'cols' => 0]); ?>
<span class="text-danger"> <?php echo $errors->has('title_tag')?$errors->first('title_tag'):''; ?></span>
</div>
<div class="form-group">
<label>Canonical Tag</label>
<?php echo Form::textarea('canonical_tag', null,['class'=>'form-control','rows' => 0, 'cols' => 0]); ?>
<span class="text-danger"> <?php echo $errors->has('canonical_tag')?$errors->first('canonical_tag'):''; ?></span>
</div>
<div class="form-group">
<label>Meta Keywords</label>
<?php echo Form::textarea('meta_keyword', null,['class'=>'form-control','rows' => 0, 'cols' => 0]); ?>
<span class="text-danger"> <?php echo $errors->has('meta_keyword')?$errors->first('meta_keyword'):''; ?></span>
</div>
<div class="form-group">
<label>Meta Description</label>
<?php echo Form::textarea('meta_description', null,['class'=>'form-control','rows' => 0, 'cols' => 0]); ?>
<span class="text-danger"> <?php echo $errors->has('meta_description')?$errors->first('meta_description'):''; ?></span>
</div>
<div class="form-group">
<label class="ltitle">Image Upload</label>
<div class="input-group">
<div class="custom-file">
<?php echo Form::file('image',array('class' => 'custom-file-input')); ?>
<label class="custom-file-label">Choose file</label>
</div>
</div>
<?php  if(isset($get_record)){ 
if(!empty($get_record->image)){ ?>
<img width="100" src="<?php echo asset("blog_images/".$get_record->image."")?>">
<?php }} ?>
<span class="text-danger">  </span>
</div>


<div class="form-group">
<label class="ltitle">Banner Upload</label>
<div class="input-group">
<div class="custom-file">
<?php echo Form::file('banner',array('class' => 'custom-file-input')); ?>
<label class="custom-file-label">Choose file</label>
</div>
</div>
<?php  if(isset($get_record)){ 
if(!empty($get_record->banner)){ ?>
<img width="100" src="<?php echo asset("blog_images/".$get_record->banner."")?>">
<?php }} ?>
<span class="text-danger">  </span>
</div>
<div class="form-group">
<label>Image Alt [SEO]</label>
<?php echo Form::textarea('alt_tag', null,['class'=>'form-control','rows' => 0, 'cols' => 0]); ?>
<span class="text-danger"> <?php echo $errors->has('alt_tag')?$errors->first('alt_tag'):''; ?></span>
</div>
 
<div class="form-group">
<label>Sort Order</label>
<select name="sort_order" id="sort_order" class="form-control">
<?php echo GeneralHelper::sortOrder(@$get_record->id,"blogcats","id","title");  ?>
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