<?php $dash.='--> '; ?>
@foreach($subchildcategories as $subcategory)
   @if(count($subcategory->subchilds))
        @include('admin/pages/subCategoryList-table',['subchildcategories' => $subcategory->subchilds])
    @endif
    {{$subcategory->title}}     {{$dash}} 
@endforeach