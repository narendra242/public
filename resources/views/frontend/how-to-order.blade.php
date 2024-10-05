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


</main>
</div>
</div>
@endsection