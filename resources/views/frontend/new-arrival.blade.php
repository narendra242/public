@extends('layouts.nav')
@section('content')
<div class="breadcrumb_section bg_gray page-title-mini">
<div class="container"><!-- STRART CONTAINER -->
<div class="row align-items-center">
<div class="col-md-6">
<div class="page-title">
<h1>New Arrival</h1>
</div>
</div>
<div class="col-md-6">
<ol class="breadcrumb justify-content-md-end">
<li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li> 
<li class="breadcrumb-item active">New Arrival</li>
</ol>
</div>
</div>
</div><!-- END CONTAINER-->
</div>

<div class="main_content">
<!-- START SECTION SHOP -->
<div class="section">
@if(!$arrivals->isEmpty())
<div class="container">
@if(!empty($contants->description))    
<p>{!! $contants->description !!}</p>
@endif
<div class="row">
@foreach($arrivals as $arrival)
<div class="col-md-3 col-6">
<div class="product">
<div class="product_img">
<a href="{{ url('product/'.$arrival->slug_url) }}">
<img src="<?= (isset($arrival->image))?asset("product_images/$arrival->image"):asset('images/nocat_img.jpg') ?>" alt="{{$arrival->alt_tag}}">
</a>
<div class="product_action_box">
<ul class="list_none pr_action_btn">
<li class="add-to-cart">
@if(sizeof($arrival->product_sizes) || !empty($arrival->color_related))
<a href="{{ url('product/'.$arrival->slug_url) }}"><i class="icon-basket-loaded"></i></a>
@else
<a onclick="addToCart({{$arrival->id}})"><i class="icon-basket-loaded"></i></a>
@endif       
</li> 
<li><a id="{{$arrival->id}}" onclick="addToWishlist(this.id)"><i class="icon-heart"></i></a></li>
</ul>
</div>
</div>
<div class="product_info">
<h6 class="product_title"><a href="{{ url('product/'.$arrival->slug_url) }}">{{$arrival->title}}</a></h6>
<div class="product_price">
@if($arrival->discount == NULL) 
<span class="price"><i class="fa fa-{{$arrival->curIcons()}}"></i> {{$arrival->price}}  </span>
@else
<span class="price"><i class="fa fa-{{$arrival->curIcons()}}"></i> {{$arrival->ProductDiscount($arrival->price,$arrival->discount)}} </span>
<del><i class="fa fa-{{$arrival->curIcons()}}"></i> {{$arrival->price}} </del>
<!--<div class="on_sale">-->
<!--<span>{{$arrival->discount}}% Off</span>-->
<!--</div>-->
@endif   
</div>
<div class="rating_wrap">
<div class="rating">
<div class="product_rate" style="width:100%"></div>
</div> 
</div>
<div class="pr_desc">
<p>{!! Str::words(strip_tags($arrival->short_desc), 18) !!} </p>
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