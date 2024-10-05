<?php
namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Mail\OrderMail;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Redirect;

  
class PaypalController extends Controller
{    
     public function paypalStore(Request $request)
     {  

        if(Cart::content()->isEmpty()){
        return redirect()->route('index');
        } else {       
        if(Session::has('coupon')){
        $total_amount = Session::get('coupon')['total_amount'];
        } else {
        $total_amount = Cart::total();
        }
        if(Auth::user()){
        $userid= Auth::id();
        } else {
        $userid= '0';
        } 
        
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $token = $provider->getAccessToken();
        $provider->setAccessToken($token);
        $response = $provider->createOrder([
        "intent" => "CAPTURE",
        "application_context" => [
        "return_url" => route('success.payment'),
        "cancel_url" => route('cancel.payment'),
        ],
        "purchase_units" => [ 0 => [
        "amount" => [
        "currency_code" => "USD",
        "value" => round($total_amount),
         ],
        ]
        ]
        ]);
       if (isset($response['id']) && $response['id'] != null) {
        $order_id = Order::insertGetId([
                'user_id' => $userid,
                'district_id' => $request->district_id,
                'state'    => $request->state_id,
                'name'    => $request->shipping_name,
                'email'    => $request->shipping_email,
                'phone'    => $request->shipping_phone,
                'post_code'    => $request->post_code,
                'notes' => $request->notes,
                'payment_type' => "Paypal",
                'payment_id' =>  $response['id'],
                'currency' => "USD",
                'order_number' => $response['id'],
                'amount' => $total_amount,
                'invoice_no' => 'EOS'.mt_rand(10000000,99999999),
                'order_date' => Carbon::now()->format('d F Y'),
                'order_month' => Carbon::now()->format('F'),
                'order_year' => Carbon::now()->format('Y'),
                'status'     => 'pending',
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
                 'created_at'=> Carbon::now(),
               ]);
             }
        if(Session::has('coupon')){
        Session::forget('coupon');
        }
        Cart::destroy();
        foreach ($response['links'] as $links) {
        if ($links['rel'] == 'approve') {
        return redirect()->away($links['href']);
        }
        }
        return redirect()
        ->route('cancel.payment')
        ->with('error', 'Something went wrong.');
        } else {
        return redirect()
        ->route('create.payment')
        ->with('error', $response['message'] ?? 'Something went wrong.');
        }
}
}


public function paymentCancel(Request $request)
{
$provider = new PayPalClient;
$provider->setApiCredentials(config('paypal'));
$provider->getAccessToken();
$response = $provider->capturePaymentOrder($request['token']);
return redirect()
->route('create.payment')->with('error', $response['message'] ?? 'You have canceled the transaction.');
}
 
public function paymentSuccess(Request $request)
{
$provider = new PayPalClient;
$provider->setApiCredentials(config('paypal'));
$provider->getAccessToken();
$response = $provider->capturePaymentOrder($request['token']);
if (isset($response['status']) && $response['status'] == 'COMPLETED') {
Order::where('payment_id', $response['id'])->update(['payment_status' => 'success']);     
Session::put('success', 'Payment successful');
return redirect()
->route('create.payment')
->with('success', 'Transaction complete.');
} else {
Order::where('payment_id', $response['id'])->update(['payment_status' => 'Failed']);            
return redirect()
->route('create.payment')
->with('error', $response['message'] ?? 'Something went wrong.');
}
}

public function paypalpayment(){
return view('frontend.payment.paypal');

}
}