<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function newsbytags($id = null)
	{
	if(!empty($id)){   
	return News::whereRaw("find_in_set('$id',tag_related)")->where('status', 1)->orderBy('sort_order','ASC')->get();  
	}
}
}
