
@extends('layouts.nav')
@section('content')
<!-- START SECTION BANNER -->
@if(!$sliders->isEmpty())
<div class="banner_section slide_medium shop_banner_slider staggered-animation-wrap">
<div id="carouselExampleControls"  data-bs-pause="flase" class="carousel slide carousel-fade light_arrow" data-bs-ride="carousel">
<div class="carousel-inner">
@foreach($sliders as $banner)  
<a href="{{ url('products/new-arrival') }}">
<div class="carousel-item active background_bg" >
<img src="<?= (isset($banner->image))?asset("banner_images/$banner->image"):''; ?>" alt="{{$banner->alt_tag}}" />

<?php /*?><div class="banner_slide_content">
<div class="container"><!-- STRART CONTAINER -->
<div class="row">
<div class="col-lg-7 col-9">
<div class="banner_content overflow-hidden"> 
<h2 class="staggered-animation" data-animation="slideInLeft" data-animation-delay="1s">{{$banner->description}}</h2><a class="btn btn-fill-out rounded-0 staggered-animation text-uppercase" href="{{$banner->web_url}}" data-animation="slideInLeft" data-animation-delay="1.5s">Shop Now</a>

</div>
</div>
</div>
</div><!-- END CONTAINER   data-img-src="<?= (isset($banner->image))?asset("banner_images/$banner->image"):''; ?>" -->
</div><?php */?>
</div>
</a>
@endforeach
</div>
<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev"><i class="ion-chevron-left"></i></a>
<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next"><i class="ion-chevron-right"></i></a>
</div>
</div>
@endif
<!-- END SECTION BANNER -->

<!-- END MAIN CONTENT -->
<div class="main_content">




@if(!empty($aboutus))
<div class="section">
<div class="container"> 	
<div class="row align-items-center flex-row-reverse"> 
<div class="col-md-6">
<div class="text-center">
<img src="<?= (isset($aboutus->image))?asset("cms_images/$aboutus->image"):''; ?>" alt="{{$aboutus->alt_tag}}">
</div>
</div>
<div class="col-md-6">
<div class="medium_divider d-none d-md-block clearfix"></div>
<div class="trand_banner_text p-3">
<div class="heading_s1 mb-3"> 
<h2>{{$aboutus->sub_title}}</h2>
<p>{!! Str::words($aboutus->description,90)!!} </p>
</div>

<a href="{{url('page/'.$aboutus->slug_url)}}" class="btn btn-line-fill rounded-0 text-uppercase">Read More</a>
</div>
<div class="medium_divider clearfix"></div>
</div>
</div>
</div>
</div>
@endif

 

@if(!$shopbycates->isEmpty())
<div class="section small_pb small_pt whatsnew">
<div class="container">
<div class="row justify-content-center">
<div class="col-md-10">
<div class="heading_s1 text-center">
<h2>Handmade and Handcrafted</h2>
<h1><span>New Arrivals
</span> </h1> 
</div>
</div>
</div>
<div class="row">
<div class="col-12">
<div class="row">
@foreach($shopbycates as $product)
<div class="col-md-3 col-6">
<div class="product_wrap">
@if($product->discount != NULL) 
<span class="pr_flash">{{{$product->discount}}}%</span>
@endif 
<div class="product_img">
    <img src="<?= (isset($product->image))?asset("product_images/$product->image"):asset('images/nocat_img.jpg') ?>" alt="el_img3">
