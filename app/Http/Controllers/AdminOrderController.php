<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Order;

class AdminOrderController extends Controller
{
  public function index(){
    $this->authorize('manage_customers');
    $customers = Customer::with('orders')->get();
    $orderContent = collect();
    foreach($customers as $customer){
      foreach($customer->orders as $order){
        $orderContent->push((object)[
        "customer_id"=>$order->customer->id,
        "customer_name"=>$order->customer->first_name.' '.$order->customer->last_name ,
        "order_no" => $order->id,
        "order_date"=> $order->created_at->toDateString(),
        "amount"=>number_format($order->amount),
        "status"=> $order->status,
        "payment_status"=>$order->payment_status
        ]);
      }
    }
    return view('admin.all_orders')->with('orderContent',$orderContent ?? null);
  }

  public function show($order_id){
    $order = Order::with('products')->FindorFail($order_id);
    $orderedProduct = collect();
    foreach($order->products as $product){
      $orderedProduct->push((object)[
      "name" => $product->name,
      "qty" => $product->pivot->quantity,
      "amt" => $product->pivot->amount,
      "size" => $product->pivot->size
      ]);
    }
    return view('admin.orders_product')->with("orderedProduct", $orderedProduct ?? null);;
  }

}
