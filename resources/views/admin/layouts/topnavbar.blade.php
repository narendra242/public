<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
<div class="navbar-brand-wrapper d-flex justify-content-center">
<div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
<a class="navbar-brand brand-logo" href="{{ route('admin.dashboard') }}"><img src="{{ asset('images/logos.png') }}" alt="logo"/></a>
<button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
<span class="typcn typcn-th-menu"></span>
</button>
</div>
</div>
<div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
<ul class="navbar-nav mr-lg-2">
<li class="nav-item nav-profile dropdown">
<a class="nav-link" href="#" data-toggle="dropdown" id="profileDropdown">
<img src="{{ asset('images/face5.jpg') }}" alt="profile"/>
<span class="nav-profile-name">{{ Auth::guard('admin')->user()->name }}</span>
</a>
<div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
<a class="dropdown-item" href="{{route('admin.general')}}">
<i class="typcn typcn-cog-outline text-primary"></i>
Settings
</a>
<a class="dropdown-item" href="{{ route('admin.logout') }}" onclick="event.preventDefault();
document.getElementById('admin-form').submit();">
<i class="typcn typcn-eject text-primary"></i>
{{ __('Logout') }}
</a>
<form id="admin-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
@csrf
</form>
</div>
</li>

</ul>
<button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
<span class="typcn typcn-th-menu"></span>
</button>
</div>
</nav>