<a href="{{ url('product/'.$product->slug_url) }}">
<img class="product_hover_img" src="<?= (isset($product->image))?asset("product_images/$product->image"):asset('images/nocat_img.jpg') ?>" alt="el_hover_img3">
</a>
<div class="product_action_box">
<ul class="list_none pr_action_btn">
<li class="add-to-cart"><a onclick="addToCart({{$product->id}})"><i class="icon-basket-loaded"></i> Add To Cart</a></li> 
<li><a id="{{$product->id}}" onclick="addToWishlist(this.id)"><i class="icon-heart"></i></a></li>
</ul>
</div>
</div> 
<div class="product_info text-center">
<div class="rating_wrap">
<div class="rating">
<div class="product_rate" style="width:100%"></div>
</div> 
</div>
<h6 class="product_title"><a href="{{ url('product/'.$product->slug_url) }}">{{$product->title}}</a></h6>
<div class="product_price">
@if($product->discount == NULL) 
<span class="price"><i class="fa fa-{{$product->curIcons()}}"></i> {{$product->price}}  </span>
@else
<span class="price"><i class="fa fa-{{$product->curIcons()}}"></i> {{$product->ProductDiscount($product->price,$product->discount)}} </span>
<del><i class="fa fa-{{$product->curIcons()}}"></i> {{$product->price}} </del>
@endif   
</div>
  
</div>
</div>
</div>
 
@endforeach
</div>
</div>
</div>
<div class="text-center">
<a href="#" class="btn btn-yellow">View All</a>
</div>
</div>
</div>
@endif



@if(!$arrivals->isEmpty())
<div class="section small_pb small_pt whatsnew">
<div class="container">
<div class="row justify-content-center">
<div class="col-md-10">
<div class="heading_s1 text-center">
<h2>In the Spotlight</h2>
<h1><span>Bestselling Collections</span> </h1>
</div>
</div>
</div> 
<div class="row">
@foreach($arrivals as $arrival)    
<div class="col-md-3 col-6">
<div class="product_wrap">
@if($arrival->discount != NULL) 
<span class="pr_flash">{{{$arrival->discount}}}%</span>
@endif 
<div class="product_img">
    <img src="<?= (isset($arrival->image))?asset("product_images/$arrival->image"):asset('images/nocat_img.jpg') ?>" alt="el_img3">
<a href="{{ url('product/'.$arrival->slug_url) }}">
<img class="product_hover_img" src="<?= (isset($arrival->image))?asset("product_images/$arrival->image"):asset('images/nocat_img.jpg') ?>" alt="el_hover_img3">
</a>
<div class="product_action_box">
<ul class="list_none pr_action_btn">
<li class="add-to-cart"><a onclick="addToCart({{$arrival->id}})"><i class="icon-basket-loaded"></i> Add To Cart</a></li> 
<li><a id="{{$arrival->id}}" onclick="addToWishlist(this.id)"><i class="icon-heart"></i></a></li>
</ul>
</div>
</div> 
<div class="product_info text-center">
<div class="rating_wrap">
<div class="rating">
<div class="product_rate" style="width:100%"></div>
</div> 
</div>
<h6 class="product_title"><a href="{{ url('product/'.$arrival->slug_url) }}">{{$arrival->title}}</a></h6>
<div class="product_price">
@if($arrival->discount == NULL) 
<span class="price"><i class="fa fa-{{$arrival->curIcons()}}"></i> {{$arrival->price}}  </span>
@else
<span class="price"><i class="fa fa-{{$arrival->curIcons()}}"></i> {{$arrival->ProductDiscount($arrival->price,$arrival->discount)}} </span>
<del><i class="fa fa-{{$arrival->curIcons()}}"></i> {{$arrival->price}} </del>
@endif   
</div>
  
</div>
</div>
</div>
@endforeach
 
</div> 
<div class="text-center">
<a href="{{route('new-arrival')}}" class="btn btn-yellow">View All</a>
</div>
</div>
</div>
@endif



@if(!$productsale->isEmpty())
<div class="section small_pb small_pt whatsnew">
<div class="container">
<div class="row justify-content-center">
<div class="col-md-10">
<div class="heading_s1 text-center">
<h2>30% - 50% Off</h2>
<h1><span>Shop with your Heart</span> </h1>
</div>
</div>
</div> 
<div class="row">
@foreach($productsale as $sale)    
<div class="col-md-3 col-6">
<div class="product_wrap">
@if($sale->discount != NULL) 
<span class="pr_flash">{{{$sale->discount}}}%</span>
@endif 
<div class="product_img">
    <img src="<?= (isset($arrival->image))?asset("product_images/$sale->image"):asset('images/nocat_img.jpg') ?>" alt="el_img3">
