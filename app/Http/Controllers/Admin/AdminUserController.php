<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminUserController extends Controller
{
    public function AllUsers(){
    $users = User::latest()->get();
    return view('admin.user.all_user',compact('users'),['head' => 'All User']);
    }
}
