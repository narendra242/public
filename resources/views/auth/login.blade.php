@extends('layouts.nav')
@section('content')
<div class="breadcrumb_section bg_gray page-title-mini">
<div class="container"><!-- STRART CONTAINER -->
<div class="row align-items-center">
<div class="col-md-6">
<div class="page-title">
<h1>Login</h1>
</div>
</div>
<div class="col-md-6">
<ol class="breadcrumb justify-content-md-end">
<li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li> 
<li class="breadcrumb-item active">Login</li>
</ol>
</div>
</div>
</div><!-- END CONTAINER-->
</div>


<div class="main_content">

<!-- START SECTION SHOP -->
<div class="login_register_wrap section">
<div class="container">
<div class="row justify-content-center">
<div class="col-xl-6 col-md-10">
<div class="login_wrap">
<div class="padding_eight_all bg-white">
<div class="heading_s1">
<h3>Login</h3>
<x-auth-session-status class="mb-4" :status="session('status')" />
</div>
<form method="POST" action="{{ route('login') }}">
@csrf
<div class="form-group mb-3">
<x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Email" />
<x-input-error :messages="$errors->get('email')" class="mt-2" />
</div>
<div class="form-group mb-3"><x-text-input id="password" class="form-control" type="password"
    name="password" placeholder="Password" required autocomplete="current-password" />
<x-input-error :messages="$errors->get('password')" class="mt-2" />
</div>
<div class="login_footer form-group mb-3">
<div class="chek-form">
<div class="custome-checkbox">
    <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox1" value="">
    <label class="form-check-label" for="exampleCheckbox1"><span>Remember me</span></label>
</div>
</div>  
@if (Route::has('password.request'))        
<a href="{{ route('password.request') }}">Forgot password?</a>
@endif
</div>
<div class="form-group mb-3">
<button type="submit" class="btn btn-fill-out btn-block" name="login"> {{ __('Log in') }}</button>
</div>
</form>
<div class="different_login">
<span> or</span>
</div>
<ul class="btn-login list_none text-center">
<li><a href="#" class="btn btn-facebook"><i class="ion-social-facebook"></i>Facebook</a></li>
<li><a href="#" class="btn btn-google"><i class="ion-social-googleplus"></i>Google</a></li>
</ul>
<div class="form-note text-center">Don't Have an Account? <a href="{{route('register')}}">Sign up now</a></div>
</div>
</div>
</div>
</div>
</div>
</div>
<!-- END SECTION SHOP -->

</div>
 
@endsection