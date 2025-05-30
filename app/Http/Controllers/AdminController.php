<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;

class AdminController extends Controller
{
      public function create()
    {
      return view('admin.login');
    }  

    public function store(){
        $admin = request()->validate([
        "name"=> "required",
        "password" => "required"
      ]);
        $ad = new Admin;
      if(auth()->attempt($admin)){
        return redirect('/')->with('success','welcome Back!');
      }

      return back()
        ->withInput()
        ->withErrors(['name'=>'username not found']);
      
    }
}
