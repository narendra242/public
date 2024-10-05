<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Video;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Helpers\GeneralHelper;
class VideoController extends Controller{
public $directory="video_images";    
public function create(){
return view('admin.pages.addvideo', ['head' => 'Add Video']);
}
public function store(Request $request){
$validator = Validator::make($request->all(),[
'title'         => 'required',
'image'         => 'required|mimes:jpeg,jpg,png,gif,webp',
'video_mp'      => 'required|file|mimetypes:video/mp4',
]); 
if(!$validator->passes()){
return response()->json(['status'=>0,'error'=>$validator->errors()->toArray()]);
}else{
$data   = $request->all();
if(!empty($request->file('image'))){    
$photo = GeneralHelper::uploadimage($request->file('image'),$this->directory);
$data['image'] = $photo;
}
if(!empty($request->file('video_mp'))){    
$video = GeneralHelper::uploadpdf($request->file('video_mp'),$this->directory);
$data['video_mp'] = $video;
}
$user = Video::create($data);
Video::where('sort_order', '>', $request->sort_order)->update(['sort_order' => DB::raw('sort_order + 1')]);
Video::where('id', '=', $user->id)->update(['sort_order' => $request->sort_order+1]); 
if($user){
return response()->json(['status'=>1, 'msg'=>'Record created successfully']);
}
}
}
public function video(){
$datas = Video::orderBy('sort_order', 'ASC')->get();
return view('admin.pages.video',compact('datas'), ['head' => 'Video']);
}


public function edit($id){
$get_result= Video::find($id);
if(!empty($get_result)){
return view('admin.pages.addvideo',compact('get_result'), ['head' => 'Edit Video']);
}else{
return redirect()->action('admin\VideoController@video');
}
}

public function update(Request $request){
$validator = Validator::make($request->all(),[
'title'         => 'required',
'image'         => 'mimes:jpeg,jpg,png,gif,webp',
'video_mp'      => 'file|mimetypes:video/mp4',
]); 
if(!$validator->passes()){
return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
}else{
$data   = $request->all();
$update_record = Video::find($data['id']);
if(!empty($update_record)){
if(!empty($request->file('image'))){    
$photo = GeneralHelper::uploadimage($request->file('image'),$this->directory);
$data['image'] = $photo;
if(!empty($update_record->image) && file_exists(public_path('/').$this->directory.'/'.$update_record->image)){
unlink(public_path('/').$this->directory.'/'.$update_record->image);
}
}

if(!empty($request->file('video_mp'))){    
$video = GeneralHelper::uploadpdf($request->file('video_mp'),$this->directory);
$data['video_mp'] = $video;
if(!empty($update_record->video_mp) && file_exists(public_path('/').$this->directory.'/'.$update_record->video_mp)){
unlink(public_path('/').$this->directory.'/'.$update_record->video_mp);
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
$del_record = Video::find($id);
if(!empty($del_record)){
$del_record->delete();
if(!empty($del_record->image)){
unlink(public_path('/').$this->directory.'/'.$del_record->image);
}
return response()->json(['status'=>'Record deleted successfully.']);
} else {
return response()->json(['status'=>'Record deleted failed.']);
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