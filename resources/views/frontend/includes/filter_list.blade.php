@php
$categoriesfilter = App\Models\ProductCategory::where('status',1)->where('parent_id', 0)->orderBy('sort_order','ASC')->get();
@endphp
<div class="sidebar">
@if(isset($info))    
<input type="hidden" value="{{isset($info->id)?$info->id:''}}" id="cat_id">
@endif
<div class="widget">
<h5 class="widget_title">Categories</h5>
@if(!$categoriesfilter->isEmpty())
<ul class="widget_categories">
@foreach($categoriesfilter as $cate) 
<li><a href="{{ url('products/'.$cate->slug_url) }}"><span class="categories_name">{{$cate->title}}</span><span class="categories_num">({{$cate->productbycategories($cate->id)}})</span></a></li>
@endforeach
</ul>
@endif
</div>
@if(!$brands->isEmpty())
<div class="widget">
<h5 class="widget_title">Brand</h5>	
<ul class="list_brand">
@foreach($brands as $brds) 
<li>
<div class="custome-checkbox">
<input class="form-check-input common_selector brand" type="checkbox" name="brand" id="{{$brds->title}}" value="{{$brds->id}}" >
<label class="form-check-label" for="{{$brds->title}}"><span>{{$brds->title}}</span></label>
</div>
</li>
@endforeach 
</ul>
</div>
@endif
@if(!$sizes->isEmpty())
<div class="widget">
<h5 class="widget_title">Size</h5>
<div class="product_size_switch" id="mySelectioncsBox">
@foreach($sizes as $size)
<span data-size="{{$size->id}}" class="common_selector size">{{$size->title}}</span>
@endforeach
</div>
</div>
@endif
@if(!$colors->isEmpty())
<div class="widget">
<h5 class="widget_title">Color</h5>
<div class="product_color_switch">
@foreach($colors as $key => $color)
<span data-color="{{$color->color_code}}"></span>
@endforeach 
</div>
</div>
@endif
<div class="widget">
<div class="shop_banner">
<div class="banner_img overlay_bg_20">
<img src="{{asset('assets/images/sidebar_banner_img.jpg')}}" alt="sidebar_banner_img">
</div> 
<div class="shop_bn_content2 text_white">
<h5 class="text-uppercase shop_subtitle">New Collection</h5>
<h3 class="text-uppercase shop_title">Sale 30% Off</h3>
<a href="#" class="btn btn-white rounded-0 btn-sm text-uppercase">Shop Now</a>
</div>
</div>
</div>
</div>