<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(){
        $users = User::where('role','customer')->get();
        return view('admin.all_users')->with("users", $users );
    }

    public function destroy(User $user){
        $user->delete();
        return redirect("/all_users")->with("delete","user deleted successfully");
    }
}
