<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\UserManager;
use App\Services\CustomerManager;
use Spatie\Activitylog\Models\Activity;

class RegisterController extends Controller
{
    protected $userManager; 
    protected $customerManager;

    public function show(){
       return Activity::all();
    } 

    public function create(){
       return view('register');
    } 

    public function __construct(UserManager $userManager, CustomerManager $customerManager)
    {
        $this->userManager = $userManager;
        $this->customerManager = $customerManager;
    }

    public function store(Request $request ){
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|min:11',
            'password' =>'required|min:3',
            'radio' => 'required'
        ]);
        $user = $this->userManager->createUser();
        $this->customerManager->createCustomer($user);
        \App\Jobs\SendCustomerVerificationEmail::dispatch($user);

        auth()->login($user);
        return redirect()->to('/dashboard')->with('success',"Welcome!!! You have successfully registered");
    } 
}
