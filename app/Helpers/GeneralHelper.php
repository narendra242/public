<?php
namespace App\Helpers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\ProductSize;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
class GeneralHelper{

public static function Generals(){
return DB::table('generals')->where('id', 1)->first();
}

public static function getsize($title='') {
$array=array(1 => 'Banner',2 => 'Cms Page',3 => 'Category',4 => 'Product',5 => 'Logo',6 => 'Review');
if($title!="")
return $array[$title];
else
return $array;
}

 
public static function SubCategories($id=null){
return DB::table('product_categories')->where('parent_id', $id)->where('status', 1)->orderBy('sort_order','ASC')->get();
}

public static function product_sizes($id){
return ProductSize::where('product_id', $id)->get();
}

public static function multicatsvalids($eid,$catsid){
if($eid!=$catsid)
return true;
else
return false;
}

public static function getcontant($title=''){
$array= array(1 => 'Product Category',2 => 'Photo Gallery',3 => 'Video Gallery',4 => 'Contact us',5 => 'Testimonials',6 => 'Services',7 => 'Blog',8 => 'Wholesale',9 => 'Faq',10 => 'New Arrival',11 => 'Search Products',12 => 'Cart',13 => 'Checkout',14 => 'Store Locator',15 => 'Our Founder
',16 => 'How to Order',17 => 'Comfortable Products',18 => 'Sale');
if($title!="")
return $array[$title];
else
return $array;
}

public static function ConvertCurrency($amount = null){
if(@session()->get('currency')['code'] == 'USD'){
$value = round(session()->get('currency')['value']);
$converted= ($amount/$value);
return round($converted,2);
} else {
Session::forget('currency');
return round($amount,2);
}
}

public static function ProductDiscount($price,$price_discount){
$damount=$price_discount/100*$price;
return $price-$damount;
}

public static function curIcons(){
if(isset(session()->get('currency')['code']) == 'USD'){
return 'usd';
} else {
return 'rupee';
}
}

public static function sortOrder($id,$table,$field,$title,$orderpos='')
{
$positions=DB::table($table)->orderBy('sort_order', 'ASC')->get();
$order_list=array(array(0,"First"));
$selected_pos=-1;
$default_position=$orderpos?$orderpos:"first";
foreach($positions as $position)
{
if($id==$position->$field)
$selected_pos=count($order_list);
else
$order_list[]=array($position->sort_order,'After '.$position->$title.'');
}
$selected_pos=($selected_pos==-1 && $default_position=='Last')?count($order_list):$selected_pos;
$lstcounter=1;
foreach($order_list as $ck => $cv)
{
echo "<option value='$cv[0]' ".(($selected_pos==$lstcounter)?" selected='selected' ":"").">$cv[1]</option>";
$lstcounter++;
}
}

public static function sortOrderwhrids($id,$table,$field,$wid,$title,$orderpos='')
{
$positions=DB::table($table)->where($field,$wid)->orderBy('sort_order', 'ASC')->get();
$order_list=array(array(0,"First"));
$selected_pos=-1;
$default_position=$orderpos?$orderpos:"first";
foreach($positions as $position)
{
if($id==$position->id)
$selected_pos=count($order_list);
else
$order_list[]=array($position->sort_order,'After '.$position->$title.'');
}
$selected_pos=($selected_pos==-1 && $default_position=='Last')?count($order_list):$selected_pos;
$lstcounter=1;
foreach($order_list as $ck => $cv)
{
echo "<option value='$cv[0]' ".(($selected_pos==$lstcounter)?" selected='selected' ":"").">$cv[1]</option>";
$lstcounter++;
}
}

public static function getimagesize($secid=null){
return DB::table('resize_images')->where('sec_id', $secid)->first();
}
public static function uploadimage($file=null,$dir=null,$sizid=null){
if(!empty($file)){
$size = self::getimagesize($sizid);
$file_arr       = explode(".", $file->getClientOriginalName());
$ext            = array_pop($file_arr);
$image          = Str::slug(implode(".",$file_arr),'-').'-'.time().'.'.$ext;
$image_resize = Image::make($file->getRealPath());
$file->move(public_path('/').$dir.'/',$image);
if(!empty($size)){
$image_resize->resize($size->sec_width,$size->sec_height);
$image_resize->save(public_path($dir.'/'.$image));
}
return $image;
} else {
return null;
}
}

public static function uploadpdf($file=null,$dir=null){
if(!empty($file)){
$file_arr       = explode(".", $file->getClientOriginalName());
$ext            = array_pop($file_arr);
$image          = Str::slug(implode(".",$file_arr),'-').'-'.time().'.'.$ext;
$file->move(public_path('/').$dir.'/',$image);
return $image;
} else {
return null;
}
}

public static function status($id,$status,$table)  {
$get_query = DB::table($table)->where('id', $id)->update(['status' => $status]);
if($get_query) {
return true;
} else {
return false;
}
}
public static function match($first='',$second='')
{
if($first==$second)
return "selected";
}
}