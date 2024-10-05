<?php
namespace App\Http\Controllers;
use App\Models\Banner;

use App\Models\General;

use App\Models\Contant;

use App\Models\Cms;

use App\Models\Tag;

use App\Models\Product;

use App\Models\Video;

use App\Models\Testimonial;

use App\Models\Review;

use App\Models\User;

use App\Models\Blog;

use App\Rules\ReCaptcha;

use App\Mail\ConfirmMail;

use App\Mail\PopMail;

use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Validator;

use App\Models\HomeEnquiry;

use GuzzleHttp\Client;

use App\Models\ProductCategory;

use Illuminate\Http\Request;

class IndexController extends Controller

{

public function index(){

// $accessToken = 'IGQWROSkU3NzBDNF9FbDk5VWFYSTdlbDZAiYjlCUkkwcHQ0UjBVNnd3dHUyMWQzLUJwWFR4Y1hSc2tmVzd0UkFYYTRSNXVJVEYzUThFeWhEVjZA6TS1FMEdSbWQ0cDJINmZAJMzA1dU5sZAXhocHV0c3A4RVpqbGZArTnMZD';


// $client = new Client();

// $response = $client->get("https://graph.instagram.com/v12.0/me/media?fields=id,media_type,media_url,caption,permalink,thumbnail_url&access_token={$accessToken}&limit=15");

// $data = json_decode($response->getBody());    

$general = General::where('id',1)->first();

$aboutus = Cms::where('status',1)->where('front_cms',1)->first();

$sliders = Banner::where('status',1)->orderBy('sort_order','ASC')->limit(8)->get();

$categories = ProductCategory::where('status',1)->where('front_cats',1)->orderBy('sort_order','ASC')->limit(10)->get();

$blogs = Blog::where('status',1)->orderBy('sort_order','ASC')->limit(3)->get();

$arrivals = Product::where('status',1)->where('arrival_product',1)->orderBy('sort_order','ASC')->limit(12)->get();

$shopbycates = Product::where('status',1)->where('featured_product',1)->orderBy('sort_order','ASC')->limit(12)->get();

$testimonials  = Testimonial::where('status', 1)->orderBy('sort_order','ASC')->get();

$discovers = ProductCategory::where('status',1)->where('new_summer',1)->orderBy('sort_order','ASC')->limit(5)->get();

$productsale = Product::where('status',1)->where('sale_product',1)->orderBy('sort_order','ASC')->get();


return view('home',compact('general','sliders','categories','aboutus','arrivals','blogs','shopbycates','testimonials','discovers','productsale'));

}



public function videos(){

$videos = Video::where('status',1)->orderBy('sort_order','ASC')->get();

return view('videos',compact('videos'));

}



public function wholesale(){

$contants = Contant::where('title', 8)->first();

return view('frontend.wholesale',compact('contants'));

}

public function sale(){
$contants = Contant::where('title', 18)->first();
$productsale = Product::where('status',1)->where('sale_product',1)->orderBy('sort_order','ASC')->get();

return view('frontend.sale',compact('contants','productsale'));
}

public function storelocator(){

$contants = Contant::where('title', 14)->first();

return view('frontend.store-locator',compact('contants'));

}



public function reviews(){

$contants = Contant::where('title', 5)->first();

$review = Review::where('status',1)->orderBy('id','DESC')->get();

return view('frontend.reviews',compact('contants','review'));

}



public function TopicTags($id = null){

$info = Tag::where('slug_url', $id)->first();

if(is_null($info)){ abort(404); } else {

return view('topic-tags',compact('info'));

}

}



public function ProductSearch(Request $request){

$contants = Contant::where('title', 11)->first();

$item = $request->search;

$products = Product::where('title','LIKE',"%$item%")->get();

return view('frontend.product.search',compact('products','contants'));

}



public function UserLogout(){

Auth::logout();

return redirect()->route('login');

}



public function UserProfile(){

$id=Auth::user()->id;

$user = User::find($id);

return view('frontend.profile.user_profile',compact('user'));

}



public function UserProfileStore(Request $request){

$data = User::find(Auth::user()->id);



$data->name = $request->name;

$data->email = $request->email;

$data->phone = $request->phone;



if($request->file('profile_photo_path')){

$file = $request->file('profile_photo_path');

@unlink(public_path('uploads/user_images/'.$data->profile_photo_path));

$filename = date('YmdHi').$file->getClientOriginalName();

$file->move(public_path('uploads/user_images'),$filename);

$data['profile_photo_path'] = $filename;

}

$data->save();

$notification = array(

'message' => 'User Profile Updated Successfully',

'alert_type' => 'Success'

);

return redirect()->route('dashboard')->with($notification);

}



public function UserChangePassword(){

$id=Auth::user()->id;

$user = User::find($id);

return view('frontend.profile.change_password',compact('user'));

}





public function UserPasswordUpadate(Request $request){



    $validationData =$request->validate([

        'oldpassword' => 'required',

        'password'    => 'required|confirmed',

    ]);



    $hashedPasword = Auth::user()->password;

    if(Hash::check($request->oldpassword,$hashedPasword)){

    $user =User::find(Auth::id());

    $user->password = Hash::make($request->password);

    $user->save();

    Auth::logout();

    return redirect()->route('user.logout');

    } else {

    return redirect()->back();

    }

    }//end method

 

    public function sendpopup(Request $request){

    $validator = Validator::make($request->all(),[

    'name'          => 'required',

    'email'         => 'required|email',

    'phone'         => 'required|min:10|numeric',

    // 'g-recaptcha-response' => ['required', new ReCaptcha]

    ]);

    if(!$validator->passes()){

    return response()->json(['status'=>0,'error'=>$validator->errors()->toArray()]);

    } else {

    $data   = $request->all();    

    $general = General::where('id',1)->first();

    $array= array(

    'name'         => $request->name,

    'email'        => $request->email,

    'phone'        => $request->phone,

    'title'        => $general->title, 

    'aemail'       => $general->email, 

    'aphone'       => $general->phone, 

    'weburl'       => $general->weburl, 

    'subject'      => "New Enquiry Received",

    );

    HomeEnquiry::create($data);

    Mail::to($array['aemail'])->send(new PopMail($array));

    Mail::to($array['email'])->send(new ConfirmMail($array));

    if(Mail::failures()) {

    return response()->json(['status'=>1, 'msg'=>'Message could not be sent']);   

    } else {

    return response()->json(['status'=>1, 'msg'=>'Email has been sent']);   

    }

    } 	

    }

public function howtoorder(){

$contants = Contant::where('title', 16)->first();

return view('frontend.how-to-order',compact('contants'));

}



}

