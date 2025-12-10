<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Customer extends  Model
{
    
    use HasFactory;
    protected $fillable = [
      'first_name',
      'last_name',
      'phone_number',
      'user_id',
    ];

      public function user(): BelongsTo
    {
      return $this->belongsTo(User::class);
    }
   
      public function orders(): HasMany
    {
      return $this->hasMany(Order::class);
    }
      public function carts(): HasMany
    {
      return $this->hasMany(Cart::class);
    }
}
