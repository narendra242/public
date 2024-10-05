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
@if(!empty($contants->description))    
<p>{!! $contants->description !!}</p>
@endif
<div class="row">
@if(!isset($info))  
@include('frontend.pages.all_blogs')
@else
@include('frontend.pages.blog_by_cates')
@endif
</div>

</div>
</div>
<!-- END SECTION SHOP -->

</div>
@endsection