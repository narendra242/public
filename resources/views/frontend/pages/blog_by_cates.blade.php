@if(!$blogscates->isEmpty())
@foreach($blogscates as $blog)
<div class="col-lg-4 col-md-6">
<div class="blog_post blog_style2 box_shadow1">
<div class="blog_img">
<a href="{{ url('blog/'.$blog->slug_url) }}">
<img src="<?= (isset($blog->image))?asset("blog_images/$blog->image"):asset('images/no-image-available.jpg') ?>" alt="{{$blog->alt_tag}}">
</a>
</div>
<div class="blog_content bg-white">
<div class="blog_text">
<h5 class="blog_title"><a href="{{ url('blog/'.$blog->slug_url) }}">{{$blog->title}}</a></h5>
<ul class="list_none blog_meta">
<li><a href="{{ url('blog/'.$blog->slug_url) }}"><i class="ti-calendar"></i>{{ date_format(date_create($blog->blog_date),'d M Y') }}</a></li>
<li><a href="{{ url('blog/'.$blog->slug_url) }}"><i class="ti-comments"></i> {{$blog->author_name}}</a></li>
</ul>
<p>{!! Str::words(strip_tags($blog->description), 18) !!} </p>
</div>
</div>
</div>
</div>
@endforeach
@endif