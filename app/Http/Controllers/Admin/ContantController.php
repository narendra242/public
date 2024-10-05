<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contant;
use Illuminate\Support\Facades\Validator;
use App\Helpers\GeneralHelper;

class ContantController extends Controller{
	public $directory="contant_images";    
	public function create(){
    return view('admin.pages.addcontant', ['head' => 'Add Contant']);
    }

    public function store(Request $request){
	$validator = Validator::make($request->all(),[
	'title'         => 'required',
	'title_tag'     => 'required',
	'image'         => 'mimes:jpeg,jpg,png,gif,webp'
	]); 
	if(!$validator->passes()){
	return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
	}else{
	$data   = $request->all();
	if(!empty($request->file('image'))){    
	$photo = GeneralHelper::uploadimage($request->file('image'),$this->directory);
	$data['image'] = $photo;
	}
	$user = Contant::create($data);
 	if($user){
	return response()->json(['status'=>1, 'msg'=>'Record created successfully']);
	}
	
	}
	}

	public function contant(){
	$CmsObj = new Contant();
	$contants = $CmsObj->get();
	return view('admin.pages.contant',['contants'=>$contants], ['head' => 'Contant']);
	}
	
	
	public function edit($id){
	$get_record= Contant::find($id);
	if(!empty($get_record)){
	return view('admin.pages.addcontant',['get_record'=>$get_record], ['head' => 'Edit Contant']);
	}else{
	return redirect()->action('Admin\ContantController@contant');
	}
	}
		
	public function update(Request $request){
	$validator = Validator::make($request->all(),[
	'title'         => 'required',
	'title_tag'     => 'required',
	'image'         => 'mimes:jpeg,jpg,png,gif,webp'
	]); 
	if(!$validator->passes()){
	return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
	}else{
	$data   = $request->all();

	$update_record = Contant::find($data['id']);
	if(!empty($update_record)){
	if(!empty($request->file('image'))){    
	$photo = GeneralHelper::uploadimage($request->file('image'),$this->directory);
	$data['image'] = $photo;
	if(!empty($update_record->image) && file_exists(public_path('/').$this->directory.'/'.$update_record->image)){
	unlink(public_path('/').$this->directory.'/'.$update_record->image);
	}
	}
	$update_record->update($data);
	}
	if($update_record){
	return response()->json(['status'=>1, 'msg'=>'Record updated successfully']);
	}
	}
	}
 

		public function delete($id){
		$get_record = Contant::find($id);
		if(!empty($get_record)){
		$get_record->delete();
		if(!empty($get_record->image)){
		unlink(public_path('/').$this->directory.'/'.$get_record->image);
		}
	 	return response()->json(['status'=>'Record deleted successfully.']);
		} else {
		return response()->json(['status'=>'Delete record failed.']);
		}
		}
		

		public function changeStatus(Request $request)  {
		$result=GeneralHelper::status($request->input('id'),$request->input('status'),$request->input('table'));
		if($result){
		return response()->json(['success'=>'Status change successfully.']);
		} else {
		return response()->json(['failed'=>'Status failed.']);
		}
		}
		}
 ?>