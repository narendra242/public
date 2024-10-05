<div id="content" class="site-content">
<div id="primary-content" class="content-area">
<main id="main" class="site-main" role="main">
<div class="entry-banner" id="banner-artize-signature">		
<div class="entry-banner-image-wrap">
@if(!empty($info->banner))  
<div class="jarallax-img"><img src="<?= (asset("category_images/".$info->banner.""))?>" class="img-fullwidth" /></div>
@else 
<div class="jarallax-img"><img src="<?= (asset("images/inner-banner.jpg")) ?>" class="img-fullwidth" /></div>
@endif 
</div>
<div class="text-wrap">
<div class="wrapper">
<div class="text-col">
<h1>{{$info->title}}</h1>
<p>{!! $info->description!!}</p>
</div>
</div>
</div>
</div>

<div>

<div id="home-feature-collection">
<h2 class="title">{{$info->title}}</h2>
<div class="wrapper">
<div class="inner-wrapper">
<div class="signature-collections-wrap">
<div class="row">
@foreach($info->subcategory as $subcates)    
<div class="col-md-4 col-sm-6 col-6 mb-5 aos-init aos-animate" data-aos="fade-in" data-aos-duration="1200">
    <div class="collection-cat-col">
        <div class="img-col">
        <a href="{{ url('products/'.$subcates->slug_url) }}"> 
            <img src="<?= (isset($subcates->image))?asset("category_images/$subcates->image"):asset('images/nocat_img.jpg') ?>" alt="{{$subcates->alt_tag}}" class="img-fullwidth">
        </a> 
        </div>  
        <h3><a class="read-more" href="{{ url('products/'.$subcates->slug_url) }}">{{$subcates->title}}</a></h3>
    </div>
    </div>
@endforeach   
              
</div>
</div>
</div> 
</div>
</div></div>


</main>
</div>
</div>
