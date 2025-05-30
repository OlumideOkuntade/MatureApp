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
            "category_id"=>"required"
        ]);
        $prod = new Product;
        $prod->name = request()->name;
        $prod->qty = request()->qty;
        $prod->price = request()->price;
        $prod->category_id = request()->category_id;
        $prod->save();
        return redirect()->back()->with("success","post created successfully");
    } 
}
