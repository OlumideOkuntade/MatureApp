<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\CartItem;

use Illuminate\Http\Request;

class OrderController extends Controller
{
      public function create()
    {
      return view('confirm_order');
    }  
    public function store(){  
      $order = new Order;
      $user = auth()->user();
      if($user->role === 'customer'){
        $customer = $user->customer;
        $carts = $customer->carts;
        $customer_id = $customer->id;
        $order->customer_id = $customer_id;
        $order->save();
        if($carts ?? false){
          foreach($carts as $cat){
            $cat_id = $cat->id;
            $cartItems = CartItem::where('cart_id', $cat_id)->get();
          }
        }
      }
      foreach ($cartItems as $item) {
        $order->products()->attach($item->product_id, [
          'size' => $item->size,
          'amount' => $item->amount,
          'quantity' => $item->quantity,
          ]);
      }

    }
  
  
  
  
  
  
  }