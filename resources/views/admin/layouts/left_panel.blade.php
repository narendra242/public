<ul class="nav">
<li class="nav-item">
<a class="nav-link" data-toggle="collapse" href="#banner" aria-expanded="false" aria-controls="banner">
<i class="typcn typcn-th-small-outline menu-icon"></i>
<span class="menu-title">Banner Master</span>
<i class="menu-arrow"></i>
</a>
<div class="collapse {{ (request()->is('admin/banner/create')) ? 'show' : '' }} {{ (request()->is('admin/banner')) ? 'show' : '' }}" id="banner">
<ul class="nav flex-column sub-menu">
<li class="nav-item"> <a class="nav-link" href="{{ route('admin.banner.create') }}">Add Banner</a></li>
<li class="nav-item"> <a class="nav-link" href="{{ route('admin.banner') }}">All Banner</a></li>
</ul>
</div>
</li>
<li class="nav-item">
<a class="nav-link" data-toggle="collapse" href="#contant" aria-expanded="false" aria-controls="contant">
<i class="typcn typcn-th-small-outline menu-icon"></i>
<span class="menu-title">Contant Master</span>
<i class="menu-arrow"></i>
</a>
<div class="collapse {{ (request()->is('admin/contant/create')) ? 'show' : '' }} {{ (request()->is('admin/contant')) ? 'show' : '' }}" id="contant">
<ul class="nav flex-column sub-menu">
<li class="nav-item"> <a class="nav-link" href="{{ route('admin.contant.create') }}">Add Contant</a></li>
<li class="nav-item"> <a class="nav-link" href="{{ route('admin.contant') }}">All Contant</a></li>
</ul>
</div>
</li>
<li class="nav-item">
<a class="nav-link" data-toggle="collapse" href="#cms" aria-expanded="false" aria-controls="cms">
<i class="typcn typcn-th-small-outline menu-icon"></i>
<span class="menu-title">Cms Master</span>
<i class="menu-arrow"></i>
</a>
<div class="collapse {{ (request()->is('admin/cms/create')) ? 'show' : '' }} {{ (request()->is('admin/cms')) ? 'show' : '' }}" id="cms">
<ul class="nav flex-column sub-menu">
<li class="nav-item"> <a class="nav-link" href="{{ route('admin.cms.create') }}">Add Cms</a></li>
<li class="nav-item"> <a class="nav-link" href="{{ route('admin.cms') }}">All Cms</a></li>
</ul>
</div>
</li>
<li class="nav-item">
<a class="nav-link" data-toggle="collapse" href="#category" aria-expanded="false" aria-controls="category">
<i class="typcn typcn-th-small-outline menu-icon"></i>
<span class="menu-title">Product Master</span>
<i class="menu-arrow"></i>
</a>
<div class="collapse {{ (request()->is('admin/category/create')) ? 'show' : '' }} {{ (request()->is('admin/category')) ? 'show' : '' }} {{ (request()->is('admin/product/create')) ? 'show' : '' }} {{ (request()->is('admin/product')) ? 'show' : '' }} " id="category">
<ul class="nav flex-column sub-menu">
<li class="nav-item"> <a class="nav-link" href="{{ route('admin.category.create') }}">Add Category</a></li>
<li class="nav-item"> <a class="nav-link" href="{{ route('admin.category') }}">All Categories</a></li>
<li class="nav-item"> <a class="nav-link" href="{{ route('admin.product.create') }}">Add Product</a></li>
<li class="nav-item"> <a class="nav-link" href="{{ route('admin.product') }}">All Product</a></li>
</ul>
</div>
</li>
<li class="nav-item">
<a class="nav-link" data-toggle="collapse" href="#color" aria-expanded="false" aria-controls="color">
<i class="typcn typcn-th-small-outline menu-icon"></i>
<span class="menu-title">Color Master</span>
<i class="menu-arrow"></i>
</a>
<div class="collapse {{ (request()->is('admin/color/create')) ? 'show' : '' }} {{ (request()->is('admin/color')) ? 'show' : '' }}" id="color">
<ul class="nav flex-column sub-menu">
<li class="nav-item"> <a class="nav-link" href="{{ route('admin.color.create') }}">Add color</a></li>
<li class="nav-item"> <a class="nav-link" href="{{ route('admin.color') }}">All color</a></li>
</ul>
</div>
</li>
<li class="nav-item">
<a class="nav-link" data-toggle="collapse" href="#size" aria-expanded="false" aria-controls="size">
<i class="typcn typcn-th-small-outline menu-icon"></i>
<span class="menu-title">Size Master</span>
<i class="menu-arrow"></i>
</a>
<div class="collapse {{ (request()->is('admin/size/create')) ? 'show' : '' }} {{ (request()->is('admin/size')) ? 'show' : '' }}" id="size">
<ul class="nav flex-column sub-menu">
<li class="nav-item"> <a class="nav-link" href="{{ route('admin.size.create') }}">Add size</a></li>
<li class="nav-item"> <a class="nav-link" href="{{ route('admin.size') }}">All size</a></li>
</ul>
</div>
</li>
<li class="nav-item">
<a class="nav-link" data-toggle="collapse" href="#location" aria-expanded="false" aria-controls="location">
<i class="typcn typcn-th-small-outline menu-icon"></i>
<span class="menu-title">Location Master</span>
<i class="menu-arrow"></i>
</a>
<div class="collapse {{ (request()->is('admin/division/create')) ? 'show' : '' }} {{ (request()->is('admin/division')) ? 'show' : '' }} {{ (request()->is('admin/district/create')) ? 'show' : '' }} {{ (request()->is('admin/district')) ? 'show' : '' }}" {{ (request()->is('admin/states/create')) ? 'show' : '' }} {{ (request()->is('admin/states')) ? 'show' : '' }}" id="location">
<ul class="nav flex-column sub-menu">
<li class="nav-item"> <a class="nav-link" href="{{ route('admin.division') }}">All Division</a></li>
<li class="nav-item"> <a class="nav-link" href="{{ route('admin.district') }}">All District</a></li>
<li class="nav-item"> <a class="nav-link" href="{{ route('admin.states') }}">All States</a></li>
</ul>
</div>
</li>
<li class="nav-item">
<a class="nav-link" data-toggle="collapse" href="#brand" aria-expanded="false" aria-controls="brand">
<i class="typcn typcn-th-small-outline menu-icon"></i>
<span class="menu-title">Brand Master</span>
<i class="menu-arrow"></i>
</a>
<div class="collapse {{ (request()->is('admin/brand/create')) ? 'show' : '' }} {{ (request()->is('admin/brand')) ? 'show' : '' }}" id="brand">
<ul class="nav flex-column sub-menu">
<li class="nav-item"> <a class="nav-link" href="{{ route('admin.brand.create') }}">Add brand</a></li>
<li class="nav-item"> <a class="nav-link" href="{{ route('admin.brand') }}">All brand</a></li>
</ul>
</div>
</li>
<li class="nav-item">
<a class="nav-link" data-toggle="collapse" href="#blog" aria-expanded="false" aria-controls="blog">
<i class="typcn typcn-th-small-outline menu-icon"></i>
<span class="menu-title">Blog Master</span>
<i class="menu-arrow"></i>
</a>
<div class="collapse {{ (request()->is('admin/blogcat/create')) ? 'show' : '' }} {{ (request()->is('admin/blogcat')) ? 'show' : '' }} {{ (request()->is('admin/blog/create')) ? 'show' : '' }} {{ (request()->is('admin/blog')) ? 'show' : '' }} " id="blog">
<ul class="nav flex-column sub-menu">
<li class="nav-item"> <a class="nav-link" href="{{ route('admin.blogcat.create') }}">Add Category</a></li>
<li class="nav-item"> <a class="nav-link" href="{{ route('admin.blogcat') }}">All Category</a></li>
<li class="nav-item"> <a class="nav-link" href="{{ route('admin.blog.create') }}">Add Blog</a></li>
<li class="nav-item"> <a class="nav-link" href="{{ route('admin.blog') }}">All Blog</a></li>
</ul>
</div>
</li>
<li class="nav-item">
<a class="nav-link" data-toggle="collapse" href="#tag" aria-expanded="false" aria-controls="tag">
<i class="typcn typcn-th-small-outline menu-icon"></i>
<span class="menu-title">Tag Master</span>
<i class="menu-arrow"></i>
</a>
<div class="collapse {{ (request()->is('admin/tag/create')) ? 'show' : '' }} {{ (request()->is('admin/tag')) ? 'show' : '' }}" id="tag">
<ul class="nav flex-column sub-menu">
<li class="nav-item"> <a class="nav-link" href="{{ route('admin.tag.create') }}">Add Tag</a></li>
<li class="nav-item"> <a class="nav-link" href="{{ route('admin.tag') }}">All Tag</a></li>
</ul>
</div>
</li>
<li class="nav-item">
<a class="nav-link" data-toggle="collapse" href="#video" aria-expanded="false" aria-controls="video">
<i class="typcn typcn-th-small-outline menu-icon"></i>
<span class="menu-title">Video Master</span>
<i class="menu-arrow"></i>
</a>
<div class="collapse {{ (request()->is('admin/video/create')) ? 'show' : '' }} {{ (request()->is('admin/video')) ? 'show' : '' }}" id="video">
<ul class="nav flex-column sub-menu">
<li class="nav-item"> <a class="nav-link" href="{{ route('admin.video.create') }}">Add Video</a></li>
<li class="nav-item"> <a class="nav-link" href="{{ route('admin.video') }}">All Video</a></li>
</ul>
</div>
</li>
<li class="nav-item">
<a class="nav-link" data-toggle="collapse" href="#coupon" aria-expanded="false" aria-controls="coupon">
<i class="typcn typcn-th-small-outline menu-icon"></i>
<span class="menu-title">Coupon Master</span>
<i class="menu-arrow"></i>
</a>
<div class="collapse {{ (request()->is('admin/coupon/create')) ? 'show' : '' }} {{ (request()->is('admin/coupon')) ? 'show' : '' }}" id="coupon">
<ul class="nav flex-column sub-menu">
<li class="nav-item"> <a class="nav-link" href="{{ route('admin.coupon.create') }}">Add Coupon</a></li>
<li class="nav-item"> <a class="nav-link" href="{{ route('admin.coupon') }}">All Coupon</a></li>
</ul>
</div>
</li>

