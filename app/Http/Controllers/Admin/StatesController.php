<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShipDistrict;
use App\Models\ShipDivision;
use App\Models\ShipState;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Helpers\GeneralHelper;

class StatesController extends Controller{
public function create(){
$divisions = ShipDivision::pluck('division_name', 'id')->prepend('Choose a Division ', '');
$districts = ShipDistrict::pluck('district_name', 'id')->prepend('Choose a District ', '');
return view('admin.pages.addstates',compact('divisions','districts'),['head' => 'Add States']);
}

public function store(Request $request){
$validator = Validator::make($request->all(),[
'division_id'   => 'required',
'district_id'   => 'required',
'state_name'    => 'required',

]); 

if(!$validator->passes()){
return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
}else{
$data   = $request->all();
if(!empty($request->file('image'))){    
$photo = GeneralHelper::uploadimage($request->file('image'),$this->directory);
$data['image'] = $photo;
}
$user = ShipState::create($data);
ShipState::where('sort_order', '>', $request->sort_order)->update(['sort_order' => DB::raw('sort_order + 1')]);
ShipState::where('id', '=', $user->id)->update(['sort_order' => $request->sort_order+1]); 
if($user){
return response()->json(['status'=>1, 'msg'=>'Record created successfully']);
}
}
}

public function states(){
$datas = ShipState::orderBy('sort_order','ASC')->get();
return view('admin.pages.states',compact('datas'),['head' => 'States']);
}


public function edit($id){
$get_record= ShipState::find($id);
$divisions = ShipDivision::pluck('division_name', 'id')->prepend('Choose a Division ', '');
$districts = ShipDistrict::pluck('district_name', 'id')->prepend('Choose a District ', '');
if(!empty($get_record)){
return view('admin.pages.addstates',compact('get_record','divisions','districts'),['head' => 'Edit States']);
}else{
return redirect()->action('admin\StatesController@states');
}
}

public function update(Request $request){
$validator = Validator::make($request->all(),[
'division_id'   => 'required',
'district_id'   => 'required',
'state_name'    => 'required',
]); 
if(!$validator->passes()){
return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
}else{
$data   = $request->all();
$update_record = ShipState::find($data['id']);
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
$get_record = ShipState::find($id);
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

public function GetDistrict($division_id){
$district = ShipDistrict::where('division_id',$division_id)->orderBy('district_name','ASC')->get();  
return json_decode($district);
}
}
?>