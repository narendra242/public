<?php
namespace App\Http\Controllers\User;
use App\Models\Order;
use App\Models\OrderItem;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Coupon;
use App\Models\General;
use Carbon\Carbon;
use App\Mail\OrderMail;
use App\Models\Product;
use App\Models\ShipDistrict;
use App\Models\ShipState;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
class CheckoutController extends Controller
{
public function DistrictGetAjax($division_id){
$ship = ShipDistrict::where('division_id',$division_id)->orderBy('district_name','ASC')->get();
return json_decode($ship);
}
public function StateGetAjax($district_id){
$ship = ShipState::where('district_id',$district_id)->orderBy('state_name','ASC')->get();
return json_decode($ship);
}
public function CheckOutStore(Request $request){

$validated = $request->validate([
'shipping_name' => 'required',
'shipping_email'=> 'required|email',
'shipping_phone'=> 'required|min:10|numeric',
'post_code'=> 'required|min:6|numeric',
'district_id'   => 'required',
'state_id'    => 'required',
'notes' => 'required',
],
[
'district_id.required'=> 'State is Required', 
'state_id.required'=> 'City is Required',
'notes.required'=> 'Address is Required'
]);
  
    
if(Session::has('coupon')){
  $total_amount = Session::get('coupon')['total_amount'] + 100;
} else {
  $total_amount = Cart::total() + 100;
}

if(Auth::user()){
$userid= Auth::id();
} else {
$userid= '0';
}
  $order_id = Order::insertGetId([
  'user_id' => $userid,
  'district_id' => $request->district_id,
  'state'    => $request->state_id,
  'name'    => $request->shipping_name,
  'email'    => $request->shipping_email,
  'phone'    => $request->shipping_phone,
  'post_code'    => $request->post_code,
  'notes' => $request->notes,
  'instructions' => $request->instructions,
  'payment_type' => 'Cash',
  'payment_method' => 'Cash on Delivary',
  'currency' => Product::curIcons(),
  'amount' => $total_amount,
  'invoice_no' => 'EOS'.mt_rand(10000000,99999999),
  'order_date' => Carbon::now()->format('d F Y'),
  'order_month' => Carbon::now()->format('F'),
  'order_year' => Carbon::now()->format('Y'),
  'status' => 'pending',
  'created_at' => Carbon::now(),
  ]);
 
  $carts = Cart::content();

  foreach($carts as $cart){
    OrderItem::insert([
      'order_id' => $order_id,
      'product_id' => $cart->id,
      'color' => $cart->options->color,
      'size' => $cart->options->size,
      'qty' => $cart->qty,
      'price' => $cart->price,
      'user_name' => $cart->user_name,  
      'created_at'=> Carbon::now(),
    ]);
  }
  $general = General::where('id',1)->first();
  $invoice = Order::with('district','user')->findOrFail($order_id);
  $orderItem = OrderItem::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();
  
  
  $data = [
    'invoice_no'=> $invoice->invoice_no,
    'amount'    => round($total_amount),
    'name'      => $invoice->name,
    'email'     => $invoice->email,
    'phone'     => $invoice->phone,
    'post_code' => $invoice->post_code, 
    'district'  => $invoice->district,
    'state' => $invoice->state,
    'user' => $invoice->user,
    'order_date'=> $invoice->order_date,
    'delivered_date'=> $invoice->delivered_date,
    'payment_method'=> $invoice->payment_method,
    'orderItem'=> $orderItem,
    'general'  => $general,
    'curIcons' => Product::curIcons(),
  ];


    //Mail::to($general->email)->cc($general['email'])->send(new OrderMail($data));
     $notification = array(
    'message' => 'Your Order Place Successfully',
    'alert-type' => 'success'
    );
    
    $cartTotal = Cart::total();
    return redirect()->route('cash.order')->with($notification);   
    }

}
