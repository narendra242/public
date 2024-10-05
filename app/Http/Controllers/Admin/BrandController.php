<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Helpers\GeneralHelper;

class BrandController extends Controller{
public $directory="brand_images";    
public function create(){
return view('admin.pages.addbrand', ['head' => 'Add Brand']);
}

public function store(Request $request){
$validator = Validator::make($request->all(),[
'title' => 'required',
'image' => 'mimes:jpeg,jpg,png,gif,webp',
]); 

if(!$validator->passes()){
return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
}else{
$data   = $request->all();
 if(!empty($request->file('image'))){    
$image = GeneralHelper::uploadimage($request->file('image'),$this->directory);
$data['image'] = $image;
}
 
$user = Brand::create($data);
Brand::where('sort_order', '>', $request->sort_order)->update(['sort_order' => DB::raw('sort_order + 1')]);
Brand::where('id', '=', $user->id)->update(['sort_order' => $request->sort_order+1]); 
if($user){
return response()->json(['status'=>1, 'msg'=>'Record created successfully']);
}
}
}

public function brand(){
$datas = Brand::orderBy('sort_order')->get();
return view('admin.pages.brand',['datas'=>$datas], ['head' => 'Brand']);
}


public function edit($id){
$get_record= Brand::find($id);
if(!empty($get_record)){
return view('admin.pages.addbrand',['get_record'=>$get_record], ['head' => 'Edit Brand']);
}else{
return redirect()->action('admin\BrandController@brand');
}
}

public function update(Request $request){
$validator = Validator::make($request->all(),[
'title' => 'required',
'image' => 'mimes:jpeg,jpg,png,gif,webp',
]); 
if(!$validator->passes()){
return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
}else{
$data   = $request->all();
$update_record = Brand::find($data['id']);
if(!empty($update_record)){
if(!empty($request->file('image'))){    
$icon = GeneralHelper::uploadimage($request->file('image'),$this->directory);
$data['image'] = $icon;
if(!empty($update_record->image) && file_exists(public_path('/').$this->directory.'/'.$update_record->image)){
unlink(public_path('/').$this->directory.'/'.$update_record->image);
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
$get_record = Brand::find($id);
if(!empty($get_record)){
$get_record->delete();
if(!empty($get_record->image)){
unlink(public_path('/').$this->directory.'/'.$get_record->image);
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