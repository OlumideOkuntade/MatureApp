<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;
      public function products()
    {
        return $this->belongsToMany(Product::class);
    }
       public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
    
}
