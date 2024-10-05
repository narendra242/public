@extends('layouts.nav')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="breadcrumb_section bg_gray page-title-mini">
<div class="container"><!-- STRART CONTAINER -->
<div class="row align-items-center">
<div class="col-md-6">
<div class="page-title">
<h1>Checkout</h1>
</div>
</div>
<div class="col-md-6">
<ol class="breadcrumb justify-content-md-end">
<li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li> 
<li class="breadcrumb-item active">Checkout</li>
</ol>
</div>
</div>
</div><!-- END CONTAINER-->
</div>

 @if($message = Session::get('error'))
<div class="alert alert-danger alert-dismissible fade in" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">×</span>
</button>
<strong>Error!</strong> {{ $message }}
</div>
@endif
<div class="alert alert-success success-alert alert-dismissible fade show" role="alert" style="display: none;">
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">×</span>
</button>
<strong>Success!</strong> <span class="success-message"></span>
</div>
{{ Session::forget('success') }}
<!-- Breadcrumb Section End -->
<div class="main_content">
<!-- START SECTION SHOP -->
<div class="section">
<div class="container">
<div class="row">
<div class="col-lg-6">
<div class="toggle_info">
@auth
<span><i class="fas fa-user"></i><strong>User :</strong> {{ Auth::user()->name }}</span>
@else
<span><i class="fas fa-user"></i>Returning customer? <a href="#loginform" data-bs-toggle="collapse" class="collapsed" aria-expanded="false">Click here to login</a></span>
@endauth

</div>
<div class="panel-collapse collapse login_form" id="loginform">
<div class="panel-body">
<p>If you have shopped with us before, please enter your details below. If you are a new customer, please proceed to the Billing &amp; Shipping section.</p>
<form method="POST" action="{{ route('login') }}">
@csrf
<div class="form-group mb-3">
<x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Email" />
<x-input-error :messages="$errors->get('email')" class="mt-2" />
</div>
<div class="form-group mb-3">
<x-text-input id="password" class="form-control" type="password"
name="password" placeholder="Password" required autocomplete="current-password" />
<x-input-error :messages="$errors->get('password')" class="mt-2" />
</div>
<div class="login_footer form-group mb-3">
<div class="chek-form">
<div class="custome-checkbox">
<input class="form-check-input" type="checkbox" name="checkbox" id="remember" value="">
<label class="form-check-label" for="remember"><span>Remember me</span></label>
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
</div>
</div>
</div>
<div class="col-lg-6">
<div class="toggle_info">
@if(Session::has('coupon'))    
<span><i class="fas fa-tag"></i><strong>Coupon</strong>: {{session()->get('coupon')['coupon_name']}}</span>
@else
<span><i class="fas fa-tag"></i>Have a coupon? <a href="#coupon" data-bs-toggle="collapse" class="collapsed" aria-expanded="false">Click here to enter your code</a></span>
@endif

</div>
<div class="panel-collapse collapse coupon_form" id="coupon">
<div class="panel-body"  id="couponField">
<p>If you have a coupon code, please apply it below.</p>
<div class="coupon field_form input-group">
<input type="text"id="coupon_name" class="form-control" placeholder="Enter Coupon Code..">
<div class="input-group-append">
<button class="btn btn-fill-out btn-sm" type="submit" onclick="applyCoupon()">Apply Coupon</button>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-12">
<div class="medium_divider"></div>
<div class="divider center_icon"><i class="linearicons-credit-card"></i></div>
<div class="medium_divider"></div>
</div>
</div>
<form class="register-form" id="chs_now" action="{{route('checkout.store')}}" method="POST">
@csrf
<div class="row">
<div class="col-md-6">
<div class="heading_s1">
<h4>Billing Details</h4>
</div>

<div class="form-group mb-3">
    <input type="text" id="shipping_name" class="form-control" name="shipping_name" value="{{isset(Auth::user()->email)?Auth::user()->email:''}}" placeholder="Full name *">
    <span class="text-danger small error-text shipping_name_error" id="shipping_name_error"></span>

</div>
 
<div class="form-group mb-3">
    <input class="form-control" id="shipping_email" type="text" name="shipping_email" value="{{isset(Auth::user()->name)?Auth::user()->name:''}}" placeholder="Email">
    <span class="text-danger small error-text shipping_email_error" id="shipping_email_error"></span>
</div>
<div class="form-group mb-3">
<div class="custom_select">
<select class="form-control" id="district_id" name="district_id">
<option value="">Select State</option>
@foreach($districts as $item)
<option value="{{$item->id}}">{{$item->district_name}}</option>
@endforeach
</select>
<span class="text-danger small error-text district_id_error" id="district_id_error"></span>
</div>
</div>
 
