<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;

class AdminController extends Controller
{
      public function create()
    {
      return view('admin.login');
    }  

    public function store(){
      $user = auth()->user();
      if($user->role === "admin"){
        $user = request()->validate([
          "email"=> "required",
          "password" => "required"
        ]);
      }

      if(auth()->attempt($user)){
        return redirect('/admin/dashboard')->with('success','welcome Back!');
      }

      return back()
        ->withInput()
        ->withErrors(['email'=>'detail not found']);
      
    }
}
