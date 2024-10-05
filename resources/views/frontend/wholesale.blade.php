@extends('layouts.nav')
@section('content')
<div class="breadcrumb_section bg_gray page-title-mini">
<div class="container"><!-- STRART CONTAINER -->
<div class="row align-items-center">
<div class="col-md-6">
<div class="page-title">
<h1>Wholesale</h1>
</div>
</div>
<div class="col-md-6">
<ol class="breadcrumb justify-content-md-end">
<li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li> 
<li class="breadcrumb-item active">Wholesale</li>
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
<div class="contact__form">

<form method="POST" class="mb-3" autocomplete="off" id="quickid" action="{{route('wholesale.send')}}">
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

<div class="row">

<div class="col-lg-6">

<input type="text" name="name" id="name" placeholder="Customer Name">
<span class="text-danger small error-text name_error"> </span>
</div>

<div class="col-lg-6">

<input type="text" name="company_name" id="company_name" placeholder="Company Name">
<span class="text-danger small  error-text company_name_error"> </span>
</div>


<div class="col-lg-6">

<input type="email" name="email" id="email" placeholder="Email">
<span class="text-danger small error-text email_error"> </span>

</div>

<div class="col-lg-6">

<input type="text" name="phone" id="phone" placeholder="Contact No">
<span class="text-danger small error-text phone_error"> </span>
</div>


<div class="col-lg-6">

<input type="text" name="city" id="city" placeholder="City">
<span class="text-danger small error-text city_error"> </span>
</div>





<div class="col-lg-6">
<input type="text" name="product" id="product" placeholder="Product requirement">
<span class="text-danger small error-text product_error"> </span>
</div>


<div class="col-lg-6">
<input type="text" name="quantity" id="quantity" placeholder="Quantity">
<span class="text-danger small error-text quantity_error"> </span>
</div>

<div class="col-lg-12">
<textarea placeholder="Your Tour Details*" name="messages" id="messages"></textarea>
<div class="form-group">
<div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>
@if ($errors->has('g-recaptcha-response'))
<span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
@endif
<span class="text-danger small error-text g-recaptcha-response_error"> </span>
</div>


<button type="submit" class="site-btn mt-2">Send Message</button>

</div>

</div>

</form>

</div>

</div> 
</div> 
</div> 
@endsection