<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Helpers\GeneralHelper;
use App\Models\Brand;
use App\Models\Color;
use App\Models\ProductSize;
use App\Models\Size;
use Illuminate\Support\Carbon;

class ProductController extends Controller
{
public $directory="product_images";    
public $tmdirectory="product_more_images";

public function create(){
$brands = Brand::pluck('title', 'id')->prepend('Choose a Brand ', '');
$sizes = Size::select('title', 'id')->orderBy('sort_order')->get(); 
$categories = ProductCategory::orderBy('sort_order')->get(); 
$products = Product::all();
return view('admin.pages.addproduct',compact('products','categories','brands','sizes'),['head' => 'Add Product']);
}

public function store(Request $request){
$validator = Validator::make($request->all(),[
'title'         => 'required',
'cat_id'        => 'required',
'slug_url' 		=> 'required|min:5|max:255|unique:products',
'image'         => 'mimes:jpeg,jpg,png,gif,webp',
'banner'        => 'mimes:jpeg,jpg,png,gif,webp',
]); 

if(!$validator->passes()){
return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
}else{
$data   = $request->all();
if(!empty($request->get('cat_id'))){
$data['cat_id'] = implode(",", $request->get('cat_id'));  
} else {
$data['cat_id'] = '';  	
}

if(!empty($request->get('tag_related'))){
$data['tag_related'] = implode(",", $request->get('tag_related'));  
} else { $data['tag_related'] = '';  }

if(!empty($request->get('color_related'))){
$data['color_related'] = implode(",", $request->get('color_related'));  
} else { $data['color_related'] = '';  }

if(!empty($request->get('rel_product'))){
$data['rel_product'] = implode(",", $request->get('rel_product'));  
} else { $data['rel_product'] = '';  }
 

$data["slug_url"] = Str::slug($request->slug_url);

if ($request->get('featured_product')) $data['featured_product']=1; else $data['featured_product']=0;	
if ($request->get('arrival_product')) $data['arrival_product']=1; else $data['arrival_product']=0;

if ($request->get('sale_product')) $data['sale_product']=1; else $data['sale_product']=0;

if ($request->get('cstm_name')) $data['cstm_name']=1; else $data['cstm_name']=0;

if(!empty($request->file('image'))){    
$photo = GeneralHelper::uploadimage($request->file('image'),$this->directory,4);
$data['image'] = $photo;
}

if(!empty($request->file('banner'))){    
$banner = GeneralHelper::uploadimage($request->file('banner'),$this->directory,4);
$data['banner'] = $banner;
}



$user = Product::create($data);
if(!empty($request->input('related_size'))) {	
foreach ($request->input('related_size') as $adsize) {
$size = Size::where('id',$adsize['size_id'])->first();
ProductSize::insert([
'product_id'=>  $user->id,
'size_id' 	=>  $adsize['size_id'],
'size_title'=>  $size['title'],
'price' 	=>  $adsize['price'],
'sort' 	    =>  $adsize['sort'],
'created_at' => Carbon::now(),
]);
}
}
Product::where('sort_order', '>', $request->sort_order)->update(['sort_order' => DB::raw('sort_order + 1')]);
Product::where('id', '=', $user->id)->update(['sort_order' => $request->sort_order+1]); 
if($user){
return response()->json(['status'=>1, 'msg'=>'Record created successfully']);
}
}
}

public function product(){
$ids = (!empty($_GET["cat_id"])) ? ($_GET["cat_id"]) : ('');
$categories = ProductCategory::orderBy('sort_order')->where('parent_id',0)->get();     
if(!empty($ids)) {
$datas = Product::whereRaw("find_in_set($ids,cat_id)")->paginate(50);	
} else {
$datas = Product::orderBy('sort_order', 'ASC')->paginate(50);	
}
return view('admin.pages.product',['datas'=>$datas,'categories'=>$categories], ['head' => 'Product']);
}

public function edit($id){
$get_record= Product::find($id);
$brands = Brand::pluck('title', 'id')->prepend('Choose a Publisher ', '');
$sizes = Size::select('title', 'id')->orderBy('sort_order')->get(); 
$categories = ProductCategory::orderBy('sort_order')->get(); 
$products = Product::where('id', '!=', $id)->get();
if(!empty($get_record)){
return view('admin.pages.addproduct',compact('get_record','products','categories','brands','sizes'),['head' => 'Edit Product']);
}else{
return redirect()->action('admin\ProductController@product');
}
}
 

public function update(Request $request){
$validator = Validator::make($request->all(),[
'title'         => 'required',
'slug_url' 		=> 'required|unique:products,slug_url,' . $request->id,
'image'         => 'mimes:jpeg,jpg,png,gif,webp',
'banner'         => 'mimes:jpeg,jpg,png,gif,webp'
]); 
if(!$validator->passes()){
return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
}else{
$data   = $request->all();
 
if(!empty($request->get('cat_id'))){
$data['cat_id'] = implode(",", $request->get('cat_id'));  
} else {
$data['cat_id'] = '';  	
}

if(!empty($request->get('tag_related'))){
$data['tag_related'] = implode(",", $request->get('tag_related'));  
} else { $data['tag_related'] = '';  }

$data["slug_url"] = Str::slug($request->slug_url);

if ($request->get('featured_product'))
$data['featured_product']=1;
else
$data['featured_product']=0;	

if ($request->get('arrival_product')) 
$data['arrival_product']=1; 
else 
$data['arrival_product']=0;


if ($request->get('sale_product')) $data['sale_product']=1; else $data['sale_product']=0;

if ($request->get('cstm_name')) $data['cstm_name']=1; else $data['cstm_name']=0;

 
if(!empty($request->get('color_related'))){
$data['color_related'] = implode(",", $request->get('color_related'));  
} else { $data['color_related'] = '';  }
     
if(!empty($request->get('rel_product'))){
$data['rel_product'] = implode(",", $request->get('rel_product'));  
} else { $data['rel_product'] = '';  }

$update_record = Product::find($data['id']);

if(!empty($request->input('related_size'))) {	
foreach ($request->input('related_size') as $adsize) {
$size = Size::where('id',$adsize['size_id'])->first();
if(!empty($adsize['size_uid'])){   
 ProductSize::where('id',$adsize['size_uid'])->update([
'product_id'=>  $update_record->id,
'size_id' 	=>  $adsize['size_id'],
'size_title'=>  $size['title'],
'price' 	=>  $adsize['price'],
'sort' 	    =>  $adsize['sort'],
'created_at' => Carbon::now(),
]);
} else {
ProductSize::insert([
'product_id'=>  $update_record->id,
'size_id' 	=>  $adsize['size_id'],
'size_title'=>  $size['title'],
'price' 	=>  $adsize['price'],
'sort' 	    =>  $adsize['sort'],
'created_at' => Carbon::now(),
]);
}
}
}
if(!empty($update_record)){
if(!empty($request->file('image'))){    
$photo = GeneralHelper::uploadimage($request->file('image'),$this->directory,4);
$data['image'] = $photo;
if(!empty($update_record->image) && file_exists(public_path('/').$this->directory.'/'.$update_record->image)){
unlink(public_path('/').$this->directory.'/'.$update_record->image);
}
}

if(!empty($request->file('banner'))){    
$banner = GeneralHelper::uploadimage($request->file('banner'),$this->directory);
$data['banner'] = $banner;
if(!empty($update_record->banner) && file_exists(public_path('/').$this->directory.'/'.$update_record->banner)){
unlink(public_path('/').$this->directory.'/'.$update_record->banner);
}
}
 
$update_record->update($data);
$update_record->where('sort_order', '>', $request->sort_order)->update(['sort_order' => DB::raw('sort_order + 1')]);
$update_record->where('id', '=', $update_record->id)->update(['sort_order' => $request->sort_order+1]); 
return response()->json(['status'=>1, 'msg'=>'Record updated successfully']);
}
}
}
 

public function delete($id){
$del_record = Product::find($id);
$del_img= ProductImage::where('product_id', '=', $id);
$get_imgs = ProductImage::where('product_id', $id)->get();

if(!empty($del_record)){
$del_record->delete();
$del_img->delete();
if(!empty($del_record->image)){
unlink(public_path('/').$this->directory.'/'.$del_record->image);
}
if(!empty($del_record->banner)){
unlink(public_path('/').$this->directory.'/'.$del_record->banner);
}
foreach($get_imgs as $imgs){
unlink(public_path('/').$this->tmdirectory.'/'.$imgs->image);
} 
return response()->json(['status'=>'Record deleted successfully.']);
} else {
return response()->json(['status'=>'Delete record failed.']);
}
}

public function ProductStock(){
$products = Product::latest()->get();
return view('admin.product.product_stock',compact('products'));
}

public function changeStatus(Request $request)  {
$result=GeneralHelper::status($request->input('id'),$request->input('status'),$request->input('table'));
if($result){
return response()->json(['success'=>'Status change successfully.']);
} else {
return response()->json(['failed'=>'Status failed.']);
}
}


public function addimages(Request $request){
    $validator = Validator::make($request->all(),[
    'product_id'  => 'required',
    'title'       => 'required',
    'image'       => 'required|mimes:jpeg,jpg,png,gif,webp'
    ]); 
    if(!$validator->passes()){
    return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
    }else{
    $data   = $request->all();
    if(!empty($request->file('image'))){    
    $photo = GeneralHelper::uploadimage($request->file('image'),$this->tmdirectory,4);
    $data['image'] = $photo;
    }
    $user = ProductImage::create($data);
    $data['id'] = $user->id;
    return response()->json(['success'=>1, 'msg'=>'Record updated successfully','datas'=>$data]);
    }
}

public function imgdelete($id){
$del_imgs = ProductImage::find($id);	
if(!empty($del_imgs)){
$del_imgs->delete();
if(!empty($del_imgs->image)){
unlink(public_path('/').$this->tmdirectory.'/'.$del_imgs->image);
}
return response()->json(['status'=>'Record deleted successfully.']);
} else {
return response()->json(['status'=>'deleted failed.']);
}
}
 

public function getimages($id)
{
$products = Product::find($id);
$datas = $products->product_images()->get();
return view('admin.pages.model_product_images',['data' => $products,'datas' => $datas]);
}

public function searchcolors(Request $request)
{
$data = Color::select("title","id")->where('title', 'LIKE', '%'. $request->get('filter_name'). '%')->limit(10)->get();
return response()->json($data);
}

public function searchrelprods(Request $request)
{
$data = Product::select("title","id")->where('title', 'LIKE', '%'. $request->get('filter_name'). '%')->limit(10)->get();
return response()->json($data);
}
}
