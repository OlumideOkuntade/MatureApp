<?php

namespace App\Services;

use App\Models\Product;

class ProductManager
{
    public function createProduct($validated){
       $product = Product::create($validated);
        return $product;
    }
}
