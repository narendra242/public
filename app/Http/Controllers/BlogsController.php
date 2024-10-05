<?php
namespace App\Http\Controllers;
use App\Models\Contant;
use App\Models\Blog;
use App\Models\Blogcat;
use App\Models\Experience;

class BlogsController extends Controller
{
public function blogs(){
$contants = Contant::where('title', 7)->first();    
$blogcats = Blogcat::where('status', 1)->orderBy('sort_order', 'ASC')->get();        
$blogs = Blog::where('status', 1)->orderBy('sort_order', 'ASC')->get();  
$myblogs = Blog::where('status', 1)->orderBy('blog_date', 'ASC')->get();   
return view('frontend.blogs',compact('blogs','blogcats','myblogs','contants'));	
} 



public function blogdetail($id){
$blogcats = Blogcat::where('status', 1)->orderBy('sort_order', 'ASC')->get();     
$info = Blog::where('slug_url', $id)->first();   
$myblogs = Blog::where('status', 1)->orderBy('blog_date', 'ASC')->get();     
if(is_null($info)){ abort(404); } else { 
return view('frontend.blog-detail',compact('blogcats','info','myblogs'));
}	
}

public function blogbycates($id){
$info = Blogcat::where('slug_url', $id)->first();    
$blogcats = Blogcat::where('status', 1)->orderBy('sort_order', 'ASC')->get();    
$myblogs = Blog::where('status', 1)->orderBy('blog_date', 'ASC')->get();  
if(is_null($info)){ abort(404); } else {    
$blogscates = Blog::whereRaw("find_in_set($info->id,blogcat_id)")->get();
return view('frontend.blogs',compact('blogscates','myblogs','blogcats','info'));
}	
} 
 
} 