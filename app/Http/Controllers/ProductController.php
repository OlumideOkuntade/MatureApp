<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
class ProductController extends Controller
{
  public function index(){
    $products = Product::all();
    return view('admin.all_products')->with("products", $products );
  } 

  public function create(){
    $categories = Category::all();
    return view('admin.new_product')->with("categories", $categories );
  } 

  public function store(){
    request()->validate([
      "name"=> "required|max:100",
      "quantity"=>"required|max:200",
      "price"=>"required",
      "category"=>"required",
      "status"=>"required"
    ]);
    $prod = new Product;
    $prod->name = request()->name;
    $prod->quantity = request()->quantity;
    $prod->price = request()->price;
    $prod->status = request()->status;
    $prod->category_id = request()->category;
    $prod->image = "";
    $prod->save();
    return redirect('/admin/dashboard')->with("success","post created successfully");
  } 

  public function edit(Product $product){
    $product = $product->load("category");
    return view('admin.edit_product')->with("product", $product );
  } 

  public function update(Product $product){
    $values = request()->validate([
      "name"=> "required|max:100",
      "quantity"=>"required|max:200",
      "price"=>"required",
      "category"=>"required",
      "status"=>"required"
    ]);
    $product->update($values);

    return redirect('/all_products')->with("success","post created successfully");
  } 

   public function destroy(Product $product){
    $product->delete();
    return redirect('/all_products')->with("delete","post deleted");
  } 


}