<li class="nav-item">
<a class="nav-link" data-toggle="collapse" href="#currency" aria-expanded="false" aria-controls="currency">
<i class="typcn typcn-th-small-outline menu-icon"></i>
<span class="menu-title">Currency Master</span>
<i class="menu-arrow"></i>
</a>
<div class="collapse {{ (request()->is('admin/currency/create')) ? 'show' : '' }} {{ (request()->is('admin/currency')) ? 'show' : '' }}" id="currency">
<ul class="nav flex-column sub-menu">
<li class="nav-item"> <a class="nav-link" href="{{ route('admin.currency.create') }}">Add Currency</a></li>
<li class="nav-item"> <a class="nav-link" href="{{ route('admin.currency') }}">All Currency</a></li>
</ul>
</div>
</li>

<li class="nav-item">
<a class="nav-link" data-toggle="collapse" href="#orders" aria-expanded="false" aria-controls="orders">
<i class="typcn typcn-th-small-outline menu-icon"></i>
<span class="menu-title">Orders</span>
<i class="menu-arrow"></i>
</a>
<div class="collapse {{ (request()->is('admin/pending/orders')) ? 'show' : '' }} {{ (request()->is('admin/confirmed/orders')) ? 'show' : '' }} {{ (request()->is('admin/processing/orders')) ? 'show' : '' }} {{ (request()->is('admin/picked/orders')) ? 'show' : '' }} {{ (request()->is('admin/shipped/orders')) ? 'show' : '' }} {{ (request()->is('admin/delivered/orders')) ? 'show' : '' }} {{ (request()->is('admin/cancel/orders')) ? 'show' : '' }}" id="orders">
<ul class="nav flex-column sub-menu">
<li class="nav-item"> <a class="nav-link" href="{{ route('admin.pending-orders') }}">Pending Orders</a></li>
<li class="nav-item"> <a class="nav-link" href="{{ route('admin.confirmed-orders') }}">Confirmed Orders</a></li>
<li class="nav-item"> <a class="nav-link" href="{{ route('admin.processing-orders') }}">Processing Orders</a></li>
<li class="nav-item"> <a class="nav-link" href="{{ route('admin.picked-orders') }}">Picked  Orders</a></li>
<li class="nav-item"> <a class="nav-link" href="{{ route('admin.shipped-orders') }}">Shipped  Orders</a></li>
<li class="nav-item"> <a class="nav-link" href="{{ route('admin.delivered-orders') }}">Delivered  Orders</a></li>
<li class="nav-item"> <a class="nav-link" href="{{ route('admin.cancel-orders') }}">Cancel  Orders</a></li>

