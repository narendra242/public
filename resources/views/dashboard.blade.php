@extends('layouts.nav')
@section('content')
<div class="breadcrumb_section bg_gray page-title-mini">
<div class="container"><!-- STRART CONTAINER -->
<div class="row align-items-center">
<div class="col-md-6">
<div class="page-title">
<h1>User Account</h1>
</div>
</div>
<div class="col-md-6">
<ol class="breadcrumb justify-content-md-end">
<li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li> 
<li class="breadcrumb-item active">User Account</li>
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
<div class="col-lg-3 col-md-4">
@include('frontend.common.user_sidebar')    
</div>
<div class="col-lg-9 col-md-8">
<div class="card">
<div class="card-header">
<h3><span class="text-danger">Hi...</span><strong>{{Auth::user()->name}}</strong></h3>
</div>
</div>
</div>
</div>
</div>
</div>
<!-- END SECTION SHOP -->

</div>
<!-- END MAIN CONTENT -->
 
@endsection