<?php
namespace App\Http\Controllers\User;
use App\Models\Order;
use App\Models\OrderItem;
use App\Http\Controllers\Controller;
use App\Mail\OrderMail;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Models\General;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class CashController extends Controller
{
public function CashOrder(){
if(Session::has('coupon')){
Session::forget('coupon');
}
Cart::destroy();

return view('frontend.payment.cash');
}
}