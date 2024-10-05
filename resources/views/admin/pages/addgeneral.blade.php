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
echo Form::model($get_record,array('id'=>'update','class' => 'general','url' => 'admin/general/update','autocomplete'=>false,'files'=>true,'method'=>'patch'));
echo Form::hidden('id');
} else { 
echo Form::open(array('id'=>'create','class' => 'general','url' => 'admin/general/store','autocomplete'=>false,'files'=>true)); 
}
?>

<div class="row">
<div class="col-sm-12">
<?php echo Form::submit('Submit',['class' => 'btn btn-success float-right mt-2']); ?>
</div>
</div>

<nav>
<div class="nav nav-tabs" id="nav-tab" role="tablist">
<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">General</a>
<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Contact Info</a>
<a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Social Profile</a>
</div>
</nav>
<div class="card-body">

<div class="tab-content" id="nav-tabContent">
<div class="tab-pane fade show active" id="nav-home" role="tabpanel"> <div class="form-group">
<label>Title</label>
<?php echo Form::text('title', null,['class'=>'form-control']); ?>
<span class="text-danger small error-text title_error"> </span>
</div>

<div class="form-group">
<label>Owner</label>
<?php echo Form::text('owner', null,['class'=>'form-control']); ?>
<span class="help-block"> </span>
</div> 

<div class="form-group">
<label>Top Home Page</label>
<?php echo Form::textarea('main_heading', null,['class'=>'form-control','rows' => 3, 'cols' => 0]); ?>
<span class="help-block"> </span>
</div> 


<div class="form-group">
<label>Product Head [Home Page]</label>
<?php echo Form::text('sub_title', null,['class'=>'form-control']); ?>
<span class="help-block"> </span>
</div> 

<div class="form-group">
<label>Shop by Categories Sub Title [Home Page]</label>
<?php echo Form::textarea('sub_heading', null,['class'=>'form-control','rows' => 3, 'cols' => 0]); ?>
<span class="help-block"> </span>
</div> 

<div class="form-group">
<label>Title Tag</label>
<?php echo Form::textarea('title_tag', null,['class'=>'form-control','rows' => 0, 'cols' => 0]); ?>
<span class="help-block"> </span>
</div>

<div class="form-group">
<label>Canonical Tag</label>
<?php echo Form::textarea('canonical_tag', null,['class'=>'form-control','rows' => 0, 'cols' => 0]); ?>
<span class="help-block"> </span>
</div>

<div class="form-group">
<label>Meta Keywords</label>
<?php echo Form::textarea('meta_keyword', null,['class'=>'form-control','rows' => 0, 'cols' => 0]); ?>
<span class="help-block"> </span>
</div>

<div class="form-group">
<label>Meta Description</label>
<?php echo Form::textarea('meta_description', null,['class'=>'form-control','rows' => 0, 'cols' => 0]); ?>
<span class="help-block"> </span>
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
<img width="100" src="<?php echo asset("general_images/".$get_record->image."")?>">
<?php }} ?>
<span class="text-danger small error-text image_error"> </span>
</div>

<div class="form-group">
<label>Image Alt [SEO]</label>
<?php echo Form::textarea('alt_tag', null,['class'=>'form-control','rows' => 0, 'cols' => 0]); ?>
<span class="help-block"> </span>
</div>

<div class="form-group">
<label>Sort Order</label>
<select name="sort_order" id="sort_order" class="form-control">
<?php echo GeneralHelper::sortOrder(@$get_record->id,"generals","id","title");  ?>
</select>
</div>

<div class="form-group">
<label class="ltitle">Status</label>
<?php echo Form::select('status', array(1 => 'Yes', 0 => 'No'), null, array('class' => 'form-control')); ?>
</div>
</div>
<div class="tab-pane fade" id="nav-profile" role="tabpanel"><div class="form-group">
<label>Address</label>
<?php echo Form::textarea('address', null,['class'=>'ckeditor','rows' => 0, 'cols' => 0]); ?>
<span class="help-block"> </span>
</div>

<div class="form-group">
<label>Email</label>
<?php echo Form::email('email', null,['class'=>'form-control']); ?>
<span class="help-block"> </span>
</div> 

<div class="form-group">
<label>Email 2</label>
<?php echo Form::email('emailto', null,['class'=>'form-control']); ?>
<span class="help-block"> </span>
</div> 

<div class="form-group">
<label>Contact 1</label>
<?php echo Form::text('phone', null,['class'=>'form-control']); ?>
<span class="help-block"> </span>
</div> 

<div class="form-group">
<label>Contact 2</label>
<?php echo Form::text('contact', null,['class'=>'form-control']); ?>
<span class="help-block"> </span>
</div> 

<div class="form-group">
<label>Whatsapp</label>
<?php echo Form::text('whats_app', null,['class'=>'form-control']); ?>
<span class="help-block"> </span>
</div> 

