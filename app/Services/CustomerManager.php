<?php

namespace App\Services;

use App\Models\Customer;

class CustomerManager
{
    public function createCustomer($user){
        Customer::create([
            "first_name" => request()->firstname, 
            "last_name" => request()->lastname, 
            "phone_number" => request()->phone,
            "user_id"=> $user->id
        ]);
    }
}