<a href="{{ url('product/'.$sale->slug_url) }}">
<img class="product_hover_img" src="<?= (isset($sale->image))?asset("product_images/$sale->image"):asset('images/nocat_img.jpg') ?>" alt="el_hover_img3">
</a>
<div class="product_action_box">
<ul class="list_none pr_action_btn">
<li class="add-to-cart"><a onclick="addToCart({{$sale->id}})"><i class="icon-basket-loaded"></i> Add To Cart</a></li> 
<li><a id="{{$sale->id}}" onclick="addToWishlist(this.id)"><i class="icon-heart"></i></a></li>
</ul>
</div>
</div> 
<div class="product_info text-center">
<div class="rating_wrap">
<div class="rating">
<div class="product_rate" style="width:100%"></div>
</div> 
</div>
<h6 class="product_title"><a href="{{ url('product/'.$sale->slug_url) }}">{{$sale->title}}</a></h6>
<div class="product_price">
@if($sale->discount == NULL) 
<span class="price"><i class="fa fa-{{$sale->curIcons()}}"></i> {{$sale->price}}  </span>
@else
<span class="price"><i class="fa fa-{{$sale->curIcons()}}"></i> {{$sale->ProductDiscount($sale->price,$sale->discount)}} </span>
<del><i class="fa fa-{{$arrival->curIcons()}}"></i> {{$sale->price}} </del>
@endif   
</div>
  
</div>
</div>
</div>
@endforeach
 
</div> 
<div class="text-center">
<a href="{{route('sale')}}" class="btn btn-yellow">View All</a>
</div>
</div>
</div>
@endif

<!-- START SECTION SHOP -->
@if(!$categories->isEmpty())
<div class="section small_pt small_pb">
<div class="container">
<div class="row justify-content-center"> 
<div class="col-md-10">  
<div class="heading_s1 text-center">
<h2>All Your Favorites</h2>
<h1><span>Discover Our Collection</span> </h1>
</div>
</div>
</div>
<div class="row">
<div class="col-12">
<div class="product_slider carousel_slider owl-carousel owl-theme dot_style1" data-loop="true" data-margin="10" data-responsive='{"0":{"items": "2"}, "481":{"items": "2"}, "768":{"items": "3"}, "991":{"items": "4"}}'>
 @foreach($categories as $cates)
<div class="item">
<div class="category_wrap">
<img src="<?= (isset($cates->image))?asset("category_images/$cates->image"):asset('images/no_image.jpg') ?>" alt="{{$cates->alt_tag}}" class="img-thumbnail" /> 

<div class="ctxt">
<h3> {{$cates->title}}</h3>
<a href="{{ url('products/'.$cates->slug_url) }}" class="btn btn-yellow">View All</a>
</div>
</div>    
</div>
@endforeach
</div>
</div>
</div>



</div>
</div>
@endif
<!-- END SECTION SHOP -->


<!-- START SECTION SHOP -->
<?php /*?>@if(!$discovers->isEmpty())
<div class="section small_pt small_pb">
<div class="container">
<div class="row  justify-content-center"> 
<div class="col-md-10">  
<div class="heading_s1  text-center">
<h1><span>Discover Our Collection!</span></h1>
</div>
</div>
</div>

<div class="row">
<div class="col-12">
<div class="product_slider carousel_slider owl-carousel owl-theme dot_style1" data-loop="true" data-margin="10" data-responsive='{"0":{"items": "2"}, "481":{"items": "2"}, "768":{"items": "3"}, "991":{"items": "3"}}'>
 @foreach($discovers as $discover)
<div class="item">
<div class="category_wrap">
<img src="<?= (isset($discover->image))?asset("category_images/$discover->image"):asset('images/no_image.jpg') ?>" alt="{{$discover->alt_tag}}" class="img-thumbnail" /> 

<div class="ctxt">
<img src="{{asset('assets/images/b-heart.png')}}" />
<h3> {{$discover->title}}</h3>
<a href="{{ url('products/'.$discover->slug_url) }}" class="btn btn-yellow">View All</a>
</div>
</div>    
</div>
@endforeach
</div>
</div>
</div>



</div>
</div>
@endif<?php */?>
<!-- END SECTION SHOP -->


