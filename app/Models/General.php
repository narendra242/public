<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class General extends Model {
public $fillable = ['title','owner','main_heading','sub_title','sub_heading','address','email','emailto','phone','contact','whats_app','weburl','gmap','analytics','webmaster','chat_widget','open_hours','title_tag','canonical_tag','meta_description','meta_keyword','image','alt_tag','social_data','copyright_text','shipping','return_replace','sort_order','status'];
}
