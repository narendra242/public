<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use AmrShawky\LaravelCurrency\Facade\Currency;
use Illuminate\Support\Facades\Session;

class Product extends Model
{
use HasFactory;
protected $guarded = ['search'];

function product_images(){
return $this->hasMany(ProductImage::class,'product_id','id');
}

public function catslist()
{
return $this->belongsTo(ProductCategory::class,'cat_id','id');
}

public function catmorelist($id = null)
{
if(!empty($id)){
return ProductCategory::WhereIn('id',$id)->get();
}
}

public function brand()
{
return $this->belongsTo(Brand::class,'brand_id','id');
}

function product_sizes(){
return $this->hasMany(ProductSize::class,'product_id','id')->orderBy('sort','ASC');
}

public function tags($id = null)
{
if(!empty($id)){
return Tag::WhereIn('id',$id)->get();
}
}

public function color($id = null)
{
if(!empty($id)){
return Color::WhereIn('id',$id)->get();
}
}

public function rel_prod($id = null)
{
if(!empty($id)){
return Product::WhereIn('cat_id',$id)->get();
}
}
public static function sizetitle($sizid = null){
return Size::select('title', 'id')->where('id',$sizid)->first();
}

public static function ProductDiscount($price,$price_discount){
$damount=$price_discount/100*$price;
return $price-$damount;
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

public static function curIcons(){
if(@session()->get('currency')['code'] == 'USD'){
return 'rupee-sign';
} else {
return 'rupee-sign';
}
}

public static function curIcon(){
if(@session()->get('currency')['code'] == 'USD'){
return '₹';
} else {
return '₹';
}
}
}