@extends('layouts.nav')
@section('content')
<div id="content" class="site-content">
<div id="primary-content" class="content-area">
<main id="main" class="site-main" role="main">
<div class="entry-banner jarallax parallax-entry-banner">
@if(!empty($contant->image))  
<div class="jarallax-img"><img src="<?= (asset("contant_images/".$contants->image.""))?>" class="img-fullwidth" /></div>
@else 
<div class="jarallax-img"><img src="<?= (asset("images/inner-banner.jpg")) ?>" class="img-fullwidth" /></div>
@endif 
</div>

<div class="wrapper">
<h1 class="entry-title">{{$info->title}}</h1>
<div class="inner-wrapper">
<div class="row">
<div class="col-md-12 my-auto">
<div class="text-wrap"> 
<p class="entry-para">{!! $info->description !!}</p>
</div>	
</div>
</div>
</div>
</div>
</main>
</div>
</div>
@endsection