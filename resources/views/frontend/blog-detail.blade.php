@extends('layouts.nav')
@section('content')
<div class="breadcrumb_section bg_gray page-title-mini">
<div class="container"><!-- STRART CONTAINER -->
<div class="row align-items-center">
<div class="col-md-6">
<div class="page-title">
<h1>Blog</h1>
</div>
</div>
<div class="col-md-6">
<ol class="breadcrumb justify-content-md-end">
<li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li> 
<li class="breadcrumb-item"><a href="{{route('blog')}}">Blog</a></li>
@if(isset($info))<li class="breadcrumb-item active"> {{$info->title}}</li> @endif
</ol>
</div>
</div>
</div><!-- END CONTAINER-->
</div>

 
<div class="main_content">

<!-- START SECTION SHOP -->
<div class="section">
<div class="container">
<div class="row">
<div class="col-xl-9">
<div class="single_post">
<h2 class="blog_title">{{$info->title}}</h2>
<ul class="list_none blog_meta">
<li><a href="{{ url('blog/'.$info->slug_url) }}"><i class="ti-calendar"></i>{{ date_format(date_create($info->blog_date),'d M Y') }}</a></li>
<li><a href="{{ url('blog/'.$info->slug_url) }}"><i class="ti-comments"></i> {{$info->author_name}}</a></li>
</ul>
<div class="blog_img">
<img src="<?= (isset($info->image))?asset("blog_images/$info->image"):asset('images/shape_186.svg') ?>" alt="{{$info->alt_tag}}">
</div>
<div class="blog_content">
<div class="blog_text">
<p>{!! $info->description !!} </p>
</div>
</div>
</div>
@include('frontend.includes.blog_comment_form')
</div>
<div class="col-xl-3 mt-4 pt-2 mt-xl-0 pt-xl-0">
@include('frontend.includes.blog_right_part')
</div>
</div>
</div>
</div>
<!-- END SECTION SHOP -->

</div>
@endsection