@extends('layouts.nav')
@section('content')
<div class="breadcrumb_section bg_gray page-title-mini">
<div class="container"><!-- STRART CONTAINER -->
<div class="row align-items-center">
<div class="col-md-6">
<div class="page-title">
<h1>Register</h1>
</div>
</div>
<div class="col-md-6">
<ol class="breadcrumb justify-content-md-end">
<li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li> 
<li class="breadcrumb-item active">Register</li>
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
    <h3>Create an Account</h3>
</div>
<form method="POST" action="{{ route('register') }}">
@csrf
<div class="form-group mb-3">
<x-input-label for="name" :value="__('Name')" />    
<x-text-input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
<x-input-error :messages="$errors->get('name')" class="mt-2" />    
</div>
<div class="form-group mb-3">
<x-input-label for="email" :value="__('Email')" />
<x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autocomplete="username" />
<x-input-error :messages="$errors->get('email')" class="mt-2" />
</div>
<div class="form-group mb-3">
<x-input-label for="password" :value="__('Password')" />    
<x-text-input id="password" class="form-control" type="password" name="password"
required autocomplete="new-password" />
<x-input-error :messages="$errors->get('password')" class="mt-2" />
</div>
<div class="form-group mb-3">
<x-input-label for="password_confirmation" :value="__('Confirm Password')" />
<x-text-input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
<x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
</div>
<div class="login_footer form-group mb-3">
<div class="chek-form">
<div class="custome-checkbox">
<input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox2" value="">
<label class="form-check-label" for="exampleCheckbox2"><span>I agree to terms &amp; Policy.</span></label>
</div>
</div>
</div>
<div class="form-group mb-3">
<button type="submit" class="btn btn-fill-out btn-block" name="register"> {{ __('Register') }}</button>
</div>
</form>
<div class="different_login">
    <span> or</span>
</div>
<ul class="btn-login list_none text-center">
    <li><a href="#" class="btn btn-facebook"><i class="ion-social-facebook"></i>Facebook</a></li>
    <li><a href="#" class="btn btn-google"><i class="ion-social-googleplus"></i>Google</a></li>
</ul>
<div class="form-note text-center">{{ __('Already registered?') }} <a href="{{route('login')}}">Log in</a></div>
</div>
</div>
</div>
</div>
</div>
</div>
<!-- END SECTION SHOP -->
</div>
@endsection