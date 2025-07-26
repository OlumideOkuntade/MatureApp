<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use Spatie\Activitylog\Facades\Activity;



class AdminController extends Controller
{
  public function create()
  {
    return view('admin.login');
  }  

  public function store_register()
  {
    request()->validate([
      "firstname"=> "required",
      "lastname"=> "required",
      "email"=> "required|email|unique:users,email",
      "phone"=> "required|min:11",
      "password"=> "required|min:3",
    ]);

    $user = User::create([
      "email" => request()->email, 
      "password" => bcrypt(request()->password),
      "verified_at"=> now(),
      "role"=> "admin"
    ]);
    $user = User::latest()->first();
    Admin::create([
      "first_name" => request()->firstname, 
      "last_name" => request()->lastname, 
      "phone_number" => request()->phone,
      "user_id"=> $user->id
    ]);
    
   auth()->login($user);
    return redirect('/admin/dashboard')->with("success",'Registration successful, Please login');
  }

  public function store(Request $request){
    $admin = $request->validate([
      "email"=> "required",
      "password" => "required"
    ]);
    if(auth()->attempt($admin)){

    return redirect('/admin/dashboard')->with('success','welcome Back!');
  }
    return back()
    ->withInput()
    ->withErrors(['email'=>'detail not found']);
  }

  public function destroy()
  {
    auth()->logout();
    return redirect('/admin/login')->with('success','Goodbye!');
  } 

}
