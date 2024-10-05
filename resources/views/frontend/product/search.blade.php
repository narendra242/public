@extends('layouts.nav')
@section('content')
<!-- Breadcrumb Section Begin -->
<div class="breadcrumb_section bg_gray page-title-mini">
<div class="container">
<!-- STRART CONTAINER -->
<div class="row align-items-center">
<div class="col-md-6">
<div class="page-title">
<h1>Search</h1>
</div>
</div>
<div class="col-md-6">
<ol class="breadcrumb justify-content-md-end">
<li class="breadcrumb-item "><a href="{{route('index')}}"><i class="fa fa-home"></i></a></li>
<li class="breadcrumb-item "><a href="{{route('products')}}">Search</a></li>
</ol>
</div>
</div>
</div><!-- END CONTAINER-->
</div>
<!-- Breadcrumb Section End -->
<div class="main_content">
<!-- START SECTION SHOP -->
<div class="section">
@if(!$products->isEmpty())
<div class="container">
@if(!empty($contants->description))    
<p>{!! $contants->description !!}</p>
@endif
<div class="row">
@foreach($products as $search)
<div class="col-md-3 col-6">
<div class="product_wrap">
<div class="product_img">
    <img src="<?= (isset($search->image))?asset("product_images/$search->image"):asset('images/nocat_img.jpg') ?>" alt="el_img3">
<a href="{{ url('product/'.$search->slug_url) }}">
<img class="product_hover_img" src="<?= (isset($search->image))?asset("product_images/$search->image"):asset('images/nocat_img.jpg') ?>" alt="el_hover_img3">
</a>
 
<div class="product_action_box">
<ul class="list_none pr_action_btn">
<li class="add-to-cart">
@if(sizeof($search->product_sizes) || !empty($search->color_related))
<a href="{{ url('product/'.$search->slug_url) }}"><i class="icon-basket-loaded"></i></a>
@else
<a onclick="addToCart({{$search->id}})"><i class="icon-basket-loaded"></i></a>
@endif     
</li> 
<li><a id="{{$search->id}}" onclick="addToWishlist(this.id)"><i class="icon-heart"></i></a></li>
</ul>
</div>
</div>
<div class="product_info">
<h6 class="product_title"><a href="{{ url('product/'.$search->slug_url) }}">{{$search->title}}</a></h6>
<div class="product_price">
@if($search->discount == NULL) 
<span class="price"><i class="fa fa-{{$search->curIcons()}}"></i> {{$search->price}}  </span>
@else
<span class="price"><i class="fa fa-{{$search->curIcons()}}"></i> {{$search->ProductDiscount($search->price,$search->discount)}} </span>
<del><i class="fa fa-{{$search->curIcons()}}"></i> {{$search->price}} </del>
<!--<div class="on_sale">-->
<!--<span>{{$search->discount}}% Off</span>-->
<!--</div>-->
@endif   
</div>
<div class="rating_wrap">
<div class="rating">
<div class="product_rate" style="width:100%"></div>
</div> 
</div>
<div class="pr_desc">
<p>{!! Str::words(strip_tags($search->short_desc), 18) !!} </p>
</div>
</div>
</div>
</div> 
@endforeach
</div>   
</div> 
@endif
</div> 
</div> 
@endsection