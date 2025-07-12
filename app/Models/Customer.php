<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends  Model
{
    use HasFactory;
    protected $fillable = [
      'first_name',
      'last_name',
      'phone_number',
      'user_id',
    ];

      public function user()
    {
      return $this->belongsTo(User::class);
    }
   
      public function orders()
    {
      return $this->hasMany(Order::class);
    }
      public function carts()
    {
      return $this->hasMany(Cart::class);
    }
}
