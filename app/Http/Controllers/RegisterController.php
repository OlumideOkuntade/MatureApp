<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;



class RegisterController extends Controller
{
    public function create(){
       return view('register');
    }  
    
    public function store(){
        request()->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'required',
            'password' =>'required|min:3',
            'radio' => 'required'
       ]);
        
        Customer::create([
            "first_name" => request()->firstname, 
            "last_name" => request()->lastname, 
            "email" => request()->email, 
            "password" => bcrypt(request()->password),
            "phone_number" => request()->phone 
        ]);
        $customer = Customer::latest()->first();
        $user = User::create([
            "email" => request()->email, 
            "password" => bcrypt(request()->password),
            'role'=> 'user',
            'customer_id'=> $customer->id
        ]);

        auth()->login($user);
        return redirect()->to('/login')->with('success','Registration successful, Please login');

    } 
}
