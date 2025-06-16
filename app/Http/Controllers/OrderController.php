<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\CartItem;
use App\Models\Customer;

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
      return redirect()->route("my_orders");

    }

    public function index(){
      $user = auth()->user();
      if($user->role === 'customer'){
        $customer = $user->customer;
        $customer_id = $customer->id;
      }
      $customer = Customer::with('orders.products')->findOrFail($customer_id);
      $orderProducts = collect();
      foreach ($customer->orders as $order) {
        foreach ($order->products as $product) {
          $orderProducts->push((object)[
            'order_id' => $order->id,
            'order_date' => $order->created_at,
            'product_id' => $product->id,
            'product_name' => $product->name,
            'product_size' => $product->size,
            'quantity' => $product->pivot->quantity,
            'price' => $product->pivot->price,
            'amount' => $product->pivot->amount
          ]);
        }
      }
      return view('orders.index')->with('orderProducts',$orderProducts);
    }














}