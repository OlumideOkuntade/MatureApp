<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
      protected $fillable = [
        'firstname',
        'lastname',
        'phone',
        'radio',
        'email',
        'password',
    ];
      public function order()
    {
        return $this->hasMany(Order::class);
    }
      public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
