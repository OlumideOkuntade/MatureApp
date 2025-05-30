<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
class ProductController extends Controller
{
    public function create(){
        $categories = Category::all();
      return view('new_product')->with("categories", $categories);
    } 

    public function store()
    {
        request()->validate([
            "name"=> "required|max:100",
            "qty"=>"required|max:200",
            "price"=>"required",
            "category"=>"required",
            "status"=>"required",
            "status"=>"required",
        ]);
        $prod = new Product;
        $prod->name = request()->name;
        $prod->quantity = request()->qty;
        $prod->price = request()->price;
        $prod->status = request()->status;
        $prod->image = "";
        $prod->category_id = request()->category;
        $prod->save();
        return redirect('/dashboard')->with("success","post created successfully");
    } 
}
