<?php

namespace App\Http\Controllers;
use App\models\Customer;
use Illuminate\Http\Request;


class RegisterController extends Controller
{
    public function create(){
       return view('register');
    }  
    public function store(){
       $data = request()->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'required',
            'password' =>'required|min:3',
            'radio' => 'required'
       ]);
        $data['password'] = bcrypt($data['password']);
        Customer::insert([
            "first_name" => $data['firstname'], 
            "last_name" => $data['lastname'], 
            "email" => $data['email'], 
            "password" => $data['password'], 
            "phone_number" => $data['phone']
        ]);
        session()->flash('success','Registration successful, Please login');
        return redirect()->back()->with('success','Registration successful, Please login');

    } 
}
