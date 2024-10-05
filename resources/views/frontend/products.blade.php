@extends('layouts.nav')
@section('content')

<!-- inner banner -->
<section class="inner-banner">  
@if(isset($info->banner))
<div class="innerbanner"><img src="<?= (asset("category_images/".$info->banner.""))?>" class="img-fullwidth" /></div>
@endif
</section>

<div class="breadcrumb_section bg_gray page-title-mini">
<div class="container">
<!-- STRART CONTAINER -->
<div class="row align-items-center">
<div class="col-md-6">
<div class="page-title">
<h1>
@if(!isset($info))
Shop
@else
{{$info->title}}
@endif
</h1>
</div>
</div>
<div class="col-md-6">
<ol class="breadcrumb justify-content-md-end">
<li class="breadcrumb-item "><a href="{{route('index')}}"><i class="fa fa-home"></i></a></li>
<li class="breadcrumb-item "><a href="{{route('products')}}">Shop</a></li>
@if(isset($info))
<li class="breadcrumb-item active ">{{$info->title}}</li>
@endif
</ol>
</div>
</div>
</div><!-- END CONTAINER-->
</div>


<div class="main_content">
<!-- START SECTION SHOP -->
<div class="section">
<div class="container">
@if(!empty($contants->description))    
<p>{!! $contants->description !!}</p>
@endif
<div class="row">
<div class="col-lg-12">
<!--@include('frontend.includes.product_top_filter')-->
<div class="row filter_data"></div>
<div class="row shop_container" id="list_view_product">
@if(!isset($info))
@include('frontend.pages.all_products')
@else
@include('frontend.pages.list_view_product')   
@endif 
</div>
<div class="ajax-loadmore-product text-center" style="display:none;">
<img src="{{asset('images/loading.svg')}}" style="width: 120px; height:120px;">
</div> 
</div>
<!--<div class="col-lg-3 order-lg-first mt-4 pt-2 mt-lg-0 pt-lg-0">-->
<!--@include('frontend.includes.filter_list') -->
<!--</div>-->
</div>
@if(!empty($info->description))    
<p>{!! $info->description !!}</p>
@endif
</div>
</div>
<!-- END SECTION SHOP -->

</div>
<script>
function loadmoreProduct(page){
$.ajax({
type: "get",
url: "?page="+page,
beforeSend: function(response){
$('.ajax-loadmore-product').show();
}
})
.done(function(data){
if (data == " ") {
return;
}
$('.ajax-loadmore-product').hide();
$('#list_view_product').append(data);
})
.fail(function(){
alert('Something Went Wrong');
})
}
var page = 1;
$(window).scroll(function (){
if ($(window).scrollTop() +$(window).height() >= $(document).height()-300){
page ++;
loadmoreProduct(page);
}
});
</script>
 
@endsection