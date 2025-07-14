<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\UserManager;
use App\Services\CustomerManager;

class RegisterController extends Controller
{
    public function create(){
       return view('register');
    } 

    protected $userManager; 
    protected $customerManager;

    public function __construct(UserManager $userManager, CustomerManager $customerManager)
    {
        $this->userManager = $userManager;
        $this->customerManager = $customerManager;
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
        $user = $this->userManager->createUser();
        $this->customerManager->createCustomer($user);
        
        auth()->login($user);
        return redirect()->to('/dashboard')->with('success',"Welcome!!! You have successfully registered");
    } 
}
