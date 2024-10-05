<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShipDivision;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Helpers\GeneralHelper;

class DivisionController extends Controller{
public function create(){
return view('admin.pages.adddivision', ['head' => 'Add Division']);
}

public function store(Request $request){
$validator = Validator::make($request->all(),[
'division_name'  => 'required',

]); 

if(!$validator->passes()){
return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
}else{
$data   = $request->all();

$user = ShipDivision::create($data);
ShipDivision::where('sort_order', '>', $request->sort_order)->update(['sort_order' => DB::raw('sort_order + 1')]);
ShipDivision::where('id', '=', $user->id)->update(['sort_order' => $request->sort_order+1]); 
if($user){
return response()->json(['status'=>1, 'msg'=>'Record created successfully']);
}
}
}

public function division(){
$datas = ShipDivision::orderBy('sort_order','ASC')->get();
return view('admin.pages.division',compact('datas'),['head' => 'Divisions']);
}


public function edit($id){
$get_record= ShipDivision::find($id);
if(!empty($get_record)){
return view('admin.pages.adddivision',compact('get_record'),['head' => 'Edit division']);
}else{
return redirect()->action('admin\DivisionController@division');
}
}

public function update(Request $request){
$validator = Validator::make($request->all(),[
'division_name'  => 'required',
]); 
if(!$validator->passes()){
return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
}else{
$data   = $request->all();
$update_record = ShipDivision::find($data['id']);
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
  
public function delete($id){
$get_record = ShipDivision::find($id);
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