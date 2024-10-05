@foreach($products as $product)
<div class="col-md-4 col-6">
<div class="product">
<div class="product_img">
<a href="{{ url('product/'.$product->slug_url) }}">
<img src="<?= (isset($product->image))?asset("product_images/$product->image"):asset('images/nocat_img.jpg') ?>" alt="{{$product->alt_tag}}">
</a>
<div class="product_action_box">
<ul class="list_none pr_action_btn">
<li class="add-to-cart"><a onclick="addToCart({{$product->id}})"><i class="icon-basket-loaded"></i> Add To Cart</a></li> 
<li><a id="{{$product->id}}" onclick="addToWishlist(this.id)"><i class="icon-heart"></i></a></li>
</ul>
</div>
</div>
<div class="product_info">
<h6 class="product_title"><a href="{{ url('product/'.$product->slug_url) }}">{{$product->title}}</a></h6>
<div class="product_price">
@if($product->discount == NULL) 
<span class="price"><i class="fa fa-{{$product->curIcons()}}"></i> {{$product->price}}  </span>
@else
<span class="price"><i class="fa fa-{{$product->curIcons()}}"></i> {{$product->ProductDiscount($product->price,$product->discount)}} </span>
<del><i class="fa fa-{{$product->curIcons()}}"></i> {{$product->price}} </del>
<!--<div class="on_sale">-->
<!--<span>{{$product->discount}}% Off</span>-->
<!--</div>-->
@endif   
</div>
<div class="rating_wrap">
<div class="rating">
<div class="product_rate" style="width:100%"></div>
</div> 
</div>
<div class="pr_desc">
<p>{!! Str::words(strip_tags($product->short_desc), 18) !!} </p>
</div>

<div class="list_product_action_box">
<ul class="list_none pr_action_btn">
<li class="add-to-cart"><a onclick="addToCart({{$product->id}})"><i class="icon-basket-loaded"></i> Add To Cart</a></li> 
<li><a id="{{$product->id}}" onclick="addToWishlist(this.id)"><i class="icon-heart"></i></a></li>
</ul>
</div>
</div>
</div>
</div> 
@endforeach  