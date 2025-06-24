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
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|min:11',
            'password' =>'required|min:3',
            'radio' => 'required'
       ]);
        
        Customer::create([
            "first_name" => request()->firstname, 
            "last_name" => request()->lastname, 
            "phone_number" => request()->phone 
        ]);
        $customer = Customer::latest()->first();
        $user = User::create([
            "email" => request()->email, 
            "password" => bcrypt(request()->password),
            'role'=> 'customer',
            'admin_id'=> "1",
            'customer_id'=> '2'
        ]);

        auth()->login($user);
        return redirect()->to('/login')->with('success','Registration successful, Please login');
    } 
}
