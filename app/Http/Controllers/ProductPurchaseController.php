<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;

class ProductPurchaseController extends Controller
{
    public function create(Product $product){
        $user = auth()->user();
        if($user->role === 'customer'){
            $customer = $user->customer;
            $cart = $customer->carts;
            if($cart ?? false){
                foreach($cart as $cat){
                    $cat_id = $cat->id;
                    $cartItem = CartItem::where('cart_id', $cat_id)->get();
                    $count = CartItem::where('cart_id', $cat_id)->count();
                    $total = CartItem::where('cart_id', $cat_id)->sum('amount');
                } 
            }
        }
        return view('purchase')->with('product', $product)->with("cartItem", $cartItem ?? null )->with("count",$count ?? null )->with("total", $total ?? null );
    }  
    public function store(){
        request()->validate([
            "size"=> "required",
            "qty"=> "required",
            "productId"=> "required",
            "price"=> "required"
        ]);
        $user = auth()->user();
        if($user->role === 'customer'){
            $customer = $user->customer;
            $customer_id = $customer->id;
            $cart = $customer->carts; //cart_id cannot be gotten tru a collection
            if($cart ?? false){
                foreach($cart as $cat){
                    $cat_id = $cat->id;
                }
            }
        } 
        //check if the user already has a cart_id
        $cartUserId = Cart::where('customer_id', $customer_id)->first();
        if(!$cartUserId){
            $cat = new Cart;
            $cat->customer_id = $customer_id;
            $cat->save();
        }
        $productId = request()->productId; 
        $quantity = request()->qty;
        $size = request()->size;
        $amount = request()->qty * request()->price;
        $cat = Cart::where('customer_id', $customer_id);
        $getProductExitInCartItem = CartItem::where('cart_id',$cat_id ?? null )
                                ->where('product_id',$productId ?? null )
                                ->first();
        if($getProductExitInCartItem){
            $getProductExitInCartItem->increment('quantity', $quantity);
            $getProductExitInCartItem->increment('amount', $amount);
             $getProductExitInCartItem->save();
        }else{
            $cat = Cart::latest()->first();
            $cart = new CartItem;
            $cart->product_id = $productId;
            $cart->quantity = $quantity;
            $cart->cart_id = $cat->id;
            $cart->amount = $amount;
            $cart->size = $size;
            $cart->save();
        }
        return redirect()->route('confirm.purchase', ['product' => $productId]);
    }
  
}
