<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
    
    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
     public function carts()
    {
        return $this->belongsToMany(Cart::class);
    }
       public function cartitem():BelongsTo
    {
        return $this->belongsTo(cartItem::class);
    }
      public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class)
                    ->withPivot('quantity', 'size','amount','created_at');
    }
}
