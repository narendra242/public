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
echo Form::model($get_record,array('id'=>'update','class' => 'product','url' => 'admin/product/update','autocomplete'=>false,'files'=>true,'method'=>'patch'));
echo Form::hidden('id');
} else { 
echo Form::open(array('id'=>'create','class' => 'product','url' => 'admin/product/store','autocomplete'=>false,'files'=>true)); 
}
?>
 
<div class="card-body">
<div class="row">
<div class="col-sm-6">
<div class="form-group">
<label>Title</label>
<?php echo Form::text('title', null,['id'=>'title','class'=>'form-control']); ?>
<span class="text-danger text-small error-text title_error"> </span>
</div>
</div>

<div class="col-sm-6">
<div class="form-group">
<label>Slug Url</label>
<?php echo Form::text('slug_url', null,['class'=>'slug_url form-control']); ?>
<span class="text-danger text-small error-text slug_url_error"> </span>
</div>
</div>

 
</div>


<div class="row">

<div class="col-sm-6">
<div class="form-group">
<label>Product Code</label>
<?php echo Form::text('product_code', null,['class'=>'form-control']); ?>
<span class="text-danger text-small error-text product_code_error"> </span>
</div>
</div>

<div class="col-sm-6">
<div class="form-group">
<label>Brand By</label>
{!! Form::select('brand_id', $brands, old('brand_id'), ['class' => 'form-control']) !!}
<span class="text-danger small error-text brand_id_error"> </span>
</div> 
</div>
 
</div>

<div class="row">

<div class="col-sm-6">
<div class="form-group">
<label>Price</label>
<?php echo Form::text('price', null,['class'=>'form-control']); ?>
<span class="text-danger text-small error-text price_error"> </span>
</div>
</div>

<div class="col-sm-6">
<div class="form-group">
<label>Discount%</label>
<?php echo Form::text('discount', null,['class'=>'form-control']); ?>
<span class="text-danger text-small error-text discount_error"> </span>
</div>
</div>
 
</div>

<div class="row">
  <div class="col-sm-6">
    <div class="form-group">
    <label>Related Product</label>
    <?php echo Form::text('rel_product', null,['class'=>'form-control']); ?>
    <div id="prod-related" class="well well-sm" style="height: 150px; overflow: auto;"> 
    @if(isset($get_record))
    @php 
    $col = explode(',',@$get_record->rel_product) 
    @endphp
    @foreach($get_record->rel_prod($col) as $rprod) 
    <div id="prod-related{{$rprod->id}}"><i class="typcn typcn-delete"></i>
    {{$rprod->title}}
    <input type="hidden" name="rel_product[]" value="{{$rprod->id}}" />
    </div>
    @endforeach 
    @endif
    </div>
    
    </div> 
       
    </div>
<div class="col-sm-6">
<div class="form-group">
<label>Quantity</label>
<?php echo Form::text('quantity', null,['class'=>'form-control']); ?>
<span class="text-danger text-small error-text quantity_error"> </span>
</div>

 

<div class="form-group">
  <label>Searchkeyword</label>
  <?php echo Form::textarea('searchkeyword', null,['class'=>'form-control','rows' => 0, 'cols' => 0]); ?>
  <span class="text-danger text-small error-text searchkeyword_error"> </span>
  </div>
</div>
 
</div>
 
<div class="row">
<div class="col-sm-6">
<label>Select Categories <span class="text-danger text-small error-text cat_id_error"> </span>
</label>
<div id="product-filter" class="scrollbox"> 
@if($categories)
@foreach($categories as $category) 
<?php $dash=''; 
$cats = explode(',',@$get_record->cat_id); ?>
@if(in_array($category->id, $cats))
@php $chk = "checked=checked"; @endphp
@else
@php $chk = ""; @endphp
@endif
<p style='padding:0px; margin:0px;'>
<input type="checkbox" name="cat_id[]" <?php echo $chk; ?> value="{{$category->id}}">
<?php $dash=''; ?>
@if(count($category->subchilds))
@include('admin/pages/subCategoryList-checkbox',['subchildcategories' => $category->subchilds])
@endif
<strong>{{$category->title}}</strong>  
</p>
@endforeach
@endif
</div>  

