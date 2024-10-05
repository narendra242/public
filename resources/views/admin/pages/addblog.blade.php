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
echo Form::model($get_record,array('id'=>'update','class' => 'blog','url' => 'admin/blog/update','autocomplete'=>false,'files'=>true,'method'=>'patch'));
echo Form::hidden('id');
} else {
echo Form::open(array('id'=>'create','class' => 'blog','url' => 'admin/blog/store','autocomplete'=>false,'files'=>true));
}
?>
<div class="card-body">
    <div id="product-filter" class="scrollbox"> 
        @if($blogcates)
        <?php $cats=''; 
        $cats = explode(',',@$get_record->blogcat_id);?>
        @foreach($blogcates as $category) 
        @if(in_array($category->id, $cats))
        @php $chk = "checked=checked"; @endphp
        @else
        @php $chk = ""; @endphp
        @endif
        <p style='padding:0px; margin:0px;'>
        <input type="checkbox" name="blogcat_id[]" <?php echo @$chk; ?> value="{{$category->id}}">
        <strong>{{$category->title}}</strong>  
        </p> 
        @endforeach
        @endif
        </div>    
<div class="form-group">
<label>Title</label>
<?php echo Form::text('title', null,['class'=>'form-control']); ?>
<span class="text-danger error-text title_error"> </span>
</div>
<div class="form-group">
<label>Date</label>
<?php echo Form::date('blog_date', null,['class'=>'form-control']); ?>
<span class="text-danger error-text blog_date_error"></span>
</div>
<div class="form-group">
<label>Slug Url</label>
<?php echo Form::text('slug_url', null,['class'=>'form-control']); ?>
<span class="text-danger error-text slug_url_error"> </span>
</div>
<div class="form-group">
<label>Description</label>
<?php echo Form::textarea('description', null,['class'=>'ckeditor','rows' => 0, 'cols' => 0]); ?>
<span class="text-danger"> </span>
</div> 
<div class="form-group">
<label>Author Name</label>
<?php echo Form::text('author_name', null,['class'=>'form-control','rows' => 0, 'cols' => 0]); ?>
<span class="text-danger"> </span>
</div>
<div class="form-group">
<label>Title Tag</label>
<?php echo Form::textarea('title_tag', null,['class'=>'form-control','rows' => 0, 'cols' => 0]); ?>
<span class="text-danger"> </span>
</div>
<div class="form-group">
<label>Canonical Tag</label>
<?php echo Form::textarea('canonical_tag', null,['class'=>'form-control','rows' => 0, 'cols' => 0]); ?>
<span class="text-danger"></span>
</div>
<div class="form-group">
<label>Meta Keywords</label>
<?php echo Form::textarea('meta_keyword', null,['class'=>'form-control','rows' => 0, 'cols' => 0]); ?>
<span class="text-danger"> </span>
</div>
<div class="form-group">
<label>Meta Description</label>
<?php echo Form::textarea('meta_description', null,['class'=>'form-control','rows' => 0, 'cols' => 0]); ?>
<span class="text-danger"> </span>
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
<span class="text-danger error-text image_error"> <?php echo $errors->has('image')?$errors->first('image'):''; ?></span>
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
<?php echo GeneralHelper::sortOrder(@$get_record->id,"blogs","id","title");  ?>
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