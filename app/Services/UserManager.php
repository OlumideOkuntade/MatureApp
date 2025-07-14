<?php

namespace App\Services;

use App\Models\User;

class UserManager
{
    public function createUser(){
        User::create([
            "email" => request()->email, 
            "password" => bcrypt(request()->password),
            "verified_at"=> now(),
            "role"=> "customer"
        ]);
        return User::latest()->first();
    }
}
