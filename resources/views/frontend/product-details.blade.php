@extends('layouts.nav')
@section('content')
@php
$reviews = App\Models\Review::where('product_id',$info->id)->latest()->limit(5)->get();
@endphp
@php
$coupon = App\Models\Coupon::where('status',1)->orderBy('coupon_discount','ASC')->get();
@endphp
@php
$tag = explode(',',@$info->tag_related)
@endphp
@php
$col = explode(',',@$info->color_related)
@endphp
@php
$rprods = explode(',',@$info->cat_id)
@endphp
<div class="breadcrumb_section bg_gray page-title-mini">
<div class="container">
<!-- STRART CONTAINER -->
<div class="row align-items-center">
<div class="col-md-6">
<div class="page-title">
<h1>Shop</h1>
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

<!-- END MAIN CONTENT -->

<div class="main_content">



<!-- START SECTION SHOP -->

<div class="section">

<div class="container">

<div class="row">

<div class="col-lg-6 col-md-6 mb-4 mb-md-0">

<div class="product-image">

<div class="product_img_box">

    <img id="product_img" src='<?= (isset($info->image))?asset("product_images/$info->image"):asset('images/nocat_img.jpg') ?>' data-zoom-image="<?= (isset($info->image))?asset("product_images/$info->image"):asset('images/nocat_img.jpg') ?>" alt="product_img1">

    <a href="#" class="product_img_zoom" title="Zoom">

        <span class="linearicons-zoom-in"></span>

    </a>

</div>

<div id="pr_item_gallery" class="product_gallery_item slick_slider" data-slides-to-show="4" data-slides-to-scroll="1" data-infinite="false">

  <div class="item">

    <a href="#" class="product_gallery_item active" data-image="<?= (isset($info->image))?asset("product_images/$info->image"):asset('images/nocat_img.jpg') ?>" data-zoom-image="<?= (isset($info->image))?asset("product_images/$info->image"):asset('images/nocat_img.jpg') ?>">

        <img src="<?= (isset($info->image))?asset("product_images/$info->image"):asset('images/nocat_img.jpg') ?>" alt="product_small_img1">

    </a>

</div>

@if(!empty($info->product_images))

 @php($key=2)

 @foreach($info->product_images as $imgs)

 <div class="item">

        <a href="#" class="product_gallery_item {{$key==1?'active':''}}" data-image="<?= (isset($imgs->image))?asset("product_more_images/$imgs->image"):asset('images/nocat_img.jpg') ?>" data-zoom-image="<?= (isset($imgs->image))?asset("product_more_images/$imgs->image"):asset('images/nocat_img.jpg') ?>">

            <img src="<?= (isset($imgs->image))?asset("product_more_images/$imgs->image"):asset('images/nocat_img.jpg') ?>" alt="product_small_img{{$key}}">

        </a>

    </div>

 @endforeach

</div>

@endif

</div>

</div>

<div class="col-lg-6 col-md-6">

<div class="pr_detail">

<div class="product_description">

<h4 class="product_title" id="pname">{{$info->title}} </h4>

<div class="rating_wrap">
<div class="rating">
<div class="product_rate" style="width:80%"></div>
</div>
<span class="rating_num">{{($reviewCount?$reviewCount:0)}}</span>
</div>

<div class="product_price">

@if($info->discount == NULL) 

<span class="price"><i class="fa fa-{{$info->curIcons()}}"></i> {{$info->price}}  </span>

@else

<span class="price"><i class="fa fa-{{$info->curIcons()}}"></i> {{$info->ProductDiscount($info->price,$info->discount)}} </span>

<del><i class="fa fa-{{$info->curIcons()}}"></i> {{$info->price}} </del>

<!--<div class="on_sale">-->

<!--<span>{{$info->discount}}% Off</span>-->

<!--</div>-->

@endif   

</div>

<div class="cart-product-quantity">

<input type="hidden" id="product_id" value="{{$info->id}}">
<div class="quantity">
<input type="button" value="-" class="minus">
<input type="text" name="quantity" id="qty" value="1" title="Qty" class="qty" size="4">
<input type="button" value="+" class="plus">
</div>
</div>
<br/>

<!--<div class="pr_desc">-->
<!--<p><a href=""> </a></p>-->
<!--</div>-->

<div class="product_sort_info">
<ul>
<li><i class="linearicons-sync"></i> 7 days Return Policy</li>
<li><i class="linearicons-bag-dollar"></i> Cash on Delivery available</li>
<li><a data-bs-toggle="modal" data-bs-target="#sizeChartLong">
<i class="linearicons-chart-bars"></i>Size Chart</a> </li>
</ul>
</div>

@if(!empty($info->color_related))
<div class="pr_switch_wrap">
<span class="switch_lable">Color</span>
<div class="product_color_switch">

@php($c=1)

@foreach($info->color($col) as $color)

