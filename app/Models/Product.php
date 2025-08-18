<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
      'name',
      'quantity',
      'price',
      'category_id',
      'status',
      'image'
    ];
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
     public function carts()
    {
        return $this->belongsToMany(Cart::class);
    }
       public function cartitem()
    {
        return $this->belongsTo(cartItem::class);
    }
      public function orders()
    {
        return $this->belongsToMany(Order::class)
                    ->withPivot('quantity', 'size','amount','created_at');
    }
}
