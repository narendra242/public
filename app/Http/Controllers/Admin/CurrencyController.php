<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Currency;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Helpers\GeneralHelper;
class CurrencyController extends Controller
{
    public function create(){
        return view('admin.pages.addcurrency', ['head' => 'Add Currency']);
        }
        
        public function store(Request $request){
        $validator = Validator::make($request->all(),[
        'currency_title' => 'required',
        'code'  => 'required',
        'value' => 'required',
        
        ]); 
        
        if(!$validator->passes()){
        return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{
        $data   = $request->all();
        
        $user = Currency::create($data);
        Currency::where('sort_order', '>', $request->sort_order)->update(['sort_order' => DB::raw('sort_order + 1')]);
        Currency::where('id', '=', $user->id)->update(['sort_order' => $request->sort_order+1]); 
        if($user){
        return response()->json(['status'=>1, 'msg'=>'Record created successfully']);
        }
        }
        }
        
        public function currency(){
        $currencies = Currency::orderBy('sort_order','ASC')->get();
        return view('admin.pages.currency',compact('currencies'),['head' => 'Currency']);
        }
        
        
        public function edit($id){
        $get_record= Currency::find($id);
        if(!empty($get_record)){
        return view('admin.pages.addcurrency',compact('get_record'),['head' => 'Edit Currency']);
        }else{
        return redirect()->action('admin\CurrencyController@currency');
        }
        }
        
        public function update(Request $request){
        $validator = Validator::make($request->all(),[
        'currency_title' => 'required',
        'code'  => 'required',
        'value' => 'required',
        ]); 
        if(!$validator->passes()){
        return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{
        $data   = $request->all();
        $update_record = Currency::find($data['id']);
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
        $get_record = Currency::find($id);
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
