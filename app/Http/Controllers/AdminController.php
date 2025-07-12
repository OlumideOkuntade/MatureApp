<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
  {
    public function create()
    {
      return view('admin.login');
    }  

    public function create_register()
    {
      $groups = UserGroup::all();
      return view('admin.register')->with('groups',$groups);
    }

     public function store_register()
    {
      request()->validate([
        "firstname"=> "required",
        "lastname"=> "required",
        "email"=> "required|email|unique:users,email",
        "phone"=> "required|min:11",
        "password"=> "required|min:3",
        "group"=> "required",
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
        "user_group_id"=> request()->group,
        "user_id"=> $user->id

      ]);
      auth()->login($user);
      return redirect('/admin/dashboard')->with("success",'Registration successful, Please login');
    }

    public function store(){
      $user = new User;
      if(!$user->isCustomer()){
        $admin = request()->validate([
          "email"=> "required",
          "password" => "required"
        ]);
      }
     
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
