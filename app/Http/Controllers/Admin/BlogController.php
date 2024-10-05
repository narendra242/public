<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Blogcat;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Helpers\GeneralHelper;

class BlogController extends Controller{
    public $directory="blog_images";  
	public function create(){
		$blogcates = Blogcat::all();
        return view('admin.pages.addblog', ['blogcates'=>$blogcates,'head' => 'Add Blog']);
    }

    public function store(Request $request){
		$validator = Validator::make($request->all(),[
            'title'         => 'required',
			'blog_date'		=> 'required',
			'slug_url' 		=> 'required|min:5|max:255|unique:blogs',
			'image'         => 'required|mimes:jpeg,jpg,png,gif,webp'
        ]); 

		if(!$validator->passes()){
		return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
		}else{
	 
        $data   = $request->all();
		if(!empty($request->get('blogcat_id'))){
		$data['blogcat_id'] = implode(",", $request->get('blogcat_id'));  
		} else {
		$data['blogcat_id'] = '';  	
		}
		$data["slug_url"] = Str::slug($request->slug_url);
       
        if(!empty($request->file('image'))){    
        $photo = GeneralHelper::uploadimage($request->file('image'),$this->directory);
        $data['image'] = $photo;
        }
        if(!empty($request->file('banner'))){    
        $banner = GeneralHelper::uploadimage($request->file('banner'),$this->directory);
        $data['banner'] = $banner;
        }
		
		$user = Blog::create($data);
		Blog::where('sort_order', '>', $request->sort_order)->update(['sort_order' => DB::raw('sort_order + 1')]);
		Blog::where('id', '=', $user->id)->update(['sort_order' => $request->sort_order+1]); 
		if($user){
		return response()->json(['status'=>1, 'msg'=>'Record created successfully']);
		}
	}
	}

		public function blog(){
		$blogpage = Blog::orderBy('sort_order', 'ASC')->paginate(100);	
		return view('admin.pages.blog',compact('blogpage'),['head' => 'Blog']);
    }
	
	
		public function edit($id){
		$get_record= Blog::find($id);
		$blogcates = Blogcat::all();
		if(!empty($get_record)){
	 	return view('admin.pages.addblog',compact('blogcates','get_record'),['head' => 'Edit Blog']);
		}else{
		return redirect()->action('admin\BlogController@blog');
		}
		}
		
		public function update(Request $request){
		$validator = Validator::make($request->all(),[
		'title'         => 'required',
		'blog_date'		=> 'required',
		'slug_url' 		=> 'required|unique:blogs,slug_url,' . $request->id,
		'image'         => 'mimes:jpeg,jpg,png,gif,webp'
		]); 
		if(!$validator->passes()){
		return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
		}else{
	    $data   = $request->all();
		if(!empty($request->get('blogcat_id'))){
		$data['blogcat_id'] = implode(",", $request->get('blogcat_id'));  
		} else {
		$data['blogcat_id'] = '';  	
		}
		$data["slug_url"] = Str::slug($request->slug_url);
        $update_record = Blog::find($data['id']);
	 	if(!empty($update_record)){
        if(!empty($request->file('image'))){    
        $photo = GeneralHelper::uploadimage($request->file('image'),$this->directory);
        $data['image'] = $photo;
        if(!empty($update_record->image) && file_exists(public_path('/').$this->directory.'/'.$update_record->image)){
        unlink(public_path('/').$this->directory.'/'.$update_record->image);
        }
        }
        if(!empty($request->file('banner'))){   
        $banner = GeneralHelper::uploadimage($request->file('banner'),$this->directory);
        $data['banner'] = $banner;
        if(!empty($update_record->banner) && file_exists(public_path('/').$this->directory.'/'.$update_record->banner)){
        unlink(public_path('/').$this->directory.'/'.$update_record->banner);
        }
        }
            
		$update_record->update($data);
	 	$update_record->where('sort_order', '>', $request->sort_order)->update(['sort_order' => DB::raw('sort_order + 1')]);
		$update_record->where('id', '=', $update_record->id)->update(['sort_order' => $request->sort_order+1]); 
		}
		if($update_record){
		return response()->json(['status'=>1, 'msg'=>'Record updated successfully']);
		}
		}
		}
 

		public function delete($id){
		$get_blog = Blog::find($id);
		if(!empty($get_blog)){
		$get_blog->delete();
		if(!empty($get_blog->image)){
		unlink(public_path('/').$this->directory.'/'.$get_blog->image);
		}
		return response()->json(['status'=>'Record deleted successfully.']);
		} else {
		return response()->json(['status'=>'Delete record failed.']);
		}
		}
		

		public function changeStatus(Request $request)  {
		$result=GeneralHelper::status($request->input('id'),$request->input('status'),$request->input('table'));
		if($result){
		return response()->json(['success'=>'Status change successfully.']);
		} else {
		return response()->json(['failed'=>'Status failed.']);
		}
		}
		}
 ?>