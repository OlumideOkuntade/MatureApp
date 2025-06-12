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
        $user = auth()->user();
        if($user->role === 'customer'){
        $customer = $user->customer;
        $customer_id = $customer->id;
    }
    $cartItem = CartItem::where("customer_id", $customer_id)->get();
    $count = CartItem::where("customer_id", $customer_id)->count();
    $total = CartItem::where("customer_id", $customer_id)->sum('amount');
        return view('purchase')->with('product', $product)->with("cartItem", $cartItem)->with("count",$count)->with("total", $total );
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
        //$size = request()->size;
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
