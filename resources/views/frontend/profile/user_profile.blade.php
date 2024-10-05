@extends('layouts.nav')
@section('content')
<!-- Breadcrumb Section Begin -->
<div class="breadcrumb_section bg_gray page-title-mini">
<div class="container"><!-- STRART CONTAINER -->
<div class="row align-items-center">
<div class="col-md-6">
<div class="page-title">
<h1>User Profile</h1>
</div>
</div>
<div class="col-md-6">
<ol class="breadcrumb justify-content-md-end">
<li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li> 
<li class="breadcrumb-item active">User Profile</li>
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
<h3>User Profile</h3>
</div>
<div class="card-body">
<form method="post" action="{{route('user.profile.store')}}" enctype="multipart/form-data">
@csrf

<div class="form-group mb-2">
<label class="info-title" for="exampleInputName">Name <span></span></label>
<input type="text" name="name" class="form-control" value="{{$user->name}}">
</div>


<div class="form-group mb-2">
<label class="info-title" for="exampleInputEmail">Email <span></span></label>
<input type="email" name="email" class="form-control" value="{{$user->email}}">
</div>

<div class="form-group mb-2">
<label class="info-title" for="exampleInputPhone">Phone <span></span></label>
<input type="text" name="phone" class="form-control" value="{{$user->phone}}">
</div>

<div class="form-group mb-2">
<label class="info-title" for="exampleInputPhoto">User Image <span></span></label>
<input type="file" name="profile_photo_path" class="form-control">
</div>

<div class="form-group mb-2">
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