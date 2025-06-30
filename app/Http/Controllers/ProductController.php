<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
class ProductController extends Controller
{
  public function index(){
    if(!Gate::any(['admin','storeManager'])){
      abort(403);
    }
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
      "status"=>"required",
    ]);
    Product::create([
      "name"=> request()->name,
      "quantity"=> request()->quantity,
      "price" => request()->price,
      "status"=> request()->status,
      "category_id" => request()->category,
      "image"=> ""
    ]);
    return redirect('/all_products')->with("add","product added successfully");
  } 

  public function edit(Product $product){
    $product = $product->load("category");
    return view('admin.edit_product')->with("product", $product );
  } 

  public function update(Product $product){
    $attributes = request()->validate([
      "name"=> "required|max:100",
      "quantity"=>"required|max:200",
      "price"=>"required",
      "category"=>"required",
      "status"=>"required"
    ]);
    $product->update($attributes);

    return redirect('/all_products')->with("success","product updated successfully");
  } 

  public function destroy(Product $product){
    $product->delete();
    return redirect('/all_products')->with("delete","product deleted successfully");
  } 


}