</div>
<div class="col-sm-6">
<div class="form-group">
<label>Add Tag</label>
<?php echo Form::text('hash_tags', null,['class'=>'form-control']); ?>
<div id="tag-related" class="well well-sm" style="height: 150px; overflow: auto;"> 
@if(isset($get_record))
@php 
$tag = explode(',',@$get_record->tag_related) 
@endphp
@foreach($get_record->tags($tag) as $tags) 
<div id="tag-related{{$tags->id}}"><i class="typcn typcn-delete"></i>
{{$tags->title}}
<input type="hidden" name="tag_related[]" value="{{$tags->id}}" />
</div>
@endforeach 
@endif
</div>

</div> 
   
</div>
</div>

<div class="row">
<div class="col-sm-6">
<div class="form-group">
<label>Add Color</label>
<?php echo Form::text('hash_color', null,['class'=>'form-control']); ?>
<div id="color-related" class="well well-sm" style="height: 150px; overflow: auto;"> 
@if(isset($get_record))
@php 
$col = explode(',',@$get_record->color_related) 
@endphp
@foreach($get_record->color($col) as $color) 
<div id="color-related{{$color->id}}"><i class="typcn typcn-delete"></i>
{{$color->title}}
<input type="hidden" name="color_related[]" value="{{$color->id}}" />
</div>
@endforeach 
@endif
</div>

</div> 
   
</div>
<div class="col-sm-6">
<div class="form-group">
<label>Short Description</label>
<?php echo Form::textarea('short_desc', null,['class'=>'form-control','rows' => 12, 'cols' => 0]); ?>
</div>


</div>
</div>

<div class="row">
<div class="col-sm-6">
<div class="form-group">
<label>Title Tag</label>
<?php echo Form::textarea('title_tag', null,['class'=>'title_tag form-control','rows' => 0, 'cols' => 0]); ?>
<span class="text-danger"></span>
</div>

</div>
 

<div class="col-sm-6">
<div class="form-group">
<label>Canonical Tag</label>
<?php echo Form::textarea('canonical_tag', null,['class'=>'canonical_tag form-control','rows' => 0, 'cols' => 0]); ?>
<span class="text-danger"> </span>
</div>

</div>
 </div>

<div class="row">
<div class="col-sm-6">
<div class="form-group">
<label>Meta Keywords</label>
<?php echo Form::textarea('meta_keyword', null,['class'=>'meta_keyword form-control','rows' => 0, 'cols' => 0]); ?>
<span class="text-danger"> </span>
</div>
</div>

<div class="col-sm-6">
<div class="form-group">
<label>Meta Description</label>
<?php echo Form::textarea('meta_description', null,['class'=>'meta_description form-control','rows' => 0, 'cols' => 0]); ?>
<span class="text-danger"> </span>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-6">
<div class="form-group">
<label class="ltitle">Image Upload</label>
<div class="input-group">
<div class="custom-file">
<?php echo Form::file('image',array('class' => 'custom-file-input')); ?>
<label class="custom-file-label">Choose file</label>
</div>
</div>
<?php if(isset($get_record)) { 
if(!empty($get_record->image)){ ?>
<img width="90" src="<?php echo asset("product_images/".$get_record->image."")?>">
<?php } } ?>
<span class="text-danger error-text image_error"> </span>
</div>
</div>


<div class="col-sm-6">
<div class="form-group">
<label class="ltitle">Size Chart Upload 1000/1400</label>
<div class="input-group">
<div class="custom-file">
<?php echo Form::file('banner',array('class' => 'custom-file-input')); ?>
<label class="custom-file-label">Choose file</label>
</div>
</div>
<?php if(isset($get_record)) { 
if(!empty($get_record->banner)){ ?>
<img width="90" src="<?php echo asset("product_images/".$get_record->banner."")?>">
<?php } } ?>
<span class="text-danger error-text banner_error"> </span>
</div>
</div>

<div class="col-sm-12">
<div class="form-group">
<label>Size/Chart Information</label>
<?php echo Form::textarea('chart_size_information', null,['class'=>'ckeditor','rows' => 0, 'cols' => 0]); ?>
<span class="text-danger">  </span>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-6">
<div class="form-group">
<label>Embed Video Code [Youtube]</label>
<?php echo Form::text('embed_video', null,['class'=>'form-control','rows' => 0, 'cols' => 0]); ?>
<span class="text-danger"> </span>
</div> 
</div>
  
