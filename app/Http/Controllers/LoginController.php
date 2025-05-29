<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
     public function create()
    {
      return view('login');
    }  
    public function store(){
      $customer = request()->validate([
        "email"=> "required",
        "password" => "required"
      ]);

      if(auth()->attempt($customer)){
        return redirect('/dashboard')->with('success','welcome Back!');
      }

      return back()
        ->withInput()
        ->withErrors(['email'=>'Email not found']);
      
    } 
}