<div class="form-group mb-3">
<input class="form-control" id="state_id" type="text" name="state_id" placeholder="Enter City*">
<span class="text-danger small error-text state_id_error" id="state_id_error"></span>
</div>

<div class="form-group mb-3">
<input class="form-control" id="post_code" type="text" name="post_code" placeholder="Postcode / ZIP *">
<span class="text-danger small error-text post_code_error" id="post_code_error"></span>

</div>
<div class="form-group mb-3">
<input class="form-control" id="shipping_phone" type="text" name="shipping_phone" placeholder="Phone *">
<span class="text-danger small error-text shipping_phone_error" id="shipping_phone_error"></span>
</div>
 
<div class="form-group mb-3">
<textarea rows="5" class="form-control" name="notes"  id="notes" placeholder="Complete Shipping Address"></textarea>
<span class="text-danger small error-text notes_error" id="notes_error"></span>
</div>

<div class="form-group mb-0">
<textarea rows="5" class="form-control" name="instructions"  id="instructions" placeholder="Order special instructions"></textarea>
<span class="text-danger small error-text instructions_error" id="instructions_error"></span>
</div>

</div>
<div class="col-md-6">
<div class="order_review">
<div class="heading_s1">
    <h4>Your Orders</h4>
</div>
<div class="table-responsive order_table">
    <table class="table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($carts as $item)
            <tr>
            <td width="82%">{{$item->name}}  <span class="product-qty">x {{$item->qty}}</span></td>
            <td><i class="fa fa-{{$curIcons}}"></i>  {{$item->price}}</td>
            </tr>
            @endforeach
           
        </tbody>
        <tfoot id="couponCalField">
        
        </tfoot>
    </table>
</div>
<div class="payment_method">
    <div class="heading_s1">
        <h4>Payment</h4>
    </div>
    <div class="payment_option">
    <div class="custome-radio">
            <input class="form-check-input" type="radio" id="razorpay" checked value="razorpay" name="payment_method">
            <label class="form-check-label" for="razorpay">Razorpay</label>
            <p data-method="option5" class="payment-text">Pay via Razorpay; you can pay with your credit card if you don't have a Razorpay account.</p>
        </div>
        
        <div class="custome-radio">
            <input class="form-check-input" type="radio" id="cash" value="cash" name="payment_method">
            <label class="form-check-label" for="cash">Cash on Delivery (+ <i class="fa fa-{{$curIcons}}"></i> 100)</label>
            <p data-method="option4" class="payment-text">Please send your cheque to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
        </div>
       
    </div>
</div>
<button type="submit" class="btn btn-fill-out btn-block chs_now"  style="display:none;">PLACE ORDER</button>
<a href="javascript:void(0)" class="btn btn-fill-out btn-block raz_now" data-amount="{{$cartTotal}}"  data-id="1">PLACE ORDER</a> 

</div>
</div>
</div>
</form>
</div>
</div>
<!-- END SECTION SHOP -->

