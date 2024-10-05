<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
class ChangePasswordController extends Controller
{
public function __construct()
{
$this->middleware('admin');
}
public function create(){
return view('admin.pages.changepassword', ['head' => 'Laravel - Change Password with Current Password']);
}
public function store(Request $request)
{
$request->validate([
'current_password' => ['required', new MatchOldPassword],
'new_password' => ['required'],
'new_confirm_password' => ['same:new_password'],
]);
$user=Admin::find(auth('admin')->user()->id)->update(['password'=> Hash::make($request->new_password)]);
return redirect()->action('Admin\ChangePasswordController@create')->with('success', 'Password change successfully.');
}
}
?>