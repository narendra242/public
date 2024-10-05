<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Helpers\GeneralHelper;

class BannerController extends Controller{
public $directory="banner_images";    
public function create(){
return view('admin.pages.addbanner', ['head' => 'Add Banner']);
}

public function store(Request $request){
$validator = Validator::make($request->all(),[
'title'      => 'required',
'image'      => 'required|mimes:jpeg,jpg,png,gif,webp'
]);

if(!$validator->passes()){
return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
} else {
$data   = $request->all();
if(!empty($request->file('image'))){    
$photo = GeneralHelper::uploadimage($request->file('image'),$this->directory);
$data['image'] = $photo;
}
$user = Banner::create($data);
Banner::where('sort_order', '>', $request->sort_order)->update(['sort_order' => DB::raw('sort_order + 1')]);
Banner::where('id', '=', $user->id)->update(['sort_order' => $request->sort_order+1]);
if($user){
return response()->json(['status'=>1, 'msg'=>'Record created successfully']);
}
}
}

public function banner(){
$banners = Banner::orderBy('sort_order', 'ASC')->get();
return view('admin.pages.banner',['banners'=>$banners], ['head' => 'Add Banner']);
}


public function edit($id=null){
$get_record= Banner::find($id);
if(!empty($get_record)){
return view('admin.pages.addbanner',['get_record'=>$get_record], ['head' => 'Edit Banner']);
} else {
return redirect()->action('Admin\BannerController@banner');
}
}

public function update(Request $request){
$validator = Validator::make($request->all(),[
'title'         => 'required',
'image'         => 'mimes:jpeg,jpg,png,gif,webp'
]);
if(!$validator->passes()){
return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
}else{
$data   = $request->all();

$update_record = Banner::find($data['id']);
if(!empty($update_record)){
if(!empty($request->file('image'))){    
$photo = GeneralHelper::uploadimage($request->file('image'),$this->directory,1);
$data['image'] = $photo;
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

public function delete($id=null){
$get_record= Banner::find($id);
if(!empty($get_record)){
$get_record->delete();
unlink(public_path($this->directory.'/'.$get_record->image));
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