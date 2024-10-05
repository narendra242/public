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
    echo Form::model($get_record,array('id'=>'update','class' => 'contant','url' => 'admin/contant/update','autocomplete'=>false,'files'=>true,'method'=>'patch'));
    echo Form::hidden('id');
    } else {
    echo Form::open(array('id'=>'create','class' => 'contant','url' => 'admin/contant/store','autocomplete'=>false,'files'=>true));
    }
    ?>
    <div class="card-body">
    <div class="form-group">
    <label class="ltitle">Select Page</label>
    <?php echo Form::select('title', GeneralHelper::getcontant(), null, array('class' => 'form-control')); ?>
    <span class="text-danger small title_error"> </span>
    
</div>
  
    <div class="form-group">
    <label>Description</label>
    <?php echo Form::textarea('description', null,['class'=>'ckeditor','id'=>'description']); ?>
    <span class="text-danger"> </span>
    </div> 


    <div class="form-group">
    <label>Title Tag</label>
    <?php echo Form::textarea('title_tag', null,['class'=>'form-control','rows' => 0, 'cols' => 0]); ?>
    <span class="text-danger"> <?php echo $errors->has('title_tag')?$errors->first('title_tag'):''; ?></span>
    <span class="text-danger small title_tag_error"> </span>    
   </div>

    <div class="form-group">
    <label>Canonical Tag</label>
    <?php echo Form::textarea('canonical_tag', null,['class'=>'form-control','rows' => 0, 'cols' => 0]); ?>
    <span class="text-danger"> </span>
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
    <img width="100" src="<?php echo asset("contant_images/".$get_record->image."")?>">
    <?php }} ?>
    <span class="text-danger error-text image_error"> </span>
    </div>

    <div class="form-group">
    <label>Image Alt [SEO]</label>
    <?php echo Form::textarea('alt_tag', null,['class'=>'form-control','rows' => 0, 'cols' => 0]); ?>
    <span class="text-danger"> </span>
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