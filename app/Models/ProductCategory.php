<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function subchilds()
	{
	return $this->hasMany(self::class,'id', 'parent_id');
	}

	public function subcategory()
	{
	return $this->hasMany(self::class,'parent_id', 'id');
	}
	
	public function parent()
	{
	return $this->belongsTo(self::class, 'parent_id');
	}

	public function productbycategories($id = null)
	{
	$parentCategory = ProductCategory::with('subcategory')->find($id);
	$allcatids = $parentCategory->subcategory->pluck('id')->push($id);
	if(!empty($id)){  
	return Product::whereIn('cat_id', $allcatids)->where('status', 1)->count();
	}
	}

 

	public function productbycatelist($id = null)
	{
	if(!empty($id)){   
	return Product::whereRaw("find_in_set('$id',cat_id)")->where('status', 1)->orderBy('sort_order','ASC')->limit(5)->get();  
	}
	}


	public function checktotalproduct($id){
	if(!empty($id)){ 
	return Product::whereRaw("find_in_set('$id',cat_id)")->where('featured_product', '!=' , 1)->where('status', 1)->first();  
	}	
	}

	public function checktotalproductlist($id){
	if(!empty($id)){ 
	return Product::whereRaw("find_in_set('$id',cat_id)")->where('status', 1)->first();  
	}	
	}
	
}
