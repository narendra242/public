<div class="sidebar">
<div class="widget">
<div class="search_form">
<form> 
<input class="form-control" placeholder="Search..." type="text">
<button type="submit" title="Subscribe" class="btn icon_search" name="submit" value="Submit">
<i class="ion-ios-search-strong"></i>
</button>
</form>
</div>
</div>
@if(!$myblogs->isEmpty())
<div class="widget">
<h5 class="widget_title">Recent Posts</h5>
<ul class="widget_recent_post">
@foreach($myblogs as $blogs)
<li>
<div class="post_footer">
<div class="post_img">
<a href="{{ url('blog/'.$blogs->slug_url) }}"><img src="<?= (isset($blogs->image))?asset("blog_images/$blogs->image"):asset('images/no-image-available.jpg') ?>" alt="{{$blogs->alt_tag}}"></a>
</div>
<div class="post_content">
<h6><a href="{{ url('blog/'.$blogs->slug_url) }}">{{$blogs->title}}</a></h6>
<p class="small m-0">{{ date_format(date_create($blogs->blog_date),'d M Y') }}</p>
</div>
</div>
</li>
@endforeach
</ul>
</div>
@endif
@if(!$blogcats->isEmpty())
<div class="widget">
<h5 class="widget_title">Blog Categories</h5>
<ul class="widget_archive">
@foreach($blogcats as $blgcats)
<li><a href="{{ url('blogs/'.$blgcats->slug_url) }}"><span class="archive_year">{{ $blgcats->title }}</span></a></li>
@endforeach
</ul>
</div>
@endif
<div class="widget">
<div class="shop_banner">
<div class="banner_img overlay_bg_20">
<img src="{{asset('assets/images/sidebar_banner_img.jpg')}}" alt="sidebar_banner_img">
</div> 
<div class="shop_bn_content2 text_white">
<h5 class="text-uppercase shop_subtitle">New Collection</h5>
<h3 class="text-uppercase shop_title">Sale 30% Off</h3>
<a href="#" class="btn btn-white rounded-0 btn-sm text-uppercase">Shop Now</a>
</div>
</div>
</div>
</div>