@php

$categories = App\Models\ProductCategory::where('status',1)->where('parent_id', 0)->orderBy('sort_order','ASC')->get();

$topcategories = App\Models\ProductCategory::where('status',1)->where('parent_id', 0)->where('top_cats', 1)->orderBy('sort_order','ASC')->limit(7)->get();

@endphp

<!-- START HEADER -->

<header class="header_wrap">

<div class="top-header light_skin">

<div class="custom-container">

<div class="row align-items-center">

<div class="col-lg-12 ">

<div class="header_topbar_info">

<div class="header_offer">

<span>{{GeneralHelper::Generals()->shipping}}</span>

</div>



</div>

</div>

<!--<div class="col-lg-6 col-md-4">-->

<!--<div class="d-flex align-items-center justify-content-center justify-content-md-end">-->



<!--<div class="ms-3">-->

<!--<select name="countries" class="custome_select">-->

<!--<option value='INR' data-title="INR">INR</option>-->

<!--</select>-->

<!--</div>-->

<!--</div>-->

<!--</div>-->

</div>

</div>

</div>

<div class="middle-header dark_skin">

<div class="custom-container">

<div class="nav_block">

<div class="download_wrap  d-none d-md-block"> 

@if(!empty(GeneralHelper::Generals()->social_data))  

<ul class="icon_list text-center text-lg-start">

@foreach(json_decode(GeneralHelper::Generals()->social_data) as $instdt)  

<li><a href="{{$instdt->social_url}}"><i class="fab fa-{{$instdt->social_icon}}"></i></a></li> 

@endforeach	

</ul>

@endif

</div>

<div class="text-center">

<a class="navbar-brand" href="{{route('index')}}">

<img class="logo_light" src="{{asset('general_images/'.GeneralHelper::Generals()->image)}}" alt="{{GeneralHelper::Generals()->title}}">

<img class="logo_dark" src="{{asset('general_images/'.GeneralHelper::Generals()->image)}}" alt="{{GeneralHelper::Generals()->title}}">

</a>

</div>

<ul class="navbar-nav attr-nav align-items-center">

@auth

<li><a href="{{route('login')}}" title="{{ Auth::user()->name }}" class="nav-link"><i class="linearicons-user"></i></a></li>

@else

<li><a href="{{route('login')}}" title="Signup" class="nav-link"><i class="linearicons-user"></i></a></li>

@endauth

 

<li><a href="{{route('wishlist')}}" class="nav-link"><i class="linearicons-heart"></i><span class="wishlist_count">0</span></a></li>

<li><a href="javascript:;" class="nav-link search_trigger"><i class="linearicons-magnifier"></i></a>

<div class="search_wrap">

<span class="close-search"><i class="ion-ios-close-empty"></i></span>

<form class="search-model-form" method="post" action="{{ route('product.search') }}">

@csrf

<input type="text" name="search" placeholder="Search" class="form-control" id="search_input">

<button type="submit" class="search_icon"><i class="ion-ios-search-strong"></i></button>

</form>

</div><div class="search_overlay"></div>

</li>

<li class="dropdown cart_dropdown"><a class="nav-link cart_trigger" href="{{route('mycart')}}" data-bs-toggle="dropdown"><i class="linearicons-cart"></i><span id="cart-total" class="cart_count">0</span></a>

<div class="cart_box dropdown-menu dropdown-menu-right">

<ul class="cart_list">

<div id="miniCart"></div>

</ul>

<div id="CartSubTotals"></div>

</div>

</li>

</ul>

</div>

</div>

</div>

<div class="bottom_header dark_skin main_menu_uppercase border-top border-bottom">

<div class="custom-container"> 

<nav class="navbar navbar-expand-lg">

<button class="navbar-toggler side_navbar_toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSidetoggle" aria-expanded="false"> 

<span class="ion-android-menu"></span>

</button>

<div class="download_wrap d-block d-sm-none"> 

@if(!empty(GeneralHelper::Generals()->social_data))  

<ul class="icon_list text-center text-lg-start">

@foreach(json_decode(GeneralHelper::Generals()->social_data) as $instdt)  

<li><a href="{{$instdt->social_url}}"><i class="fab fa-{{$instdt->social_icon}}"></i></a></li> 

@endforeach	

</ul>

@endif

</div>

<div class="collapse navbar-collapse mobile_side_menu justify-content-center" id="navbarSidetoggle">

<ul class="navbar-nav">

<li><a class="nav-link nav_item" href="{{ route('index') }}"><i class="fa fa-home"></i></a></li>

<!--

<li><a class="nav-link nav_item" href="{{url('page/about-us')}}">About Us</a></li>                                 

<li class="dropdown">-->

<!--<a class="dropdown-toggle nav-link" href="{{route('products')}}" data-bs-toggle="dropdown">Collection</a>-->

<!--<div class="dropdown-menu">-->

<!--@if(!$categories->isEmpty())-->

<!--<ul> -->

<!--@foreach($categories as $maincats) -->

<!--<li><a class="dropdown-item nav-link nav_item" href="{{ url('products/'.$maincats->slug_url) }}">{{$maincats->title}}</a></li> -->

<!--@endforeach-->

<!--</ul>-->

<!--@endif-->

<!--</div>-->

<!--</li>-->

<li class="dropdown dropdown-mega-menu">

<a class="nav-link" href="{{route('products')}}" >Shop</a>

<div class="dropdown-menu">

@if(!$categories->isEmpty())

<ul class="mega-menu d-lg-flex">

@foreach($categories as $cates) 

<li class="mega-menu-col col-lg-3">

<ul> 

<li class="dropdown-header"><a href="{{ url('products/'.$cates->slug_url) }}">{{$cates->title}}</a></li>

@if(!GeneralHelper::SubCategories($cates->id)->isEmpty())

@foreach(GeneralHelper::SubCategories($cates->id) as $subcates)   

<li><a class="dropdown-item nav-link nav_item" href="{{ url('products/'.$subcates->slug_url) }}">{{$subcates->title}}</a></li>

@endforeach

@endif

</ul>

</li>

@endforeach

</ul>

@endif

</div>

</li>



@if(!$topcategories->isEmpty())

@foreach($topcategories as $topcates) 

<li class="dropdown">

<a class="dropdown-toggle nav-link" href="{{ url('products/'.$topcates->slug_url) }}" data-bs-toggle="dropdown">{{$topcates->title}}</a>

<div class="dropdown-menu">

@if(!GeneralHelper::SubCategories($topcates->id)->isEmpty())

<ul> 

@foreach(GeneralHelper::SubCategories($topcates->id) as $subcates)   

<li><a class="dropdown-item nav-link nav_item" href="{{ url('products/'.$subcates->slug_url) }}">{{$subcates->title}}</a></li> 

@endforeach

</ul>

@endif

</div>

</li>

@endforeach

@endif

<li><a class="nav-link nav_item" href="{{route('sale')}}">Sale</a></li> 

</ul>

</div>



</nav> 

</div>

</div>

</header>

<!-- END HEADER -->