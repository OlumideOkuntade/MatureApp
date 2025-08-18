<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\CartItem;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\PdfAttachementEmail;
use Illuminate\Support\Facades\Mail;


class OrderController extends Controller
{
  public function create()
  {
    return view('confirm_order');
  }  

  public function store(Request $request){  
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
        'quantity' => $item->quantity,
        'created_at'=> now(),
        'updated_at'=> now()
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
    return view('orders.index',[
      "orderContent"=> $orderContent
    ]);
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
        "size" => $product->pivot->size,
      ]);
    }
    return view("orders.show")->with("orderedProduct", $orderedProduct ?? null); 
  }

  public function order_details(){
    $user = auth()->user();
    if($user->role === 'customer'){
      $customer = $user->customer;
      $customer_id = $customer->id;
    }
    $customer = Customer::with('orders')->findOrFail($customer_id);
    $orderDetails = collect();
    foreach($customer->orders as $order){
      foreach($order->products as $product){
        $orderDetails->push((object)[
          "name" => $product->name,
          "price"=> $product->price,
          "image"=> $product->getFirstMediaUrl('default'),
          "qty" => $product->pivot->quantity,
          "amt" => $product->pivot->amount,
          "size" => $product->pivot->size,
          "date"=> $product->pivot->created_at
        ]);
      }
    }
    return view('orders.order_details',[
      'orderDetails' => $orderDetails ?? null,
      'customer'=> $customer
    ]);
    
  }

  public function generatePdf(){
    $user = auth()->user();
    if($user->role === 'customer'){
      $customer = $user->customer;
      $customer_id = $customer->id;
    }
    $customer = Customer::with('orders')->findOrFail($customer_id);
    $orderDetails = collect();
    foreach($customer->orders as $order){
      foreach($order->products as $product){
        $orderDetails->push((object)[
          "name" => $product->name,
          "price"=> $product->price,
          "image"=> $product->getFirstMediaUrl('default'),
          "qty" => $product->pivot->quantity,
          "amt" => $product->pivot->amount,
          "size" => $product->pivot->size,
          "date"=> $product->pivot->created_at
        ]);
      }
    }
   
    $pdf = Pdf::loadView('orders.order_details',[
      'orderDetails'=> $orderDetails ?? null,
      'customer'=> $customer
    ]);
    $path = public_path('pdf');
    $randomString = Str::random(8); 
    $fileName = 'orders' . '-' . $randomString . '.pdf';
    $destinationPath =  $path . '/' . $fileName;
    if(!file_exists($path)){
      mkdir($path, 777,true); // create directory if not exists
    }
    if($pdf->save($destinationPath)){
      Mail::to($user->email)->send(new PdfAttachementEmail($user,$destinationPath));
      return response()->json(['message' => 'PDF saved', 'path' => $destinationPath]);
    }else {
      return response()->json(['error' => 'PDF not saved']);
    }
  }









}