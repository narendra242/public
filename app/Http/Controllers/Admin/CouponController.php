<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
class CouponController extends Controller
{
   public function create(){
    return view('admin.pages.addcoupon',['head' => 'Add Coupon']);
   }

   public function coupon(){
    $datas = Coupon::orderBy('id','DESC')->get();
    return view('admin.pages.coupon',compact('datas'),['head' => 'Coupons']);
   }

   public function store(Request $request){
    $validator = Validator::make($request->all(),[
        'coupon_name'     => 'required',
        'coupon_discount' => 'required',
        'coupon_validity' => 'required',
 
    ]);
    if(!$validator->passes()){
    return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
    }else{
    Coupon::insert([
        'coupon_name'      => strtoupper($request->coupon_name),
        'coupon_discount'  => $request->coupon_discount,
        'coupon_validity'  => $request->coupon_validity,
        'shopping_amount'  => $request->shopping_amount,
        'created_at'       => Carbon::now(),
      ]);
  
     return response()->json(['status'=>1, 'msg'=>'Record created successfully']);
    }
 }//end method

    public function edit($id){
    $get_record = Coupon::findOrFail($id);
    return view('admin.pages.addcoupon',compact('get_record'),['head' => 'Edit Coupon']);
    }


    public function Update(Request $request){
        $validator = Validator::make($request->all(),[
            'coupon_name'     => 'required',
            'coupon_discount' => 'required',
            'coupon_validity' => 'required',
     
        ]);
        if(!$validator->passes()){
        return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{
       $data   = $request->all();
        Coupon::findOrFail($data['id'])->update([
            'coupon_name'      => strtoupper($request->coupon_name),
            'coupon_discount'  => $request->coupon_discount,
            'shopping_amount'  => $request->shopping_amount,
            'coupon_validity'  => $request->coupon_validity,
            'created_at'       => Carbon::now(),
          ]);
     
         return response()->json(['status'=>1, 'msg'=>'Record updated successfully']);
        }
     }//end method

    public function delete($id){
    $get_record = Coupon::findOrFail($id)->delete();
    if(!empty($get_record)){
    return response()->json(['status'=>'Record deleted successfully.']);
    } else {
    return response()->json(['status'=>'Delete record failed.']);
    }
    }
}
