<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Helpers\GeneralHelper;

class TagController extends Controller{
public function create(){
return view('admin.pages.addtag', ['head' => 'Add Tag']);
}

public function store(Request $request){
$validator = Validator::make($request->all(),[
'title'  => 'required',
'slug_url'=> 'required|min:3|max:255|unique:tags',

]); 

if(!$validator->passes()){
return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
}else{
$data   = $request->all();

$user = Tag::create($data);
Tag::where('sort_order', '>', $request->sort_order)->update(['sort_order' => DB::raw('sort_order + 1')]);
Tag::where('id', '=', $user->id)->update(['sort_order' => $request->sort_order+1]); 
if($user){
return response()->json(['status'=>1, 'msg'=>'Record created successfully']);
}
}
}

public function tag(){
$tags = Tag::orderBy('sort_order','ASC')->get();
return view('admin.pages.tag',compact('tags'),['head' => 'Tag']);
}


public function edit($id){
$get_record= Tag::find($id);
if(!empty($get_record)){
return view('admin.pages.addtag',compact('get_record'),['head' => 'Edit Tag']);
}else{
return redirect()->action('admin\TagController@tag');
}
}

public function update(Request $request){
$validator = Validator::make($request->all(),[
'title'     => 'required',
'slug_url'  => 'required|unique:tags,slug_url,' . $request->id,
]); 
if(!$validator->passes()){
return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
}else{
$data   = $request->all();
$update_record = Tag::find($data['id']);
if(!empty($update_record)){
$update_record->update($data);
$update_record->where('sort_order', '>', $request->sort_order)->update(['sort_order' => DB::raw('sort_order + 1')]);
$update_record->where('id', '=', $update_record->id)->update(['sort_order' => $request->sort_order+1]); 
}
if($update_record){
return response()->json(['status'=>1, 'msg'=>'Record updated successfully']);
}
}
}

public function searchtags(Request $request)
{
$data = Tag::select("title","id")->where('slug_url', 'LIKE', '%'. $request->get('filter_name'). '%')->limit(10)->get();
return response()->json($data);
}
  
public function delete($id){
$get_record = Tag::find($id);
if(!empty($get_record)){
$get_record->delete();
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