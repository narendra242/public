<?php
namespace App\Http\Controllers\User;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Contant;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
class CartPageController extends Controller
{
   public function MyCart(){
    $carts = Cart::content();
    $contants = Contant::where('title', 12)->first();   
    if(sizeof($carts)){
    return view('frontend.wishlist.view_mycart',compact('contants'));
    } else {
    return redirect()->route('index');
    }
   }
   public function GetCartProduct(){
    $carts = Cart::content();
    $cartQty = Cart::count();
    $cartTotal = Cart::total();
   
    return response()->json(array(
        'carts' => $carts,
        'curIcons' => Product::curIcons(),
        'cartQty' => $cartQty,
        'cartTotal' => $cartTotal
    ));
   }
   public function RemoveCartProduct($rowId){
    Cart::remove($rowId);
    $cartQty = Cart::count();
    if(Session::has('coupon')){
    Session::forget('coupon');
    }
    return response()->json(['success' => 'Product remove from Cart','cartQty' => $cartQty]);
   }
   
    public function RemoveAllCartProduct(){
    Cart::destroy();
    if(Session::has('coupon')){
    Session::forget('coupon');
   
    }
    return response()->json(['success' => 'Remove items from Cart']);
   }
   public function CartIncrement($rowId){
    $row = Cart::get($rowId);
    Cart::update($rowId, $row->qty + 1);
    if(Session::has('coupon')){
    $total = Cart::total();
    $totals = Cart::total();
    $coupon_name = Session::get('coupon')['coupon_name'];
    $coupon = Coupon::where('coupon_name',$coupon_name)->first();
        Session::put('coupon',[
        'coupon_name' => $coupon->coupon_name,
        'coupon_discount' => $coupon->coupon_discount,
        'discount_amount' => round($total * $coupon->coupon_discount/100),
        'total_amount' => round($totals - $totals * $coupon->coupon_discount/100)
        ]);
    }
    return response()->json('increment');
   }
   public function CartDecrement($rowId){
    $row = Cart::get($rowId);
    Cart::update($rowId, $row->qty - 1);
    if(Session::has('coupon')){
    $coupon_name = Session::get('coupon')['coupon_name'];
    $coupon = Coupon::where('coupon_name',$coupon_name)->first();
    $total = Cart::total();
    $totals = Cart::total();
      Session::put('coupon',[
        'coupon_name' => $coupon->coupon_name,
        'curIcons' => Product::curIcons(),
        'coupon_discount' => $coupon->coupon_discount,
        'discount_amount' => round($total * $coupon->coupon_discount/100),
        'total_amount' => round($totals - $totals * $coupon->coupon_discount/100)
        ]);
    }
    return response()->json('decrement');
   }
}