<div class="form-group">
<label>Weburl</label>
<?php echo Form::text('weburl', null,['class'=>'form-control']); ?>
<span class="help-block"> </span>
</div>  

<div class="form-group">
<label>Gmap</label>
<?php echo Form::textarea('gmap', null,['class'=>'form-control','rows' => 0, 'cols' => 0]); ?>
<span class="help-block"> </span>
</div>  

<div class="form-group">
<label>Google Analytics Code</label>
<?php echo Form::textarea('analytics', null,['class'=>'form-control','rows' => 0, 'cols' => 0]); ?>
<span class="help-block"> </span>
</div>  

<div class="form-group">
<label>Google Webmaster Code</label>
<?php echo Form::textarea('webmaster', null,['class'=>'form-control','rows' => 0, 'cols' => 0]); ?>
<span class="help-block"> </span>
</div>  


<div class="form-group">
<label>Chat Widget Code</label>
<?php echo Form::textarea('chat_widget', null,['class'=>'form-control','rows' => 0, 'cols' => 0]); ?>
<span class="help-block"> </span>
</div>  

<div class="form-group">
<label>Open Hours</label>
<?php echo Form::text('open_hours', null,['class'=>'form-control']); ?>
<span class="help-block"> </span>
</div>  

<div class="form-group">
<label>Copyright Text</label>
<?php echo Form::text('copyright_text', null,['class'=>'form-control']); ?>
</div>  

<div class="form-group">
<label>Shipping</label>
<?php echo Form::text('shipping', null,['class'=>'form-control','rows' => 4, 'cols' => 0]); ?>
</div>  

<div class="form-group">
<label>Return Replacement</label>
<?php echo Form::text('return_replace', null,['class'=>'form-control','rows' => 4, 'cols' => 0]); ?>
</div>  
</div>

<div class="tab-pane fade" id="nav-contact" role="tabpanel">  <div class="col-sm-12">
<div class="row">
<div class="mt-10">
<div class="table-responsive">
<table id="sociallink" class="table table-striped table-bordered table-hover">
<thead>
<tr>
<td> Social Title </td>
<td> Social Url </td>
<td> Social Icon </td>
<td> Sort </td>
<td> </td>
</tr>
</thead>
<tbody>
@if(!empty($get_record->social_data)) 
<?php $count=json_decode($get_record->social_data);
$max=count($count); ?>
@foreach(json_decode($get_record->social_data) as $instdt) 
<tr id="sociallink{{$loop->iteration}}">
<td><input type="text" name="social[{{$loop->iteration}}][sotitle]" value="{{$instdt->social_title}}" placeHolder="Title" class="form-control wfull"></td>
<td><input type="text" name="social[{{$loop->iteration}}][sourl]" value="{{$instdt->social_url}}"  placeHolder="Url" class="form-control wfull"></td>
<td><input type="text" name="social[{{$loop->iteration}}][soicon]" value="{{$instdt->social_icon}}"  placeHolder="Icon" class="form-control wfull"></td>
<td><input type="text" name="social[{{$loop->iteration}}][sort]" value="{{$loop->iteration}}" placeholder="Order Sort" class="form-control" /></td>
<td><button type="button" onclick="$('#sociallink{{$loop->iteration}}').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="typcn typcn-delete"></i></button></td>
</tr>
@endforeach
@endif
</tbody>
<tfoot>
<tr>
<td colspan="4"></td>
<td class="text-left"><button type="button" onclick="addSocials();" data-toggle="tooltip" title="Add Social" class="btn btn-primary"><i class="typcn typcn-plus"></i></button></td>
</tr>
</tfoot>
</table>
</div>
</div>
</div>
</div></div>

</div>
</div>

<?php echo Form::close(); ?>
</div>

<script>
@if(empty($get_record->social_data)) 
var social_row = 1;
@else
var social_row = <?php echo $max+1;?>;
@endif
function addSocials() {  
html  = '<tr id="sociallink' + social_row + '">';
html += '<td><input type="text" name="social[' + social_row + '][sotitle]" placeHolder="Title" class="form-control wfull"></td>';
html += '<td><input type="text" name="social[' + social_row + '][sourl]" placeHolder="Url" class="form-control wfull"></td>';
html += '<td><input type="text" name="social[' + social_row + '][soicon]" placeHolder="Icon" class="form-control wfull"></td>';
html += '<td><input type="text" name="social[' + social_row + '][sort]" value="' + social_row + '" placeholder="Order Sort" class="form-control" /></td>';
html += '<td><button type="button" onclick="$(\'#sociallink' + social_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="typcn typcn-delete"></i></button></td>';
html += '</tr>';
$('#sociallink tbody').append(html);
social_row++;
}
</script>

@endsection
