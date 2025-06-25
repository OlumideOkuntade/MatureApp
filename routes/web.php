<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductPurchaseController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\CartItem;
use App\Models\Cart;

Route::get('/', function () {
    $gen1 = 'Men';
    $gen2 = "Women";
    $view = "View all";
    return view('index')->with('key', $gen1 .' '. $gen2)->with('view',$view);
});
Route::get('/login', [LoginController::class,'create'])->name('login');
Route::post('/login/store', [LoginController::class,'store'])->name('login.store');
Route::post('/logout', [LoginController::class,'destroy'])->name('logout');

Route::get('/register', [RegisterController::class,'create'])->name('register');
Route::post('/register/store', [RegisterController::class,'store'])->name('register.store');

Route::get('/dashboard', function () {
    $products = Product::all();
    
    $user = auth()->user();
    if($user->role === 'customer'){
        $customer = $user->customer;
        $cart = $customer->carts;
        if($cart ?? false){
            foreach($cart as $cat){
                $cat_id = $cat->id;
                $cartItem = CartItem::where('cart_id', $cat_id)->get();
                $count = CartItem::where('cart_id', $cat_id)->count();
                $total = CartItem::where('cart_id', $cat_id)->sum('amount');
            } 
        }
    }
    return view('dashboard')->with("products", $products)->with("cartItem", $cartItem ?? null)->with('count', $count ?? null )->with('total',$total ?? null);
})->middleware("user")->name("dashboard");

Route::get('/product/{product}', [ProductPurchaseController::class,'create'])->middleware("user")->name("product.purchase");
Route::post('/product/store', [ProductPurchaseController::class,'store'])->middleware("user")->name("product.store");

Route::get('/confirm_purchase/{product}', function (Product $product) {
    $user = auth()->user();
    if($user->role === 'customer'){
        $customer = $user->customer;
        $cart = $customer->carts;
        if($cart ?? false){
            foreach($cart as $cat){
                $cat_id = $cat->id;
                $cartItem = CartItem::where('cart_id', $cat_id)->get();
                $count = CartItem::where('cart_id', $cat_id)->count();
                $total = CartItem::where('cart_id', $cat_id)->sum('amount');
            } 
        }
    }
    return view('confirm_purchase')->with('product',$product)->with("cartItem", $cartItem ?? null)->with('count',$count ?? null)->with('total',$total ?? null);
})->middleware("user")->name("confirm.purchase");

Route::get('/order_purchase', function(){
    
    $user = auth()->user(); //usually returns a User model
    if($user->role === 'customer'){
        $customer = $user->customer;
        $cart = $customer->carts;
        if($cart ?? false){
            foreach($cart as $cat){
                $cat_id = $cat->id;
                $cartItem = CartItem::where('cart_id', $cat_id)->get();
                $total = CartItem::where('cart_id', $cat_id)->sum('amount');
            } 
        }
    }
    return view('order_purchase')->with("cartItem", $cartItem ?? null )->with('total',$total ?? null);
})->middleware("user")->name("order.purchase");

Route::get('/confirm_order', [OrderController::class,'create'])->middleware("user")->name('confirm.order');
Route::post('/confirm_order/store', [OrderController::class,'store'])->middleware("user")->name('confirm.order.store');
Route::get('/my-orders', [OrderController::class,'index'])->middleware("user")->name('my_orders');
Route::get('/my-orders/{order_id}', [OrderController::class,'show'])->middleware("user")->name('my_order');

Route::get('/about', function () {
    return view('about_us');
})->name("about");
Route::get('/contact', function () {
    return view('contact');
})->name("contact");
Route::get('/product', function ( ) {
    return view('product');
})->name("product");

//admin route

Route::get('/admin/login', [AdminController::class,'create'])->name('admin.login');
Route::get('/admin/register', [AdminController::class,'create_register'])->name('admin.register');
Route::post('/admin/register/store', [AdminController::class,'store_register'])->name('admin.register.store');
Route::post('/admin/store', [AdminController::class,'store'])->name('admin.store');
Route::get('/admin/logout', [AdminController::class,'destroy'])->middleware("admin")->name('admin.logout');

Route::get('/all_products', [ProductController::class,'index'])->middleware("admin")->name('all_products');
Route::get('/new_product', [ProductController::class,'create'])->middleware("admin")->name('new_product');
Route::post('/new_product/store', [ProductController::class,'store'])->middleware("admin")->name('new_product.store');
Route::get('/edit_product/{product}', [ProductController::class,'edit'])->middleware("admin")->name('edit_product');
Route::post('/update_product/{product}', [ProductController::class,'update'])->middleware("admin")->name('update_product');
Route::delete('/delete_product/{product}', [ProductController::class,'destroy'])->middleware("admin")->name('delete_product');

Route::get('/all_users', [UserController::class,'index'])->middleware("admin")->name('all_users');
Route::delete('/delete_user/{user}', [UserController::class,'destroy'])->middleware("admin")->name('delete_user');

Route::get('/admin/dashboard', function (){
    return view('admin.dashboard');
})->middleware("admin")->name("admin.dashboard");




