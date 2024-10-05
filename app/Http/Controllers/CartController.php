<?php
namespace App\Http\Controllers;
use App\Models\Coupon;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\ShipDivision;
use App\Models\ShipDistrict;
use App\Models\Wishlist;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function AddToCart(Request $request, $id){
         $product = Product::findOrFail($id);
        if(Session::has('coupon')){
            Session::forget('coupon');
            }
        if($product->discount == NULL)
         {
         Cart::add([
            'id' => $id,
            'name' => $product->title,
            'qty' => $request->quantity,
            'price' => $product->price,
            'weight' => 1,
            'options' => [
                'image' => $product->image,
                 'slug_url' => $product->slug_url,
                 'pcode' => $product->product_code,
                 'user_name' => $request->user_name,
                 'color' => $request->color,
                 'size' => $request->size,

            ],
            ]);
            return response()->json(['success' => 'Successfully Added on Your Cart']);
        }
        else {
            Cart::add([
                'id' => $id,
                'name' => $product->title,
                'qty' => $request->quantity,
                'price' => Product::ProductDiscount($product->price,$product->discount),
                'weight' => 1,
                'options' => [
                    'image' => $product->image,
                    'slug_url' => $product->slug_url,
                    'pcode' => $product->product_code,
                    'user_name' => $request->user_name,
                    'color' => $request->color,
                    'size' => $request->size,
                ],
                ]);
            return response()->json(['success' => 'Successfully Added on Your Cart']);

        }

    }


        public function AddMiniCart(){
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
        'carts' => $carts,
        'cartQty' => $cartQty,
        'cartTotal' => $cartTotal,
        'curIcons' => Product::curIcons(),
        ));
        }


        public function RemoveMiniCart($rowId){
        Cart::remove($rowId);
        return response()->json(['success' => 'Product remove from Cart']);
        }

        public function AddToWishlist(Request $request, $product_id){
            if(Auth::check()){
             $exists = Wishlist::where('user_id',Auth::id())->where('product_id',$product_id)->first();
            if(!$exists){
             Wishlist::insert([
            'user_id' => Auth::id(),
            'product_id' => $product_id,
            'created_at' => Carbon::now(),
            ]);
            return response()->json(['success' => 'Successfully Added on Your Wishlist']);
            } else {
            return response()->json(['error' => 'This Product has Already on Your Wishlist']);
            } } else {
            return response()->json(['error' => 'Add First Login Your Account']);
            }


          }

          public function CouponApply(Request $request){
            $total = Cart::total();
            $totals = Cart::total();
            $coupon = Coupon::where('coupon_name',$request->coupon_name)->where('coupon_validity','>=',Carbon::now()->format('Y-m-d'))->first();
            if($coupon){
           if($totals >=$coupon->shopping_amount || $coupon->shopping_amount==""){    
    
            Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round($total * $coupon->coupon_discount/100),
                'total_amount' => round($totals - $totals * $coupon->coupon_discount/100)
            ]);

            return response()->json(array(
                'validity' => true,
                'success' => 'Coupon Applied Successfully',
            ));
           } else {
            return response()->json(['error' => 'Shop More to get Discount']);
            }
            } else {
            return response()->json(['error' => 'Invalid Coupon']);
            }
           }

           public function CouponCalculation(){
            if(Session::has('coupon')){
                return response()->json(array(
                'subtotal' =>  round(Cart::total()),
                'curIcons' => Product::curIcons(),
                'coupon_name' => session()->get('coupon')['coupon_name'],
                'coupon_discount' => session()->get('coupon')['coupon_discount'],
                'discount_amount' => session()->get('coupon')['discount_amount'],
                'total_amount' => session()->get('coupon')['total_amount'],
                ));
                } else {
                return response()->json(array(
                'total' => round(Cart::total()),
                'curIcons' => Product::curIcons(),
                ));
            }
           }

           public function CouponRemove(){
            Session::forget('coupon');
            return response()->json(['success' => 'Coupon Deleted Successfully']);
           }

           public function CheckoutCreate(){
            if(Cart::total() > 0){
            $carts = Cart::content();
            $cartQty = Cart::count();
            $curIcons = Product::curIcons();
            $cartTotal = round(Cart::total());
            $districts = ShipDistrict::orderBy('district_name','ASC')->get();
            return view('frontend.checkout.checkout_view',compact('carts','cartQty','cartTotal','districts','curIcons'));

            } else {
            $notification = array(
            'message' => 'Shopping At list One Product',
            'alert-type' => 'error'
            );
            return redirect()->to('/')->with($notification);
            }
            }

}
