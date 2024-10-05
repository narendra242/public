<?php

namespace App\Http\Controllers\Admin;
use App\Models\ResizeImage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ResizeImageController extends Controller
{
    public function createsize(){
    $sizes = ResizeImage::orderBy('sec_id', 'ASC')->get();
    return view('admin.pages.addsize', ['head' => 'Add Image Size','sizes'=>$sizes]);
    }

    public function storesize(Request $request){
    $validator = Validator::make($request->all(),[
    'sec_id'       => 'required|numeric',
    'sec_width'    => 'required|numeric',
    'sec_height'   => 'required|numeric',
    ]); 
    if(!$validator->passes()){
    return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
    }else{
    $data   = $request->all();
    if(!empty($data)){
    ResizeImage::create($data);
    return response()->json(['status'=>1, 'msg'=>'Record created successfully']);    }
    }
    }
    public function updatesize(Request $request){
    $validator = Validator::make($request->all(),[
    'sec_id'       => 'required|numeric',
    'sec_width'    => 'required|numeric',
    'sec_height'   => 'required|numeric',
    ]); 
    if(!$validator->passes()){
    return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
    }else{
    $data   = $request->all();
    $update_record = ResizeImage::find($data['id']);
    if(!empty($update_record)){
    $update_record->update($data);
    return response()->json(['status'=>1, 'msg'=>'Record created successfully']);    
    }
    }
    }

    public function editsize($id=null){
    $get_record= ResizeImage::find($id);
    $sizes = $get_record::orderBy('sec_id', 'ASC')->get();	
    if(!empty($get_record)){
    return view('admin.pages.addsize',['get_record'=>$get_record,'sizes'=>$sizes], ['head' => 'Edit Size Image']);
    }else{
    return response()->json(['status'=>1, 'msg'=>'Record created successfully']);    
    }
    }

    public function deletesize($id=null){
    $get_record = ResizeImage::find($id);
    if(!empty($get_record)){
    $get_record->delete();	
    return response()->json(['status'=>'Record deleted successfully.']);
    } else {
    return response()->json(['status'=>'Record deleted failed.']);
    }
    }
}
