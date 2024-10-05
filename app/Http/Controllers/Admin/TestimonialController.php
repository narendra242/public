<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Validator;
use App\Helpers\GeneralHelper;
use Illuminate\Support\Facades\DB;
class TestimonialController extends Controller{
public $directory="testimonial_images";   
public function create(){
return view('admin.pages.addtestimonial', ['head' => 'Add Testimonial']);
}
public function store(Request $request){
$validator = Validator::make($request->all(),[
'title'         => 'required',
'image'         => 'mimes:jpeg,jpg,png,gif,webp',
]); 
if(!$validator->passes()){
return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
}else{
$data   = $request->all();
if(!empty($request->file('image'))){    
$photo = GeneralHelper::uploadimage($request->file('image'),$this->directory);
$data['image'] = $photo;
}
$user = Testimonial::create($data);
Testimonial::where('sort_order', '>', $request->sort_order)->update(['sort_order' => DB::raw('sort_order + 1')]);
Testimonial::where('id', '=', $user->id)->update(['sort_order' => $request->sort_order+1]); 
if($user){
return response()->json(['status'=>1, 'msg'=>'Record created successfully']);
}
}
}
public function testimonial(){
$datas = Testimonial::orderBy('sort_order', 'ASC')->get();
return view('admin.pages.testimonial',compact('datas'), ['head' => 'Testimonial']);
}
public function edit($id){
$get_record= Testimonial::find($id);
if(!empty($get_record)){
return view('admin.pages.addtestimonial',compact('get_record'), ['head' => 'Edit Testimonial']);
}else{
return redirect()->action('admin\TestimonialController@testimonial');
}
}
public function update(Request $request){
$validator = Validator::make($request->all(),[
'title'         => 'required',
'image'         => 'mimes:jpeg,jpg,png,gif,webp',
]); 
if(!$validator->passes()){
return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
}else{
$data   = $request->all();
$update_record = Testimonial::find($data['id']);
if(!empty($update_record)){
if(!empty($request->file('image'))){    
$photo = GeneralHelper::uploadimage($request->file('image'),$this->directory);
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
public function delete($id){
$get_record = Testimonial::find($id);
if(!empty($get_record)){
$get_record->delete();
if(!empty($get_record->image)){
unlink(public_path('/').$this->directory.'/'.$get_record->image);
}
return response()->json(['status'=>'Record deleted successfully.']);
} else {
return response()->json(['status'=>'Record failed.']);
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