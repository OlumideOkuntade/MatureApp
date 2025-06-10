<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\CartItem;

class ProductPurchaseController extends Controller
{
    public function create(Product $product){
        return view('purchase')->with('product', $product);
    }  
    public function store(){
        $user = auth()->user();
        if ($user->role === 'customer'){
        $customer = $user->customer;
        $customer_id = $customer->id;
        } 
        $cartUserId = Cart::where('customer_id', $customer_id)->first();
        if(!$cartUserId){
            $cat = new Cart;
            $cat->customer_id = $customer_id;
            $cat->save();
        }
        $productId = request()->productId; 
        $quantity = request()->qty;
        $amount = request()->qty * request()->price;
        $getProductExitInCartItem = CartItem::where('customer_id',$customer_id)
                                ->where('product_id',$productId)
                                ->first();
        if($getProductExitInCartItem){
            $getProductExitInCartItem->increment('quantity', $quantity);
            $getProductExitInCartItem->increment('amount', $amount);
             $getProductExitInCartItem->save();
        }else{
            $cat = Cart::latest()->first();
            $cart = new CartItem;
            $cart->customer_id = $customer_id;
            $cart->product_id = $productId;
            $cart->quantity = $quantity;
            $cart->cart_id = $cat->id;
            $cart->amount = $amount;
            $cart->save();
        }
        return redirect()->route('confirm.purchase', ['product' => $productId]);
    }
  
}
