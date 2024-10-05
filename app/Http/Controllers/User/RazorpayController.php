<?php
namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Mail\OrderMail;
use App\Models\General;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Razorpay\Api\Api;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Redirect;

  
class RazorpayController extends Controller
{    
 
    public function razorPaySuccess(Request $request)
    { 
        
        $input = $request->all();
        
        if (Auth::check()) {
        $userid =Auth::id(); 
        } else {
        $userid = 0; 
        }    
        
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $payment = $api->payment->fetch($request->razorpay_payment_id);
    
        if(count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                $payment->capture(array('amount'=>$payment['amount']));
            $success = 'success';
            
             $order_id = Order::insertGetId([
                   'user_id' =>     $userid,
                   'district_id' => $request->district,
                   'state'    => $request->city,
                   'name'    => $request->name,
                   'email'    => $request->email,
                   'phone'    => $request->phone,
                   'post_code'    => $request->post_code,
                   'notes' => $request->address,
                   'instructions' => $request->instructions,
                   'payment_type' => $payment['method'],
                   'payment_method' => 'Razorpay',
                   'payment_id' =>  $request->razorpay_payment_id,
                   'currency' => $payment['currency'],
                   'order_number' => $request->razorpay_payment_id,
                   'amount' => $request->amount,
                   'invoice_no' => 'EOS'.mt_rand(10000000,99999999),
                   'order_date' => Carbon::now()->format('d F Y'),
                   'order_month' => Carbon::now()->format('F'),
                   'order_year' => Carbon::now()->format('Y'),
                   'status'     => 'pending',
                   'payment_status'=> $success,
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
                
                 if(Session::has('coupon')){
                $total_amount = Session::get('coupon')['total_amount'];
                } else {
                $total_amount = Cart::total();
                }
                $general = General::where('id',1)->first();
                $invoice = Order::with('district','user')->findOrFail($order_id);
                $orderItem = OrderItem::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();
                
                $array = [
                'invoice_no'=> $invoice->invoice_no,
                'amount'    => $total_amount,
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
                'aemail'       => $general->email, 
                'aphone'       => $general->phone, 
                'general'  => $general,
                ];
                Mail::to($array['aemail'])->send(new OrderMail($array));
                
                if(Session::has('coupon')){
                Session::forget('coupon');
                }
                Session::put('success', 'Payment successful');
                Cart::destroy();
                 } catch (\Exception $e) {
                return  $e->getMessage();
                Session::put('error',$e->getMessage());
                $success = 'failed';
                return redirect()->back();
                }
                }
                return response()->json(['success' => 'Payment successful']);
    }


    public function SuccessOrders($rzpId,$amount){
         Cart::destroy();
        Session::put('success', 'Payment successful');
      return view('frontend.payment.success',['rzpId' => $rzpId,'amount' => $amount,'success' => Session::get('success')]);
    }

    public function RazorCancel(){
    Cart::destroy();
    Session::put('error', 'Payment Cancel');
    return view('frontend.payment.cancel',['error' => Session::get('error')]);
    }

}