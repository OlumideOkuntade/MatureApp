<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
  public function create()
  {
    return view('login');
  }  
  public function store(Request $request){

    $user = $request->validate([
      "email"=> "required",
      "password" => "required"
    ]);   
    if(auth()->attempt($user)){
      return redirect('/dashboard')->with('success','welcome Back!');
    }
    return back()
      ->withInput()
      ->withErrors(['email'=>'Details not found']);
    
  }
  
  public function destroy()
  {
    auth()->logout();
    return redirect('/')->with('success','Goodbye!');
  }  
}
