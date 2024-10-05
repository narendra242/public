<?php $dash.='-- '; ?>
 
@foreach($subcategories as $subcategory)
<option {{GeneralHelper::match($subcategory->id,@$get_record->parent_id)}} value="{{$subcategory->id}}" >{{$dash}} {{$subcategory->title}}</option>
@if(count($subcategory->subcategory))
@include('admin/pages/subCategoryList-option',['subcategories' => $subcategory->subcategory])
@endif
@endforeach