<div class="section bg_comfort">
<div class="container-fluid"> 

<a href="/products/customised-products"><img src="<?= asset('assets/images/customised-banner.webp') ?>" alt=""></a><div class="row align-items-center"> 
<!--<div class="col-md-6">-->
<!--<div class="trand_banner_text pt-5  pb-5">-->
<!--<div class="heading_s1 mb-3"> -->
<!--<h2>Comfortable<br> Products for all</h2>-->
<!--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A aliquam amet animi blanditiis consequatur debitis dicta distinctio, enim error eum iste libero modi nam natus perferendis possimus.  </p>-->
<!--</div>-->
<!--<a href="#" class="btn btn-line-fill rounded-0 text-uppercase">Shop Now</a> -->
<!--</div>-->
<!--</div>-->
</div>
</div>
</div>




<?php /*?><div class="section insta-plugin">
<div class="container-fluid">
<div class="row justify-content-center">
<div class="col-md-10">
<div class="heading_s1 text-center">
    <h1><span>Lets be Insta Friends</span></h1> 
        <h2><a href="https://www.instagram.com/thehvecloset" target="_blank">@Thehvecloset</a></h2> 
</div>
</div>
</div>
    
@if(isset($data->data))
<div class="row">
@foreach($data->data as $post)
@if($post->media_type !== 'VIDEO')    
<div class="col-md-2 col-6">
<div class="product_box text-center">
<div class="product_img">
<a href="{{ $post->permalink }}" target="_blank">
<img src="{{ $post->media_url }}" alt="{{ $post->caption }}">
</a>
<div class="product_action_box">
<ul class="list_none pr_action_btn"> 
<li><a href="{{ $post->permalink }}" target="_blank"><i class="fab fa-instagram"></i></a></li>
</ul>
</div>
</div>
</div>
</div>
@endif
@endforeach
</div>
@else
<p>No Instagram posts available.</p>
@endif
</div>
</div><?php */?>


<?php /*?>@if(!$blogs->isEmpty())
<div class="section pb_20">
<div class="container">
<div class="row justify-content-center">
<div class="col-md-6">
<div class="heading_s1 text-center">
<h1><small>It looks trendy and at the same</small><br>
time it's very comfotable</h1>
</div>
</div>
</div>
<div class="row">
@foreach($blogs as $blog)
<div class="col-md-4">
<div class="single_banner">
<img src="<?= (isset($blog->image))?asset("blog_images/$blog->image"):asset('images/no-image-available.jpg') ?>" alt="{{$blog->alt_tag}}">
<div class="single_banner_info"> 
<h3 class="single_bn_title">{{$blog->title}}</h3>
<p>{!! Str::words(strip_tags($blog->description),17)!!} </p>
<a href="{{ url('blog/'.$blog->slug_url) }}" class="single_bn_link">Shop Now</a>
</div>
</div>
</div>
@endforeach 
</div>
</div>
</div>
@endif<?php */?>


