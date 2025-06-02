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
      $user = request()->validate([
        "name"=> "required",
        "password" => "required",
        'role'=> "required|admin"
      ]);

      if(auth()->attempt($user)){
        return redirect('/')->with('success','welcome Back!');
      }

      return back()
        ->withInput()
        ->withErrors(['name'=>'username not found']);
      
    }
}