</ul>
</div>
</li>
 
<li class="nav-item">
<a class="nav-link" data-toggle="collapse" href="#stock" aria-expanded="false" aria-controls="stock">
<i class="typcn typcn-th-small-outline menu-icon"></i>
<span class="menu-title">Manage Stock</span>
<i class="menu-arrow"></i>
</a>
<div class="collapse {{ (request()->is('admin/product/stock')) ? 'show' : '' }}" id="stock">
<ul class="nav flex-column sub-menu">
<li class="nav-item"> <a class="nav-link" href="{{ route('admin.product.stock') }}">All Reports</a></li>

</ul>
</div>
</li>

<li class="nav-item">
<a class="nav-link" data-toggle="collapse" href="#reports" aria-expanded="false" aria-controls="reports">
<i class="typcn typcn-th-small-outline menu-icon"></i>
<span class="menu-title">Search Reports</span>
<i class="menu-arrow"></i>
</a>
<div class="collapse {{ (request()->is('admin/reports/view')) ? 'show' : '' }}" id="reports">
<ul class="nav flex-column sub-menu">
<li class="nav-item"> <a class="nav-link" href="{{ route('admin.all-reports') }}">All Reports</a></li>

</ul>
</div>
</li>

<li class="nav-item">
<a class="nav-link" data-toggle="collapse" href="#user" aria-expanded="false" aria-controls="user">
<i class="typcn typcn-th-small-outline menu-icon"></i>
<span class="menu-title">All Users</span>
<i class="menu-arrow"></i>
</a>
<div class="collapse {{ (request()->is('admin/alluser')) ? 'show' : '' }}" id="user">
<ul class="nav flex-column sub-menu">
<li class="nav-item"> <a class="nav-link" href="{{ route('admin.all-users') }}">All Users</a></li>