<span color-title="{{$color->title}}" data-color="<?php echo $color->color_code;?>"></span>

@php($c++)

@endforeach

</div>

</div>

@else

<span color-title="null" style="display:none;" class="cactive"></span>

@endif



@if(sizeof($info->product_sizes))

    <div class="pr_switch_wrap">

        <span class="switch_lable">Size</span>

        <div class="product_size_switch">

            @foreach($info->product_sizes as $size)

            <span size-title="{{$size->size_title}}">{{$size->size_title}}</span>

            @endforeach

        </div>

    </div>

    @else

    <span size-title="null" style="display:none;" class="sactive"></span>

    @endif

</div>

<div class="form-group mb-2">
@if($info->cstm_name==1)
<input type="text" name="user_name" placeholder="Enter Your Name" id="user_name" class="form-control-sm">
@else
<input type="hidden" name="user_name" id="user_name">
@endif
</div>


@if(!$coupon->isEmpty())
<div class="product_best_offer">
<h4>Shop From Our Website And Get Free Gift On Every Order.</h4>
<div class="product_best_offer_row">
    
@foreach($coupon as $copons)    
<div class="product_best_offer_item">
<div class="product_best_offer_info">Shop For Rs.{{$copons->shopping_amount}}/- And <strong> Get {{$copons->coupon_discount}}% Off On Every Order. </strong></div>
<div class="product_best_offer_code"><span class="code_info">Use Code:</span><span class="offer_code ctooltip"> <span class="copy_cope">{{$copons->coupon_name}}</span></span></div></div>
@endforeach

</div>
</div>
@endif
<div class="cart_extra"> 
<div class="cart_btn">
<div class="row">
<div class="col-6"><button  type="button" onclick="goToCart()" class="btn btn-fill-out btn-addtocart img-fullwidth" type="button">Add to cart</button></div>
<div class="col-6"><button onclick="addToCart({{$info->id}})" class="btn btn-border-fill img-fullwidth" type="button">Buy Now</button></div>
</div> 
</div>
</div>
 
<!--<div class="product_share">-->
<!--@if(!empty(GeneralHelper::Generals()->social_data)) -->
<!--<ul class="social_icons">-->
<!--@foreach(json_decode(GeneralHelper::Generals()->social_data) as $instdt)  -->
<!--<li><a href="{{$instdt->social_url}}"><i class="ion-social-{{$instdt->social_icon}}"></i></a></li>-->
<!--@endforeach-->
<!--</ul>-->
<!--@endif-->
<!--</div>-->

<!--<ul class="product-meta">-->

<!--     @if(!empty($info->product_code))<li>SKU: <a href="#">{{$info->product_code}}</a></li>@endif-->

<!--     @if(!empty($info->catslist->title))<li>Category: <a href="{{ url('products/'.$info->catslist->slug_url ) }}">{{$info->catslist->title}}</a></li>@endif-->

<!--    @if($info->tag_related!= NULL) -->

<!--    <li>Tags: -->

        

<!--    @foreach($info->tags($tag) as $tags)-->

<!--    <a href="#" rel="tag"> {{$tags->title}}</a>,-->

<!--    @endforeach-->

<!--    </li>-->

<!--    @endif-->

<!--</ul>-->


<div id="accordion" class="accordion accordion_style1">
<div class="card">
<div class="card-header" id="headingOne">
<h6 class="mb-0"> <a class="collapsed" data-bs-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Description</a> </h6>
</div>
<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-bs-parent="#accordion">
<div class="card-body">
<p>{!! strip_tags($info->short_desc) !!} </p>

</div>
</div>
</div>
<div class="card">
<div class="card-header" id="headingTwo">
<h6 class="mb-0"> <a class="collapsed" data-bs-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Features</a> </h6>
</div>
<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-bs-parent="#accordion">
<div class="card-body"> 
<p>{!! $info->description !!} </p>
</div>
</div>
</div>
<div class="card">
<div class="card-header" id="headingThree">
<h6 class="mb-0"> <a class="collapsed" data-bs-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Size &amp; Material</a> </h6>
</div>
<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-bs-parent="#accordion">
<div class="card-body"> 
<p>{!! $info->chart_size_information !!} </p>

</div>
</div>
</div>
<div class="card">
<div class="card-header" id="headingFour">
<h6 class="mb-0"> <a class="collapsed" data-bs-toggle="collapse" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">More Information</a> </h6>
</div>
<div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-bs-parent="#accordion">
<div class="card-body"> 
<p> <strong>Net Quantity:</strong> 1 N 	</p>
<p><strong>Manufactured by:</strong> The HVE Closet
  <br> 210-C, Frontier Colony, Adarsh Nagar, Jaipur-302004 (INDIA)</p>
<p><strong>Country of Origin:</strong> India</p>
<p><strong>Customer Care Address:</strong>
  <br> The HVE Closet
  <br> 210-C, Frontier Colony, Adarsh Nagar, Jaipur-302004 (INDIA)</p>