<?php /*?><div class="section">
<div class="container"> 	
    	<div class="row align-items-center flex-row-reverse"> 
            <div class="col-md-6">
                <div class="text-center">
                    <img src="assets/images/about.png" alt="tranding_img">
                </div>
            </div>
            <div class="col-md-6">
            	<div class="medium_divider d-none d-md-block clearfix"></div>
            	<div class="trand_banner_text   p-3">
                    <div class="heading_s1 mb-3"> 
                        <h2>The HVE Closet</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A aliquam amet animi blanditiis consequatur debitis dicta distinctio, enim error eum iste libero modi nam natus perferendis possimus quasi sint sit tempora voluptatem. Lorem ipsum dolor sit amet, consectetur adipisicing elit. A aliquam amet animi blanditiis consequatur debitis dicta distinctio.</p>
                    </div>
                     
                    <a href="#" class="btn btn-line-fill rounded-0 text-uppercase">Find Your Color</a>
                </div>
            	<div class="medium_divider clearfix"></div>
            </div>
        </div>
</div>
</div><?php */?>

<?php /*?><div class="section small_pt small_pb">
<div class="container"> 
<div class="row justify-content-center">
<div class="col-md-5">
                <div class="text-center">
                    <img src="assets/images/behind-the-brand.webp" alt="tranding_img">
                </div>
            </div>
			<div class="col-md-7">
            	<div class="heading_s1 text-center">
                	<h1><span>Behind the Brand</span> </h1> 
                    <div class="trand_banner_text">
                     
                         
                        <p>THE HVE CLOSET a brand runs by HV EXPORTS, we are into export lines since 2005. We deal in handbags, pouches, fashion accessories baby products, lifestyle products, home furnishings, women's wear and kids wear. THE HVE CLOSET supports sustainable yet traditional methods for creating beautiful products for you and for your home. All our products are handmade and are made from natural materials such as cotton, canvas, silk etc. The sustainable techniques that we use to make our products include hand screen printing, block printing, digital printing, tie and dye, and others. All the products are a mixture of contemprorary and traditional look.  We deliever the best quality products at your doorstep at a very reasonable price. </p>
                     
                     
                    <a href="#" class=" text-uppercase">HANDMADE WITH LOVE AND CARE!</a>
                </div>
                </div>
            </div>
		</div>	
    	 
</div>
</div><?php */?>

<!-- START SECTION BEHIND THE BRAND -->
<div class="section behindtheBrand">
 <div class="container-fluid">
    <a href="page/about-us"><img src="<?= asset('assets/images/behind-the-brand.webp') ?>" alt=""></a>
    </div>
    </div>
<!-- END SECTION BEHIND THE BRAND -->


<!-- START SECTION SUBSCRIBE NEWSLETTER -->
<div class="section shopping_info">
@include('frontend.includes.shipping_info')
</div>
<!-- END SECTION SHOP INFO -->

<!-- START SECTION TESTIMONIAL -->
@if(!$testimonials->isEmpty())
<div class="section ">
<div class="container">
<div class="row justify-content-center">
<div class="col-md-10">
<div class="heading_s1 text-center">
<h1><span>Our Happy Customers</span> </h1>
</div>
</div>
</div>
<div class="row justify-content-center">
<div class="col-lg-10">
<div class="testimonial_wrap testimonial_style1 carousel_slider owl-carousel owl-theme nav_style2" data-nav="true" data-dots="false" data-center="true" data-loop="true" data-autoplay="true" data-items='1'>
@foreach($testimonials as $reviews)
<div class="testimonial_box">
<div class="testimonial_desc">
<p>{!! Str::words(strip_tags($reviews->description),145)!!}</p>
</div>
<div class="author_wrap">
<div class="author_img">
<img src="<?= (isset($reviews->image))?asset("testimonial_images/$reviews->image"):asset('images/testimonial1.jpg') ?>" alt="{{ $reviews->alt_tag }}">
</div>
<div class="author_name">
<h6>{{ $reviews->title }}</h6>
<span>{{ $reviews->designation }}</span>
</div>
</div>
</div>
@endforeach 
</div>
</div>
</div>
</div>
</div>
@endif
<!-- END SECTION TESTIMONIAL -->




</div>
<!-- END MAIN CONTENT -->
@endsection	 