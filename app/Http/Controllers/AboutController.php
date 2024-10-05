<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Cms;
use App\Mail\ConfirmMail;
use App\Mail\ContactMail;
use App\Mail\WholesaleMail;
use App\Models\Contant;
use App\Models\General;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Rules\ReCaptcha;
use Illuminate\Support\Facades\Validator;
use App\Models\ContactEnquiry;
use App\Models\WholesaleEnquiry;
class AboutController extends Controller
{
function aboutus($id=null){
$info = Cms::where('slug_url', $id)->first();
if(is_null($info)){ abort(404); } else {
return view('frontend.about-us',compact('info'));	
}
} 

function disclaimer($id=null){
$info = Cms::where('slug_url', 'disclaimer')->first();
if(is_null($info)){ abort(404); } else {
return view('frontend.disclaimer',compact('info'));	
}
} 

function privacypolicy($id=null){
$info = Cms::where('slug_url', 'privacy-policy')->first();
if(is_null($info)){ abort(404); } else {
return view('frontend.privacy-policy',compact('info'));	
}
} 

function ContactUs($id=null){
$contants = Contant::where('title', 4)->first();       
$general = General::where('id',1)->first();
return view('frontend.contact-us',compact('general','contants'));	
}

public function sendcontact(Request $request){
$validator = Validator::make($request->all(),[
'name'      => 'required',
'email'     => 'required|email',
'phone' 	=> 'required|min:10|numeric',
'city'      => 'required',
'g-recaptcha-response' => ['required', new ReCaptcha]
]);
if(!$validator->passes()){
return response()->json(['status'=>0,'error'=>$validator->errors()->toArray()]);
} else {
$data   = $request->all();    
$general = General::where('id',1)->first();
$array= array(
'name'         => $request->name,
'email'        => $request->email,
'phone' 	   => $request->phone,
'city' 	       => $request->city,
'messages'     => $request->messages, 
'title'        => $general->title, 
'aemail'       => $general->email, 
'aphone'       => $general->phone, 
'weburl'       => $general->weburl, 
'subject'      => "New Contact Enquiry"
 );
ContactEnquiry::create($data);
Mail::to($array['aemail'])->send(new ContactMail($array));
Mail::to($array['email'])->send(new ConfirmMail($array));
 if(Mail::flushMacros()) {
return response()->json(['status'=>1, 'msg'=>'Message could not be sent']);   
} else {
return response()->json(['status'=>1, 'msg'=>'Email has been sent']);   
}
} 	
}



public function sendwholesale(Request $request){
$validator = Validator::make($request->all(),[
'name'=> 'required',
'company_name'=> 'required',
'email' => 'required|email',
'phone'=> 'required|min:10|numeric',
'city'  => 'required',
'product' => 'required',
'quantity' => 'required',
'g-recaptcha-response' => ['required', new ReCaptcha]
]);
if(!$validator->passes()){
return response()->json(['status'=>0,'error'=>$validator->errors()->toArray()]);
} else {
$data   = $request->all();    
$general = General::where('id',1)->first();
$array= array(
'name'    => $request->name,
'company_name'=> $request->company_name,
'email'  => $request->email,
'phone' => $request->phone,
'city' 	=> $request->city,
'product'=> $request->product,
'quantity'=> $request->quantity,
'messages' => $request->messages, 
'title'  => $general->title, 
'aemail' => $general->email, 
'aphone' => $general->phone, 
'weburl' => $general->weburl, 
'subject'=> "New Wholesale Enquiry"
);
WholesaleEnquiry::create($data);
Mail::to($array['aemail'])->send(new WholesaleMail($array));
Mail::to($array['email'])->send(new ConfirmMail($array));
if(Mail::failures()) {
return response()->json(['status'=> 1, 'msg'=>'Message could not be sent']);   
} else {
return response()->json(['status'=> 1, 'msg'=>'Email has been sent']);   
}
} 	


} 
}
