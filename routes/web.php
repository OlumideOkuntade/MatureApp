<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductPurchaseController;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\CartItem;
use App\Models\Cart;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
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

Route::get('/new_product', [ProductController::class,'create'])->name('new_product');
Route::post('/new_product/store', [ProductController::class,'store'])->name('new_product');

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
})->name("dashboard");

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
})->name("confirm.purchase");

Route::get('/order_purchase', function(){
    $user = auth()->user();
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
})->name("order.purchase");

Route::get('/product/{product}', [ProductPurchaseController::class,'create'])->name("product.purchase");
Route::post('/product/store', [ProductPurchaseController::class,'store'])->name("product.store");

Route::get('/confirm_order', [OrderController::class,'create'])->name('confirm.order');
Route::post('/confirm_order/store', [OrderController::class,'store'])->name('confirm.order.store');
Route::get('/my-orders', [OrderController::class,'index'])->name('my_orders');

Route::get('/admin/login', [AdminController::class,'create'])->name('admin.login');
Route::post('/admin/login', [AdminController::class,'store'])->name('admin.login');

Route::get('/about', function () {
    return view('about_us');
})->name("about");
Route::get('/contact', function () {
    return view('contact');
})->name("contact");
Route::get('/product', function ( ) {
    return view('product');
})->name("product");
Route::get('/admin/logout', function () {
    return view('admin.logout');
})->name("admin.logout");