<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\CartItem;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
  public function create()
  {
    return view('confirm_order');
  }  

  public function store(){  
    $user = auth()->user();
    if($user->role === 'customer'){
      $customer = $user->customer;
      $customer_id = $customer->id;
      $carts = $customer->carts;
      if($carts ?? false){
        foreach($carts as $cat){
          $cat_id = $cat->id;
          $cartItems = CartItem::where('cart_id', $cat_id)->get();
          $total = CartItem::where('cart_id', $cat_id)->sum('amount');
        } 
      }
      $order = new Order;
      $order->customer_id = $customer_id;
      $order->status = "pending";
      $order->payment_status = "pending";
      $order->amount = $total;
      $order->save();
    }
    foreach ($cartItems as $item) {
      $order->products()->attach($item->product_id, [
        'size' => $item->size,
        'amount' => $item->amount,
        'quantity' => $item->quantity
      ]);
    }
    CartItem::where('cart_id', $cat_id)->delete();
    return redirect()->route("my_orders");
  }

  public function index(){
    $user = auth()->user();
    if($user->role === 'customer'){
      $customer = $user->customer;
      $customer_id = $customer->id;
    }
    $orderContent = collect();
    $customer = Customer::with('orders')->findOrFail($customer_id);
    foreach($customer->orders as $order){
      $orderContent->push((object)[
      "order_no" => $order->id,
      "order_date"=> $order->created_at->toDateString(),
      "amount"=>number_format($order->amount),
      "status"=> $order->status,
      "payment_status"=>$order->payment_status
      ]);
    }
    
    return view('orders.index')->with("orderContent", $orderContent);
  }

  public function show($order_id){
    $order = Order::with('products')->findOrFail($order_id);
    $orderedProduct = collect();
    foreach($order->products as $product){
      $orderedProduct->push((object)[
        "name" => $product->name,
        "image"=> $product->getFirstMediaUrl('default'),
        "qty" => $product->pivot->quantity,
        "amt" => $product->pivot->amount,
        "size" => $product->pivot->size
      ]);
    }
    return view("orders.show")->with("orderedProduct", $orderedProduct ?? null); 
  }















}