<div class="col-sm-6">
<div class="form-group">
<label>Image Alt [SEO]</label>
<?php echo Form::textarea('alt_tag', null,['class'=>'alt_tag form-control','rows' => 0, 'cols' => 0]); ?>
<span class="text-danger"> </span>
</div> 
</div>

<div class="col-sm-12">
<div class="form-group">
<label>Description</label>
<?php echo Form::textarea('description', null,['class'=>'ckeditor','id'=>'editor1','rows' => 0, 'cols' => 0]); ?>
<span class="text-danger">  </span>
<script type="text/javascript">
CKEDITOR.replace('editor1', {
filebrowserUploadUrl: "{{route('admin.ckeditor.upload', ['_token' => csrf_token() ])}}",
filebrowserUploadMethod: 'form'
});
</script>
</div>
</div>
</div>

 

<div class="row">
<div class="col-sm-12 mb-5">
<table id="sociallink" class="table">
<thead class="thead-light">
<tr>
<th scope="col">Size</th>
<th scope="col">Price Amount</th>
<th scope="col">Sort</th>
<th scope="col" width="20%"><a onclick="addSize();" style="cursor: pointer"; class="btn-primary btn-sm" data-toggle="tooltip" title="Add Size" class=""><i class="typcn typcn-plus"></i></a></th>
</tr>
</thead>
<tbody>

@if(!empty($get_record->product_sizes)) 
<?php $max=count($get_record->product_sizes); ?>
@foreach($get_record->product_sizes as $instdt) 
<tr id="sociallink{{$loop->iteration}}">
  <input type="hidden" value="{{$instdt->id}}" name="related_size[{{$loop->iteration}}][size_uid]">
<td><select class="form-control wfull" name="related_size[{{$loop->iteration}}][size_id]">@foreach($sizes as $size)<option {{GeneralHelper::match($size->id,@$instdt->size_id)}} value="{{$size->id}}">{{$size->title}}</option>@endforeach</select></td>
<td><input type="text" name="related_size[{{$loop->iteration}}][price]" value="{{$instdt->price}}"  placeHolder="Url" class="form-control wfull"></td>
<td><input type="text" name="related_size[{{$loop->iteration}}][sort]" value="{{$instdt->sort}}"  placeHolder="Icon" class="form-control wfull"></td>
<td><button type="button" onclick="$('#sociallink{{$loop->iteration}}').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="typcn typcn-delete"></i></button></td>
</tr>
@endforeach
@endif
</tbody>
</table>
</div>
</div>

<div class="row">
 
<div class="col-sm-6">
<div class="form-group">
<label>Sort Order</label>
<select name="sort_order" id="sort_order" class="form-control">
<?php echo GeneralHelper::sortOrder(@$get_record->id,"products","id","title");  ?>
</select>
</div>
</div>

<div class="col-sm-6">
<div class="form-group">
<label class="ltitle">Status</label>
<?php echo Form::select('status', array(1 => 'Yes', 0 => 'No'), null, array('class' => 'form-control')); ?>
</div>
</div>
 
</div>
 
<div class="form-group">
<div class="form-check form-check-flat form-check-primary">
<label class="form-check-label">
<?php echo Form::checkbox('featured_product[]', '1'); ?>
 Spotlight New Arrival  
<i class="input-helper"></i></label>
</div>
</div>

<div class="form-group">
<div class="form-check form-check-flat form-check-primary">
<label class="form-check-label">
<?php echo Form::checkbox('arrival_product[]', '1'); ?>
Arrival product
<i class="input-helper"></i></label>
</div>
</div>

<div class="form-group">
<div class="form-check form-check-flat form-check-primary">
<label class="form-check-label">
<?php echo Form::checkbox('sale_product[]', '1'); ?>
Sale Product
<i class="input-helper"></i></label>
</div>
</div>

<div class="form-group">
<div class="form-check form-check-flat form-check-primary">
<label class="form-check-label">
<?php echo Form::checkbox('cstm_name[]', '1'); ?>
Product Customize Name
<i class="input-helper"></i></label>
</div>
</div>

 
<div class="row">
<div class="col-sm-12">
<?php echo Form::submit('Submit',['class' => 'btn btn-success float-right mt-2']); ?>
</div>
</div>
</div>

