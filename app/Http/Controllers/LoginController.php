<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PragmaRX\Google2FA\Google2FA;

class LoginController extends Controller
{
  public function create()
  {
    return view('login');
  }  
  public function store(Request $request){
    $credentials = $request->validate([
      "email"=> "required",
      "password" => "required"
    ]);   
    if(auth()->attempt($credentials)){
      if(auth()->user()->google2fa_enabled){
        return redirect('/2fa/verify/form');
      }
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
