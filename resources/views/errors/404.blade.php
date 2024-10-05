@extends('layouts.nav')
@section('content')
<!-- Breadcrumb Section Begin -->
<div class="breadcrumb_section bg_gray page-title-mini">
<div class="container"><!-- STRART CONTAINER -->
<div class="row align-items-center">
<div class="col-md-6">
<div class="page-title">
<h1>404 Error</h1>
</div>
</div>
<div class="col-md-6">
<ol class="breadcrumb justify-content-md-end">
<li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li> 
<li class="breadcrumb-item"><a href="">404 Error</a></li>
</ol>
</div>
</div>
</div><!-- END CONTAINER-->
</div>

<div class="x-page inner-bottom-sm mb-5">
<div class="row">
<div class="col-md-12 x-text text-center">
<h1>404</h1>
<p>We are sorry, the page you've requested is not available. </p>

<a href="{{route('index')}}"><i class="fa fa-home"></i> Go To Homepage</a>
</div>
</div><!-- /.row -->
</div>

@endsection