</div>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
var SITEURL = "{{route('index')}}";
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
}); 
$('body').on('click', '.raz_now', function(e){
e.preventDefault();
var totalAmount = "{{$cartTotal}}";
var name = $('#shipping_name').val();
var email = $('#shipping_email').val();
var phone = $('#shipping_phone').val();
var post_code = $('#post_code').val();
var district = $('#district_id').val();
var city = $('#state_id').val();
var address = $('#notes').val();
var instructions = $('#instructions').val();
var errors = [];
if (name=="") {
errors[errors.length] = document.getElementById("shipping_name_error").innerHTML = "Please enter Name";
} else {
document.getElementById("shipping_name_error").innerHTML = "";	
}	

if(email.indexOf('@')<1 || email.indexOf('.')<1)
{
errors[errors.length] = document.getElementById("shipping_email_error").innerHTML = "You must enter a valid email address.";
} else {
document.getElementById("shipping_email_error").innerHTML = "";	
}	

if (phone=="") {
errors[errors.length] = document.getElementById("shipping_phone_error").innerHTML = "Please enter Phone Number";
} else {
document.getElementById("shipping_phone_error").innerHTML = "";	
}	

if (post_code=="") {
errors[errors.length] = document.getElementById("post_code_error").innerHTML = "Please enter post code";
} else {
document.getElementById("post_code_error").innerHTML = "";	
}	

if (district=="") {
errors[errors.length] = document.getElementById("district_id_error").innerHTML = "Please select State";
} else {
document.getElementById("district_id_error").innerHTML = "";	
}	

if (city=="") {
errors[errors.length] = document.getElementById("state_id_error").innerHTML = "Please select City";
} else {
document.getElementById("state_id_error").innerHTML = "";	
}	

if (address=="") {
errors[errors.length] = document.getElementById("notes_error").innerHTML = "Please enter complete shipping address";
} else {
document.getElementById("notes_error").innerHTML = "";	
}	

if (errors.length > 0) {
reportErrors(errors);
return false;
}
function reportErrors(errors) {
var msg = "Please Enter Valid Data...\n";
for (var i = 0; i < errors.length; i++) {
var numError = i + 1;
msg += "\n" + numError + ". " + errors[i];
}
//alert(msg);
}
var options = {
"key": "{{ env('RAZORPAY_KEY') }}",
"amount": (totalAmount*100), // 2000 paise = INR 20
"name": "The HVE Closet",
"currency": "INR",
"description": "Payment",
"image": "{{asset('general_images/hve_1709968006.jpg')}}",
"handler": function (response){
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
$.ajax({
type:'POST',
url:"{{ route('paysuccess') }}",
data:{razorpay_payment_id:response.razorpay_payment_id,name:name,email:email,phone:phone,post_code:post_code,district:district,city:city,address:address,instructions:instructions,amount:totalAmount},
success:function(data){
   
if(typeof response.razorpay_payment_id == 'undefined' || response.razorpay_payment_id < 1) {
redirect_url = "{{ route('razorpay.cancel') }}";
} else {
redirect_url = '{{ route("razorpay.success")}}/'+response.razorpay_payment_id+'/'+'{{$cartTotal}}';
}
location.href = redirect_url;
}
});
},
"prefill": {
"contact": name,
"email":   email,
},
"theme": {
"color": "#528FF0"
}
};
var rzp1 = new Razorpay(options);
rzp1.open();
});

 
/*document.getElementsClass('buy_plan1').onclick = function(e){
rzp1.open();
e.preventDefault();
}*/
$("#razorpay").on('change', function(){
     $(".chs_now").hide();
     $(".raz_now").eq(0).show();
 })

 $("#cash").on('change', function(){
    var rows = '';
    var totalAmount = "{{$cartTotal + 100}}";
    rows += `<strong><i class="fa fa-rupee-sign"></i> ${totalAmount} </strong>`;
    $('#cart_total_amount').html(rows);
    $(".chs_now").eq(0).show();
    $(".raz_now").hide();
 
});


$('body').on('click', '.chs_now', function(e){
e.preventDefault();
var name = $('#shipping_name').val();
var email = $('#shipping_email').val();
var phone = $('#shipping_phone').val();
var post_code = $('#post_code').val();
var district = $('#district_id').val();
var city = $('#state_id').val();
var address = $('#notes').val();
var errors = [];
if (name=="") {
errors[errors.length] = document.getElementById("shipping_name_error").innerHTML = "Please enter Name";
} else {
document.getElementById("shipping_name_error").innerHTML = "";	
}	

if(email.indexOf('@')<1 || email.indexOf('.')<1)
{
errors[errors.length] = document.getElementById("shipping_email_error").innerHTML = "You must enter a valid email address.";
} else {
document.getElementById("shipping_email_error").innerHTML = "";	
}	

if (phone=="") {
errors[errors.length] = document.getElementById("shipping_phone_error").innerHTML = "Please enter Phone Number";
} else {
document.getElementById("shipping_phone_error").innerHTML = "";	
}	

if (post_code=="") {
errors[errors.length] = document.getElementById("post_code_error").innerHTML = "Please enter post code";
} else {
document.getElementById("post_code_error").innerHTML = "";	
}	

if (district=="") {
errors[errors.length] = document.getElementById("district_id_error").innerHTML = "Please select State";
} else {
document.getElementById("district_id_error").innerHTML = "";	
}	

if (city=="") {
errors[errors.length] = document.getElementById("state_id_error").innerHTML = "Please select City";
} else {
document.getElementById("state_id_error").innerHTML = "";	
}	

if (address=="") {
errors[errors.length] = document.getElementById("notes_error").innerHTML = "Please enter complete shipping address";
} else {
document.getElementById("notes_error").innerHTML = "";	
}	
if (errors.length > 0) {
reportErrors(errors);
return false;
} else {
document.getElementById('chs_now').submit();
}
});
</script>
@endsection