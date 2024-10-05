@extends('layouts.nav')
@section('content')
<div class="breadcrumb_section bg_gray page-title-mini">
<div class="container"><!-- STRART CONTAINER -->
<div class="row align-items-center">
<div class="col-md-6">
<div class="page-title">
<h1>Change Password</h1>
</div>
</div>
<div class="col-md-6">
<ol class="breadcrumb justify-content-md-end">
<li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li> 
<li class="breadcrumb-item active">Change Password</li>
</ol>
</div>
</div>
</div><!-- END CONTAINER-->
</div>
<!-- Breadcrumb Section Begin -->
<!-- @php
$user = DB::table('users')->where('id',Auth::user()->id)->first();
@endphp -->
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
<h3 class="card-title">Change Password</h3>
</div>

<div class="card-body">
<form method="post" action="{{route('user.password.update')}}" enctype="multipart/form-data">
@csrf

<div class="form-group">
<label class="info-title" for="exampleInputName">Current Password <span></span></label>
<input type="password" name="oldpassword" id="current_password" class="form-control">
</div>

<div class="form-group">
<label class="info-title" for="exampleInputEmail">New Password <span></span></label>
<input type="password" name="password" id="password" class="form-control">
</div>

<div class="form-group">
<label class="info-title" for="exampleInputPhone">Confirm Password <span></span></label>
<input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
</div>


<div class="form-group">
<button type="submit" class="btn btn-danger">Update</button>
</div>
</form>
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