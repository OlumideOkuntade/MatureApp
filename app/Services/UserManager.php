<?php

namespace App\Services;

use App\Models\User;

class UserManager
{
    public function createUser(){
        $user = User::create([
            "email" => request()->email, 
            "password" => bcrypt(request()->password),
            "verified_at"=> '',
            "role"=> "customer"
        ]);
        return $user;
    }
}
