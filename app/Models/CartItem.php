<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;
      public function Product()
    {
        return $this->BelongToMany(Product::class);
    }
       public function Cart()
    {
        return $this->BelongTo(Cart::class);
    }
}
