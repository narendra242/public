@extends('layouts.nav')

@section('content')

<div class="breadcrumb_section bg_gray page-title-mini">

<div class="container"><!-- STRART CONTAINER -->

<div class="row align-items-center">

<div class="col-md-6">

<div class="page-title">

<h1>Contact Us</h1>

</div>

</div>

<div class="col-md-6">

<ol class="breadcrumb justify-content-md-end">

<li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li> 

<li class="breadcrumb-item active">Contact Us</li>

</ol>

</div>

</div>

</div><!-- END CONTAINER-->

</div>





<div class="main_content">



<!-- START SECTION CONTACT -->

<div class="section pb_70">

<div class="container">

<div class="row">

<div class="col-xl-4 col-md-6">

<div class="contact_wrap contact_style3">

<div class="contact_icon">

<i class="linearicons-map2"></i>

</div>

<div class="contact_text">

<span>Address</span>

<p>{!! $general->address !!}</p>

</div>

</div>

</div>

<div class="col-xl-4 col-md-6">

<div class="contact_wrap contact_style3">

<div class="contact_icon">

<i class="linearicons-envelope-open"></i>

</div>

<div class="contact_text">

<span>Email Address</span>

<a href="mailto:{{ $general->email }}">{{ $general->email }} </a>

</div>

</div>

</div>

<div class="col-xl-4 col-md-6">

<div class="contact_wrap contact_style3">

<div class="contact_icon">

<i class="linearicons-tablet2"></i>

</div>

<div class="contact_text">

<span>Phone</span>

<p>{{ $general->phone }}</p>

</div>

</div>

</div>

</div>

</div>

</div>

<!-- END SECTION CONTACT -->



<!-- START SECTION CONTACT -->

<div class="section pt-0">

<div class="container">

<div class="row">

<div class="col-lg-6">

<div class="heading_s1">

<h2>Get In touch</h2>

</div>

<?php /*?><p class="leads">&nbsp;</p><?php */?>

<div class="field_form">

<form method="POST" autocomplete="off" id="quickid" action="{{route('contact.send')}}">

<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

<div class="row">

<div class="form-group col-md-6 mb-3">

<input placeholder="Enter Name *" id="name" class="form-control" name="name" type="text">

<span class="text-danger small error-text name_error" id="name_error"></span>

</div>

<div class="form-group col-md-6 mb-3">

<input placeholder="Enter Email *" id="email" class="form-control" name="email" type="email">

<span class="text-danger small error-text email_error" id="email_error"></span>

</div>

<div class="form-group col-md-6 mb-3">

<input placeholder="Enter Phone No. *" id="phone" class="form-control" name="phone">

<span class="text-danger small error-text phone_error" id="phone_error"></span>

</div>

<div class="form-group col-md-6 mb-3">

<input placeholder="Enter City" id="city" class="form-control" name="city">

<span class="text-danger small error-text city_error" id="city_error"></span>



</div>

<div class="form-group col-md-12 mb-3">

<textarea placeholder="Message *" id="messages" class="form-control" name="messages" rows="4"></textarea>

</div>



<div class="form-group col-md-12 mb-3">

<div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>

@if ($errors->has('g-recaptcha-response'))

<span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>

@endif

<span class="text-danger small error-text g-recaptcha-response_error"> </span>

</div>



<div class="col-md-12 mb-3">

<input type="hidden" class="form-control" name="page_url" id="page_url" value="{{url()->current()}}">

<button type="submit" title="Submit Your Message!" class="btn btn-fill-out" id="quickid" name="submit" value="Submit">Send Message</button>

</div>

 

</div>

</form>		

</div>

</div>

<div class="col-lg-6 pt-2 pt-lg-0 mt-4 mt-lg-0">

@if($general->gmap)

<iframe src="{{ $general->gmap }}" width="100%" height="500" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

@endif

</div>

</div>

</div>

</div>

<!-- END SECTION CONTACT -->

</div>

 

@endsection