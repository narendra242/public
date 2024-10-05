<div id="content" class="site-content">
<div id="primary-content" class="content-area">
<main id="main" class="site-main" role="main">

<div class="wrapper">
<div class="entry-banner-inner">
<div class="text-wrap">
<div class="text-col">
    <h1>{{$info->title}}</h1>
    <p>{!!$info->description!!}<br></p>
    </div>
</div>
<div class="image-wrap">
<img src="{{asset('images/category-inner.jpg')}}" alt="color_banner_image_section1">
</div>
</div>  
</div>

@include('includes.filter_list')
 
@if(!empty($info->productbycategories($info->id)))
<div class="colorgridDiv">
<div class="products-wrap">
<div class="wrapper">
<div class="row">               
@foreach($info->productbycategories($info->id) as $product)  
<div class="col-md-4 col-sm-6 col-6" data-aos="fade-in" data-aos-duration="1000">
<div class="product-col">
<div class="img-col">
<a href="{{ url('product/'.$product->slug_url) }}" class="">  
<img src="<?= (isset($product->image))?asset("product_images/$product->image"):asset('images/nocat_img.jpg') ?>"  class="img-fullwidth" alt="{{$product->alt_tag}}">
</a>
</div>
<a href="{{ url('product/'.$product->slug_url) }}" class=""><h3>{{$product->title}}</h3></a> 
<p>
@if($product->discount == NULL) 
<i class="fa fa-{{$product->curIcons()}}"></i> {{$product->price}}  
@else
{{$product->ProductDiscount($product->price,$product->discount)}} <span>
<i class="fa fa-{{$product->curIcons()}}"></i> 
{{$product->price}}
@endif    
</p>
<a class="read-more" id="{{$product->id}}" onclick="productView(this.id)">Add to Cart</a>
</div>
</div>
@endforeach          
</div>
</div>
</div>
</div>
@endif
</main>
</div>
</div>