<p><strong>Email:</strong> thehvecloset@gmail.com</p>
<p><strong>Phone:</strong> +91-72299-94210 / +91-98280-57953</p>
</div>
</div>
</div>
<div class="card">
<div class="card-header" id="headingFive">
<h6 class="mb-0"> <a class="collapsed" data-bs-toggle="collapse" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">Delivery & Returns</a> </h6>
</div>
<div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-bs-parent="#accordion">
<div class="card-body"> 
<p> <strong>Delivery:</strong> It takes about 7-12 working days for domestic orders.	</p>
<p><strong>Return:</strong>  Once the The HVE Closet pieces are sold they can be exchanged either with a different product or the replacement in a bigger or smaller size, for the same product (provided the aforementioned terms and conditions are met). </p>
</div>
</div>
</div>
</div>


  


</div>

</div>

</div>

<div class="row">

<div class="col-12">

<div class="large_divider clearfix"></div>

</div>

</div>

<div class="row">

<div class="col-12">

<div class="tab-style3">

<ul class="nav nav-tabs" role="tablist">

 
  

    <li class="nav-item">

      <a class="nav-link active" id="Reviews-tab" data-bs-toggle="tab" href="#Reviews" role="tab" aria-controls="Reviews" aria-selected="true">Reviews ({{$reviewCount?$reviewCount:0}})</a>

    </li>

   
 
</ul>

<div class="tab-content shop_info_tab">

  

 

    <div class="tab-pane fade show active" id="Reviews" role="tabpanel" aria-labelledby="Reviews-tab">

    <div class="review_form field_form">

  

    <div class="reviews">

 

    <div class="product-reviews">

    <ul class="review-list">

    @foreach($reviews as $item)

    @if($item->status == 0)

    @else

    <li class="review">

    <div class="review-author">{{$item->name}}</div>

    <div class="review-rating">Rating: {{$item->star_rating}}/5</div>

    <div class="review-content">

    <p> {{$item->comment}}</p>

    </div>

    </li>

    @endif

    @endforeach

    <!-- Add more reviews as needed -->

    </ul>

    </div>



 



   </div>



    <h5>Add a review</h5>

    <form role="form" class="row mt-3" id="quickid" method="post" action="{{ route('review.store') }}">

    @csrf

    <input type="hidden" name="product_id" value="{{ $info->id }}">

    <div class="form-group col-12 mb-3">

    <div class="star_rating">

    <span data-value="1"><i class="far fa-star"></i></span>

    <span data-value="2"><i class="far fa-star"></i></span> 

    <span data-value="3"><i class="far fa-star"></i></span>

    <span data-value="4"><i class="far fa-star"></i></span>

    <span data-value="5"><i class="far fa-star"></i></span>

    </div>

    <input type="hidden" id="star_rating" name="star_rating">

    <span class="text-danger small error-text star_rating_error"> </span>

    </div>

    <div class="form-group col-12 mb-3">

    <textarea placeholder="Your review *" class="form-control" name="comments" id="comments" rows="4"></textarea>

    <span class="text-danger small error-text comments_error"> </span>

    </div>

    <div class="form-group col-md-6 mb-3">

    <input id="name" class="form-control" name="name" type="text" placeholder="Enter Name *" >

    <span class="text-danger small error-text name_error"> </span>

    </div>

    <div class="form-group col-md-6 mb-3">

    <input id="email" class="form-control" name="email" type="email" placeholder="Enter Email *" >

    <span class="text-danger small error-text email_error"> </span>    

</div>



    <div class="form-group col-12 mb-3">

    <button type="submit" id="quickid" class="btn btn-fill-out" name="submit" value="Submit">Submit Review</button>

    </div>

    </form>

        </div>

    </div>

    
</div>

</div>

</div>

</div>

<div class="row">

<div class="col-12">

<div class="small_divider"></div>

<div class="divider"></div>

<div class="medium_divider"></div>

</div>

</div>

<div class="row">

@if(!empty($info->cat_id))

<div class="col-12">

<div class="heading_s1">

<h3 class="text-center">We also Recommended</h3>

</div>

<div class="releted_product_slider carousel_slider owl-carousel owl-theme" data-margin="20" data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "1199":{"items": "4"}}'>

@foreach($info->rel_prod($rprods) as $arrival)
<div class="item">
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

</div>

@endif

</div>

</div>

</div>

<!-- END SECTION SHOP -->



</div>
@if(!empty($info->banner))
<!-- Modal -->
<div class="modal fade" id="sizeChartLong" tabindex="-1" aria-labelledby="sizeChartLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="sizeChartLabel">Size Chart</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <img src="<?= (isset($info->banner))?asset("product_images/$info->banner"):asset('images/nocat_img.jpg') ?>">
      </div>
  
    </div>
  </div>
</div>
 
@endif
<!-- END MAIN CONTENT -->

@endsection