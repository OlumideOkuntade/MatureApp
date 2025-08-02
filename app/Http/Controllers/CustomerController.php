<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Events\ResetUserPassword;
use Illuminate\Auth\Notifications\ResetPassword;

class CustomerController extends Controller
{
    public function index(){
        $this->authorize('manage_customers');
        $users = User::where('role','customer')->get();
        return view('admin.all_customers')->with("users", $users );
    }

    public function resetPassword(User $user){
        event(new ResetUserPassword($user));
        return redirect("/all_customers")->with("reset","password reset successfully");
    }

    public function destroy(User $user){
        $user->delete();
        return redirect("/all_customers")->with("delete","user deleted successfully");
    }
}