<?php echo Form::close(); ?>
</div>
<script>
$(document).ready(function() {
$('#title').keyup(function(e) {
var txtVal = $(this).val();
$('.title_tag').val(txtVal);
$('.slug_url').val(txtVal);
$('.canonical_tag').val(txtVal);
$('.meta_keyword').val(txtVal);
$('.meta_description').val(txtVal);
$('.alt_tag').val(txtVal);
});
});
@if(!empty($get_record->product_sizes)) 
var size_row = <?php echo $max+1;?>;
@else
var size_row = 1;
@endif
function addSize() {  
html  = '<tr id="sizelink' + size_row + '">';
html += '<td><select class="form-control wfull" name="related_size[' + size_row + '][size_id]">@foreach($sizes as $size)<option value="{{$size->id}}">{{$size->title}}</option>@endforeach</select></td>';
html += '<td><input type="text" name="related_size[' + size_row + '][price]" placeHolder="Amount" class="form-control wfull"></td>';
html += '<td><input type="text" name="related_size[' + size_row + '][sort]" value="' + size_row + '" placeHolder="Sort" class="form-control wfull"></td>';
html += '<td><button type="button" onclick="$(\'#sizelink' + size_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="typcn typcn-delete"></i></button></td>';
html += '</tr>';
$('#sociallink tbody').append(html);
size_row++;
}
</script> 
<script src="{{ asset('js/autocomplete.js')}}"></script>
<script>
$('input[name=\'hash_tags\']').autocomplete({ 
'source': function(request, response) {  
$.ajax({
  url: "{{ route('admin.searchtags') }}",
  type: 'GET',
  dataType: 'json',
    data: {
    filter_name: encodeURIComponent(request),
    },
  success: function(json) {
	  response($.map(json, function(item) {
		  return {
			  label: item['title'],
			  value: item['id']
		  }
	  }));
  }
});
},
'select': function(item) {
$('input[name=\'hash_tags\']').val('');
$('#tag-related' + item['value']).remove();
$('#tag-related').append('<div id="tag-related' + item['value'] + '"><i class="typcn typcn-delete"></i> ' + item['label'] + '<input type="hidden" name="tag_related[]" value="' + item['value'] + '" /></div>');
}
});
$('#tag-related').delegate('.typcn-delete', 'click', function() {
$(this).parent().remove();
});

</script>


<script>
$('input[name=\'hash_color\']').autocomplete({ 
'source': function(request, response) {  
$.ajax({
  url: "{{ route('admin.searchcolors') }}",
  type: 'GET',
  dataType: 'json',
    data: {
    filter_name: encodeURIComponent(request),
    },
  success: function(json) {
	  response($.map(json, function(item) {
		  return {
			  label: item['title'],
			  value: item['id']
		  }
	  }));
  }
});
},
'select': function(item) {
$('input[name=\'hash_color\']').val('');
$('#color-related' + item['value']).remove();
$('#color-related').append('<div id="color-related' + item['value'] + '"><i class="typcn typcn-delete"></i> ' + item['label'] + '<input type="hidden" name="color_related[]" value="' + item['value'] + '" /></div>');
}
});
$('#color-related').delegate('.typcn-delete', 'click', function() {
$(this).parent().remove();
});

</script>

<script>
$('input[name=\'rel_product\']').autocomplete({ 
'source': function(request, response) {  
$.ajax({
  url: "{{ route('admin.searchrelprods') }}",
  type: 'GET',
  dataType: 'json',
    data: {
    filter_name: encodeURIComponent(request),
    },
  success: function(json) {
	  response($.map(json, function(item) {
		  return {
			  label: item['title'],
			  value: item['id']
		  }
	  }));
  }
});
},
'select': function(item) {
$('input[name=\'rel_product\']').val('');
$('#prod-related' + item['value']).remove();
$('#prod-related').append('<div id="prod-related' + item['value'] + '"><i class="typcn typcn-delete"></i> ' + item['label'] + '<input type="hidden" name="rel_product[]" value="' + item['value'] + '" /></div>');
}
});
$('#prod-related').delegate('.typcn-delete', 'click', function() {
$(this).parent().remove();
});

</script>
@endsection