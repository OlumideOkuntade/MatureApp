<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
      public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
    
      public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
