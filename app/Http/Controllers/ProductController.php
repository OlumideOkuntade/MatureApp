<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Http\Requests\StoreProductRequest;
use App\Services\ProductManager;
use Illuminate\Http\RedirectResponse;


class ProductController extends Controller
{
  public function index(){
    $this->authorize('manage_products');
    $products = Product::all();
   
    return view('admin.all_products')->with("products", $products ?? null );
  } 

  public function create(){
    $this->authorize('manage_products');
    $categories = Category::all();
    return view('admin.new_product')->with("categories", $categories );
  } 

  public function store(StoreProductRequest $request, ProductManager $productManager):RedirectResponse{
    $validated = $request->validated();
    $product = $productManager->createProduct($validated);
    if($request->hasFile('image') && $request->file('image')->isValid()){
      $product->addMedia($request->file('image'))->toMediaCollection();
    }
    return redirect('/all_products')->with('success', 'Product created successfully.');
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
    // $string = implode(',',$attributes);
    $product->update($attributes);

    return redirect('/all_products')->with("success","product updated successfully");
  } 

  public function destroy(Product $product){
    $this->authorize('delete', $product);
    $product->delete();
    return redirect('/all_products')->with("delete","product deleted successfully");
  } 


}




