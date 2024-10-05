<?php
namespace App\Http\Controllers;
use App\Models\Color;
use App\Models\Contant;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Size;
use App\Models\Review;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeProductController extends Controller
{
public function products(Request $request){
$contants = Contant::where('title', 1)->first();
$sizes = Size::where('status', 1)->orderBy('sort_order','ASC')->get();
$colors = Color::where('status', 1)->orderBy('sort_order','ASC')->get();
$brands = Brand::where('status', 1)->orderBy('sort_order','ASC')->get();
$products = Product::where('status', 1)->orderBy('sort_order','ASC')->orderBy('sort_order','ASC')->paginate(24);
if ($request->ajax()) {
$list_view = view('frontend.pages.list_view_product',compact('products'))->render();
return response()->json([$list_view]);
}
return view('frontend.products',compact('products','sizes','colors','contants','brands'));
}

public function subcategories(Request $request,$id=null){
$info = ProductCategory::where('slug_url', $id)->first();
$parentCategory = ProductCategory::with('subcategory')->find($info?->id);
$sizes = Size::where('status', 1)->orderBy('sort_order','ASC')->get();
$brands = Brand::where('status', 1)->orderBy('sort_order','ASC')->get();
if (!$parentCategory) {
return abort(404);
}
$categoryIds = $parentCategory->subcategory->pluck('id')->push($info->id);
$products = Product::whereIn('cat_id', $categoryIds)->where('status', 1)->orderBy('sort_order','ASC')->paginate(24);
$colors = Color::where('status', 1)->orderBy('sort_order','ASC')->get();
if ($request->ajax()) {
$list_view = view('frontend.pages.list_view_product',compact('products'))->render();
return response()->json([$list_view]);
}
if(is_null($info)){ abort(404); } else {
return view('frontend.products',compact('info','sizes','colors','products','brands'));
}
}

public function productdetails($pid=null){
$info = Product::where('slug_url', $pid)->first();
$reviewCount = Review::where('product_id',$info->id)->count();
if(is_null($info)){ abort(404); } else {
return view('frontend.product-details',compact('info','reviewCount'));
}
}

public function NewArrival(){
$contants = Contant::where('title', 10)->first();
$arrivals = Product::where('status',1)->where('arrival_product',1)->orderBy('sort_order','ASC')->get();
return view('frontend.new-arrival',compact('arrivals','contants'));
}

public function FilterProducts(Request $request){
    if (isset($request->sort)) {
    if($request->sort == 'asc'){
    $field = 'price';
    $sorts = 'ASC';
    } if($request->sort == 'desc') {
    $field = 'price';
    $sorts = 'DESC';
    } else {
    $field = 'sort_order';     
    $sorts = 'ASC';
    }
    } else {
    $field = 'sort_order';     
    $sorts = 'ASC';   
    }    
    $products = DB::table('products as pd')->where('pd.status', 1)->orderBy($field,$sorts);

    if (isset($request->brand)) {
    $products->where('pd.brand_id',$request->brand);
    }
    if (isset($request->size)) {
    $products->join('product_sizes as ps','pd.id','=','ps.product_id')->select('pd.*','ps.size_id')->whereIn('ps.size_id', (explode(" ",$request->size)));
    }

    if(isset($request->cat_id))
    {
    $products->whereRaw("find_in_set($request->cat_id,pd.cat_id)");
    }
    $products = $products->get();
   
    if ($request->ajax()) {
    $list_products = view('frontend.pages.list_view_product',compact('products'))->render();
    return response()->json([$list_products]);
    }
    }
}
