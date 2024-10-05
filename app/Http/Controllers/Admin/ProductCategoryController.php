<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Helpers\GeneralHelper;
class ProductCategoryController extends Controller
{
public $directory="category_images";    
public function create(){
$categories = ProductCategory::orderBy('sort_order')->where('parent_id',0)->get();    
return view('admin.pages.addcategory',compact('categories'),['head' => 'Add Category']);
}

public function store(Request $request){
$validator = Validator::make($request->all(),[
'title'         => 'required',
'parent_id' 	=> 'nullable|numeric',
'slug_url' 		=> 'required|min:3|max:255|unique:product_categories',
'image'         => 'mimes:jpeg,jpg,png,gif,webp'
]); 

if(!$validator->passes()){
return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
}else{
$data   = $request->all();
$data["slug_url"] = Str::slug($request->slug_url);
if ($request->get('front_cats'))
$data['front_cats']=1;
else
$data['front_cats']=0;	 

if ($request->get('top_cats'))
$data['top_cats']=1;
else
$data['top_cats']=0;	

if ($request->get('new_summer'))
$data['new_summer']=1;
else
$data['new_summer']=0;	

if(!empty($request->file('image'))){    
$photo = GeneralHelper::uploadimage($request->file('image'),$this->directory,3);
$data['image'] = $photo;
}
if(!empty($request->file('banner'))){    
$banner = GeneralHelper::uploadimage($request->file('banner'),$this->directory);
$data['banner'] = $banner;
}

$user = ProductCategory::create($data);
ProductCategory::where('sort_order', '>', $request->sort_order)->update(['sort_order' => DB::raw('sort_order + 1')]);
ProductCategory::where('id', '=', $user->id)->update(['sort_order' => $request->sort_order+1]); 
if($user){
return response()->json(['status'=>1, 'msg'=>'Record created successfully']);
}
}
}

public function category(){
$ids = (!empty($_GET["cat_id"])) ? ($_GET["cat_id"]) : ('');
$categories = ProductCategory::orderBy('sort_order', 'ASC')->paginate(100);
if(!empty($ids)) {
$datas = ProductCategory::where('parent_id',$ids)->paginate(100);	
} else {
$datas = ProductCategory::orderBy('sort_order', 'ASC')->paginate(100);	
}
return view('admin.pages.category',compact('datas','categories'),['head' => 'Category']);
}

public function edit($id){
$categories = ProductCategory::orderBy('sort_order')->where('parent_id',0)->get();    
$get_record= ProductCategory::find($id);
if(!empty($get_record)){
return view('admin.pages.addcategory',compact('categories','get_record'),['head' => 'Edit Category']);
}else{
return redirect()->action('admin\ProductCategoryController@category');
}
}


public function update(Request $request){
$validator = Validator::make($request->all(),[
'title'         => 'required',
'parent_id' 	=> 'nullable|numeric',
'slug_url' 		=> 'required|unique:product_categories,id,' . $request->id,
'image'         => 'mimes:jpeg,jpg,png,gif,webp'
]); 
if(!$validator->passes()){
return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
}else{
$data   = $request->all();
$chk=GeneralHelper::multicatsvalids($data['parent_id'],@$request->id);
if(!$chk){
return redirect()->action('admin\ProductCategoryController@category');
}
$data["slug_url"] = Str::slug($request->slug_url);
if ($request->get('front_cats'))
$data['front_cats']=1;
else
$data['front_cats']=0;	


if($request->get('top_cats'))
$data['top_cats']=1;
else
$data['top_cats']=0;

if($request->get('new_summer'))
$data['new_summer']=1;
else
$data['new_summer']=0;	

$update_record = ProductCategory::find($data['id']);
if(!empty($update_record)){
if(!empty($request->file('image'))){    
$photo = GeneralHelper::uploadimage($request->file('image'),$this->directory,3);
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
return response()->json(['status'=>1, 'msg'=>'Record updated successfully']);
}
}
}

public function delete($id){
$del_record = ProductCategory::find($id);
if(!empty($del_record)){
$del_record->delete();
if(!empty($del_record->image)){
unlink(public_path('/').$this->directory.'/'.$del_record->image);
}
if(!empty($del_record->banner)){
unlink(public_path('/').$this->directory.'/'.$del_record->banner);
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
