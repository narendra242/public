<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cms;
use App\Models\HomeEnquiry;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Helpers\GeneralHelper;

class CmsController extends Controller{
public $directory="cms_images";    
public function create(){
return view('admin.pages.addcms', ['head' => 'Add Cms']);
}

public function store(Request $request){
$validator = Validator::make($request->all(),[
'title'         => 'required',
'slug_url' 		=> 'required|min:5|max:255|unique:cms',
'image'         => 'mimes:jpeg,jpg,png,gif,webp'
]); 

if(!$validator->passes()){
return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
}else{
$data   = $request->all();
$data["slug_url"] = Str::slug($request->slug_url);
if ($request->get('front_cms'))
$data['front_cms']=1;
else
$data['front_cms']=0;	
if(!empty($request->file('image'))){    
$photo = GeneralHelper::uploadimage($request->file('image'),$this->directory);
$data['image'] = $photo;
}
if(!empty($request->file('banner'))){    
$banner = GeneralHelper::uploadimage($request->file('banner'),$this->directory);
$data['banner'] = $banner;
}

$user = Cms::create($data);
Cms::where('sort_order', '>', $request->sort_order)->update(['sort_order' => DB::raw('sort_order + 1')]);
Cms::where('id', '=', $user->id)->update(['sort_order' => $request->sort_order+1]); 
if($user){
return response()->json(['status'=>1, 'msg'=>'Record created successfully']);
}
}
}

public function cms(){
$cmspage = Cms::orderBy('sort_order')->get();
return view('admin.pages.cms',['cmspage'=>$cmspage], ['head' => 'Cms']);
}


public function edit($id){
$get_record= Cms::find($id);
if(!empty($get_record)){
return view('admin.pages.addcms',['get_record'=>$get_record], ['head' => 'Edit Cms']);
}else{
return redirect()->action('admin\CmsController@cms');
}
}

public function update(Request $request){
$validator = Validator::make($request->all(),[
'title'         => 'required',
'slug_url' 		=> 'required|unique:cms,id,' . $request->id,
'image'         => 'mimes:jpeg,jpg,png,gif,webp'
]); 
if(!$validator->passes()){
return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
}else{
$data   = $request->all();
$data["slug_url"] = Str::slug($request->slug_url);
if ($request->get('front_cms'))
$data['front_cms']=1;
else
$data['front_cms']=0;	
$update_record = Cms::find($data['id']);
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

public function commonenquiry(){
$datas = HomeEnquiry::orderBy('id')->paginate(100);
return view('admin.pages.common_enquiries',compact('datas'),['head' => 'Contact Enquiries']);
}
   

public function commondelete($id=null){
$del_record = HomeEnquiry::find($id);
if(!empty($del_record)){
$del_record->delete();
return response()->json(['status'=>'Record deleted successfully.']);
} else {
return response()->json(['status'=>'Delete record failed.']);
}
}


public function delete($id){
$get_record = Cms::find($id);
if(!empty($get_record)){
$get_record->delete();
if(!empty($get_record->image)){
unlink(public_path('/').$this->directory.'/'.$get_record->image);
}
if(!empty($get_record->banner)){
unlink(public_path('/').$this->directory.'/'.$get_record->banner);
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