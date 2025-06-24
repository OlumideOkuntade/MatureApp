<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use App\Models\Customer;

class AdminController extends Controller
  {
    public function create()
    {
      return view('admin.login');
    }  

    public function create_register()
    {
      return view('admin.register');
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
      Customer::create([
        "first_name" => request()->firstname, 
        "last_name" => request()->lastname, 
        "phone_number" => request()->phone 
      ]);
      $customer = Customer::latest()->first();
      $admin = User::create([
        "email" => request()->email, 
        "password" => bcrypt(request()->password),
        'role'=> 'admin',
        'customer_id'=> $customer->id
      ]);
      auth()->login($admin);
      return redirect('/admin/login')->with("success",'Registration successful, Please login');
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
