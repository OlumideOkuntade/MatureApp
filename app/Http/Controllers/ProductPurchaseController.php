<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;

class ProductPurchaseController extends Controller
{
    public function create(Product $product){

        return view('purchase')->with('product', $product);

    }  
    public function store(){
        $cat = new Cart;
        $cat->customer_id = auth()->user()->id;
        $cat->save();

        $cat = Cart::latest()->first();
        $cart = new CartItem;
        $cart->customer_id = request()->user()->id;
        $cart->product_id = request()->productId;
        $cart->quantity = request()->qty;
        $cart->cart_id = $cat->id;
        $cart->amount= request()->qty * request()->price;
        $cart->save();
        return redirect()->route('confirm.purchase', ['product' => request()->productId]);
       

    }
}