</ul>
</div>
</li>



<li class="nav-item">
<a class="nav-link" data-toggle="collapse" href="#return" aria-expanded="false" aria-controls="return">
<i class="typcn typcn-th-small-outline menu-icon"></i>
<span class="menu-title">Return Order</span>
<i class="menu-arrow"></i>
</a>
<div class="collapse {{ (request()->is('admin/return/request')) ? 'show' : '' }} {{ (request()->is('admin/return/all/request')) ? 'show' : '' }}" id="return">
<ul class="nav flex-column sub-menu">
<li class="nav-item"> <a class="nav-link" href="{{ route('admin.return.request') }}">Return Request</a></li>
<li class="nav-item"> <a class="nav-link" href="{{ route('admin.all.request') }}">All Request</a></li>

</ul>
</div>
</li>


<li class="nav-item">
<a class="nav-link" data-toggle="collapse" href="#review" aria-expanded="false" aria-controls="review">
<i class="typcn typcn-th-small-outline menu-icon"></i>
<span class="menu-title">Manage Review</span>
<i class="menu-arrow"></i>
</a>
<div class="collapse {{ (request()->is('admin/review/pending')) ? 'show' : '' }} {{ (request()->is('admin/review/publish')) ? 'show' : '' }}" id="review">
<ul class="nav flex-column sub-menu">
<li class="nav-item"> <a class="nav-link" href="{{ route('admin.pending.review') }}">Pending Review </a></li>
<li class="nav-item"> <a class="nav-link" href="{{ route('admin.publish.review') }}">Publish Review</a></li>

</ul>
</div>
</li>


<li class="nav-item">
<a class="nav-link" data-toggle="collapse" href="#testimonial" aria-expanded="false" aria-controls="testimonial">
<i class="typcn typcn-th-small-outline menu-icon"></i>
<span class="menu-title">Testimonial Master</span>
<i class="menu-arrow"></i>
</a>
<div class="collapse {{ (request()->is('admin/testimonial/create')) ? 'show' : '' }} {{ (request()->is('admin/testimonial')) ? 'show' : '' }}" id="testimonial">
<ul class="nav flex-column sub-menu">
<li class="nav-item"> <a class="nav-link" href="{{ route('admin.testimonial.create') }}">Add Testimonial</a></li>
<li class="nav-item"> <a class="nav-link" href="{{ route('admin.testimonial') }}">All Testimonial</a></li>
</ul>
</div>
</li>



<li class="nav-item">
<a class="nav-link" data-toggle="collapse" href="#general" aria-expanded="false" aria-controls="general">
<i class="typcn typcn-th-small-outline menu-icon"></i>
<span class="menu-title">General Master</span>
<i class="menu-arrow"></i>
</a>
<div class="collapse {{ (request()->is('admin/general/create')) ? 'show' : '' }} {{ (request()->is('admin/resize')) ? 'show' : '' }}" id="general">
<ul class="nav flex-column sub-menu">
<li class="nav-item"> <a class="nav-link" href="{{ route('admin.general.create') }}">Add General</a></li>
<li class="nav-item"> <a class="nav-link" href="{{ route('admin.general') }}">All General</a></li>
<li class="nav-item"> <a class="nav-link" href="{{ route('admin.resize.createsize') }}">All Sizes</a></li>
</ul>
</div>
</li>   

<li class="nav-item">
<a class="nav-link" data-toggle="collapse" href="#change" aria-expanded="false" aria-controls="change">
<i class="typcn typcn-th-small-outline menu-icon"></i>
<span class="menu-title">User Settings</span>
<i class="menu-arrow"></i>
</a>
<div class="collapse {{ (request()->is('admin/changepassword/create')) ? 'show' : '' }}" id="change">
<ul class="nav flex-column sub-menu">
<li class="nav-item"> <a class="nav-link" href="{{ route('admin.changepassword.create') }}">Change Password</a></li>
<li class="nav-item"> <a class="nav-link" href="{{ route('admin.logout') }}" onclick="event.preventDefault();
document.getElementById('admin-form').submit();">Logout User</a></li>
</ul>
</div>
</li>
 </ul>