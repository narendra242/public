<!-- START FOOTER -->

@php

$fcategories = App\Models\ProductCategory::where('status',1)->where('parent_id', 0)->where('top_cats', 1)->orderBy('sort_order','ASC')->limit(6)->get();

$fcms = App\Models\Cms::where('status',1)->orderBy('sort_order','ASC')->get();

@endphp

<!-- START FOOTER -->

<footer class="">

<div class="footer_top small_pt pb_20">

<div class="container">

<div class="row">





<div class="col-lg-3 col-md-3 col-sm-6 col-6">

<div class="widget">

<h6 class="widget_title">Products Collection</h6>

@if(!$fcategories->isEmpty())

<ul class="widget_links">

@foreach($fcategories as $fcate) 

<li><a href="{{ url('products/'.$fcate->slug_url) }}">{{$fcate->title}}</a></li>

@endforeach
<li><a href="{{ url('products/new-arrival') }}">New Arrival</a></li>

</ul>

@endif

</div>

</div>

<div class="col-lg-2 col-md-3 col-sm-12 col-6">

<div class="widget">

<h6 class="widget_title">Quick Links</h6>

<ul class="widget_links">

<li><a href="{{ route('dashboard') }}">My Account</a></li>

<li><a href="{{ route('mycart') }}">Cart</a></li>

<li><a href="{{ route('checkout') }}">Checkout</a></li>

<li><a href="{{ route('wishlist') }}">Wishlist</a></li>

<li><a href="{{ route('wholesale') }}">Wholesale</a></li>
</ul>



</div>

</div>

<div class="col-lg-3 col-md-3 col-sm-6">

<div class="widget">

<h6 class="widget_title">Information</h6>

@if(!$fcms->isEmpty())

<ul class="widget_links">

@foreach($fcms as $about) 

<li><a href="{{ url('page/'.$about->slug_url) }}">{{$about->title}}</a></li> 

@endforeach

<li><a href="{{route('blog')}}">Blog</a></li>

<li><a href="{{route('contact-us')}}">Contact Us</a></li>

</ul>

@endif

</div>

</div>

<div class="col-lg-4 col-md-3 col-sm-12">

<div class="widget">

<h6 class="widget_title">Follow Us</h6>

<ul class="contact_info">

<li>

<i class="ti-location-pin"></i>

<p>{!! strip_tags(GeneralHelper::Generals()->address)!!}</p>

</li>

<li>

<i class="ti-email"></i>

<a href="mailto:{{ GeneralHelper::Generals()->email }}">{{ GeneralHelper::Generals()->email }}</a>

</li>

<li>

<i class="ti-mobile"></i>

<p> {{ GeneralHelper::Generals()->phone }} /  {{ GeneralHelper::Generals()->contact }} </p>

</li>

</ul>

<div class="widget mb-lg-0 mt-3">

@if(!empty(GeneralHelper::Generals()->social_data)) 

<ul class="social_icons text-center text-lg-start">

@foreach(json_decode(GeneralHelper::Generals()->social_data) as $instdt)  

<li><a href="{{$instdt->social_url}}" class="{{$instdt->social_title}}"><i class="fab fa-{{$instdt->social_icon}}"></i></a></li>

@endforeach

</ul>

@endif

</div>

</div>

</div>

</div>

</div>

</div>



<div class="bottom_footer border-top-tran">

<div class="container">

<div class="row align-items-center">

<div class="col-lg-8">

<p class="mb-lg-0">© {{ GeneralHelper::Generals()->copyright_text }} All Rights Reserved by {{ GeneralHelper::Generals()->title }} | Designed &amp; Developed by <a href="https://www.indianespace.co.in/" target="_blank">Indianespace</a></p>

</div>



<div class="col-lg-4 d-none d-md-block">

<ul class="footer_payment text-center text-lg-end">

<li><a href="#"><img src="{{asset('assets/images/visa.png')}}" alt="visa"></a></li>

<li><a href="#"><img src="{{asset('assets/images/discover.png')}}" alt="discover"></a></li>

<li><a href="#"><img src="{{asset('assets/images/master_card.png')}}" alt="master_card"></a></li>

<li><a href="#"><img src="{{asset('assets/images/paypal.png')}}" alt="paypal"></a></li>

<li><a href="#"><img src="{{asset('assets/images/amarican_express.png')}}" alt="amarican_express"></a></li>

</ul>

</div>

</div>

</div>

</div>

<a href="https://api.whatsapp.com/send?phone={{ GeneralHelper::Generals()->whats_app }}&text=Hi!" target="_blank" class="whatsapp-btn">

<i class="fab fa-whatsapp"></i> </a>


<?php /*?><a href="tel:{{ GeneralHelper::Generals()->phone }}" target="_blank" class="phone-btn">

<i class="fa fa-phone"></i> </a><?php */?>

</footer>

<!-- END FOOTER -->

<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/65434ed7f2439e1631eae804/1he7envba';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

