<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Authenticatable
{
    use HasFactory;
    use Notifiable;
   
      public function order()
    {
        return $this->hasMany(Order::class);
    }
      public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
