<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Events\ResetUserPassword;
use Illuminate\Auth\Notifications\ResetPassword;

class UserController extends Controller
{
    public function index(){
        $users = User::where('role','customer')->get();
        return view('admin.all_users')->with("users", $users );
    }

    public function resetPassword(User $user){
        event(new ResetUserPassword($user));
        return redirect("/all_users")->with("reset","password reset successfully");
    }

    public function destroy(User $user){
        $user->delete();
        return redirect("/all_users")->with("delete","user deleted successfully");
    }
}
