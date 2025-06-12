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
        $order->customer_id = request()->customerId;
        $order->product_id = request()->productId;
        $order->size = "small";
        $order->amount = request()->total;
        $order->save();
    }
}
