<?php
namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use App\Admin\Models\State;

class LocationController extends Controller
{

public function states(){
$states = State::where('status',1)->orderBy('sort_order','ASC')->get();
return view('states',compact('states'));
}    


public function statenews($id){
$states = State::where('status',1)->orderBy('sort_order','ASC')->get();
$info = State::where('slug_url', $id)->first(); 
return view('states',compact('info','states'));
}

public function locationbystates($id,$pid){
$states = State::where('status',1)->orderBy('sort_order','ASC')->get();
$info = State::where('slug_url', $id)->first(); 
$infos = City::where('slug_url', $pid)->first(); 
return view('location',compact('states','info','infos'));
}

}
