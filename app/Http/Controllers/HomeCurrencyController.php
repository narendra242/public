<?php
namespace App\Http\Controllers;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeCurrencyController extends Controller {

    public function CurrencyChange($code = null){
        if(Session::has('currency')){
        Session::forget('currency');
        }
        $currency = Currency::where('code',$code)->first();
        if($currency){
        Session::put('currency',[
            'currency_title' => $currency->currency_title,
            'code' => $currency->code,
            'symbol_left' => $currency->symbol_left,
            'value' => $currency->value,
        ]);

         return redirect()->back();
         }
       }


}