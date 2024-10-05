@extends('layouts.nav')
@section('content')


<!-- inner banner -->
<section class="inner-banner">  
@if(isset($info->banner))
<div class="innerbanner"><img src="<?= (asset("cms_images/".$info->banner.""))?>" class="img-fullwidth" /></div>
@endif
</section>


<div class="breadcrumb_section bg_gray page-title-mini">
<div class="container"><!-- STRART CONTAINER -->
<div class="row align-items-center">
<div class="col-md-6">
<div class="page-title">
<h1>{{$info->title}}</h1>
</div>
</div>
<div class="col-md-6">
<ol class="breadcrumb justify-content-md-end">
<li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li> 
<li class="breadcrumb-item active">{{$info->title}}</li>
</ol>
</div>
</div>
</div><!-- END CONTAINER-->
</div>


<div class="main_content">
<!-- STAT SECTION ABOUT --> 
<div class="section">
<div class="container">
<div class="row align-items-center">
<div class="col-lg-12">
<div class="heading_s1">
<!--<h2>{{$info->title}}</h2>-->
</div>
@if(!empty($info->image))
<img src="<?= (isset($info->image))?asset("cms_images/$info->image"):asset('images/nocat_img.jpg') ?>" alt="{{$info->alt_tag}}" align="right" class="ml-5">
@endif
<div class="cmstext">
<p>{!! $info->description !!}</p>
</div>

</div>

</div>

</div>

</div>

<!-- END SECTION ABOUT --> 



<!-- START SECTION WHY CHOOSE --> 

<?php /*?><div class="section bg_light_blue2 pb_70">

<div class="container">

<div class="row justify-content-center">

<div class="col-lg-6 col-md-8">

<div class="heading_s1 text-center">

<h2>Why Choose Us?</h2>

</div>

<p class="text-center leads">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</p>

</div>

</div>

<div class="row justify-content-center">

<div class="col-lg-4 col-sm-6">

<div class="icon_box icon_box_style4 box_shadow1">

<div class="icon">

<i class="ti-pencil-alt"></i>

</div>

<div class="icon_box_content">

<h5>Creative Design</h5>

<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form</p>

</div>

</div>

</div>

<div class="col-lg-4 col-sm-6">

<div class="icon_box icon_box_style4 box_shadow1">

<div class="icon">

<i class="ti-layers"></i>

</div>

<div class="icon_box_content">

<h5>Flexible Layouts</h5>

<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form</p>

</div>

</div>

</div>

<div class="col-lg-4 col-sm-6">

<div class="icon_box icon_box_style4 box_shadow1">

<div class="icon">

<i class="ti-email"></i>

</div>

<div class="icon_box_content">

<h5>Email Marketing</h5>

<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form</p>

</div>

</div>

</div>

</div>

</div>

</div><?php */?>

<!-- END SECTION WHY CHOOSE --> 

</div>

@endsection