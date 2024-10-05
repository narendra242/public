<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShipDistrict;
use App\Models\ShipDivision;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Helpers\GeneralHelper;

class DistrictController extends Controller{
public function create(){
$divisions = ShipDivision::pluck('division_name', 'id')->prepend('Choose a State ', '');
return view('admin.pages.adddistrict',compact('divisions'),['head' => 'Add District']);
}

public function store(Request $request){
$validator = Validator::make($request->all(),[
'division_id'  => 'required',
'district_name'=> 'required',

]); 

if(!$validator->passes()){
return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
}else{
$data   = $request->all();
if(!empty($request->file('image'))){    
$photo = GeneralHelper::uploadimage($request->file('image'),$this->directory);
$data['image'] = $photo;
}
$user = ShipDistrict::create($data);
ShipDistrict::where('sort_order', '>', $request->sort_order)->update(['sort_order' => DB::raw('sort_order + 1')]);
ShipDistrict::where('id', '=', $user->id)->update(['sort_order' => $request->sort_order+1]); 
if($user){
return response()->json(['status'=>1, 'msg'=>'Record created successfully']);
}
}
}

public function district(){
$datas = ShipDistrict::orderBy('sort_order','ASC')->get();
return view('admin.pages.district',compact('datas'),['head' => 'Districts']);
}


public function edit($id){
$get_record= ShipDistrict::find($id);
$divisions = ShipDivision::pluck('division_name', 'id')->prepend('Choose a State ', '');
if(!empty($get_record)){
return view('admin.pages.adddistrict',compact('get_record','divisions'),['head' => 'Edit District']);
}else{
return redirect()->action('admin\DistrictController@district');
}
}

public function update(Request $request){
$validator = Validator::make($request->all(),[
'division_id'  => 'required',
'district_name'=> 'required',
]); 
if(!$validator->passes()){
return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
}else{
$data   = $request->all();
$update_record = ShipDistrict::find($data['id']);
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
$get_record = ShipDistrict::find($id);
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