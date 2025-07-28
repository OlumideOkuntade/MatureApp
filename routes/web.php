<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductPurchaseController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\RoleUserController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\RoleController; 
use App\Http\Controllers\FileController;
use App\Http\Controllers\TwoFactorAuthController;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\CartItem;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


Route::get('/', function () {
    $gender = 'Men';
    $products = Product::all();
    return view('index')->with('gender', $gender)->with('products',$products ?? null);
});
Route::get('/login', [LoginController::class,'create'])->name('login');
Route::post('/login/store', [LoginController::class,'store'])->name('login.store');
Route::post('/logout', [LoginController::class,'destroy'])->name('logout');

Route::get('/register', [RegisterController::class,'create'])->name('register');
Route::post('/register/store', [RegisterController::class,'store'])->name('register.store');
Route::get('/register/show', [RegisterController::class,'show'])->name('register.show');


Route::get('/dashboard', function () {
    $products = Product::all();
    $user = auth()->user();
    if($user->role === 'customer'){        
        $cart = $user->carts;
        if($cart ?? false){
            foreach($cart as $cat){
                $cat_id = $cat->id;
                $cartItem = CartItem::where('cart_id', $cat_id)->get();
                $count = CartItem::where('cart_id', $cat_id)->count();
                $total = CartItem::where('cart_id', $cat_id)->sum('amount');
            } 
        }
    }
    $roles = Role::all();
    return view('dashboard')->with("products", $products)->with("cartItem", $cartItem ?? null)->with('count', $count ?? null )->with('total',$total ?? null)->with('roles',$roles ?? null);
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

Route::group(['user'=> auth()],function(){
    Route::get('/2fa/setup', [TwoFactorAuthController::class,'show2faSetup'])->name('2fa.setup');
    Route::post('/2fa/enable', [TwoFactorAuthController::class, 'enable2fa'])->name('2fa.enable');
    Route::get('/2fa/verify/form', [TwoFactorAuthController::class, 'show2faVerify'])->name('2fa.verify.form');
    Route::post('/2fa/verify', [TwoFactorAuthController::class, 'verify2fa'])->name('2fa.verify');
});

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
Route::post('/admin/register/store', [AdminController::class,'store_register'])->name('admin.register.store');
Route::post('/admin/login', [AdminController::class,'login'])->name('admin.login');
Route::get('/admin/logout', [AdminController::class,'destroy'])->name('admin.logout');

Route::middleware('admin')->group(function(){
    Route::get('/category', [CategoryController::class,'create'])->name('category');
    Route::post('/category.store', [CategoryController::class,'store'])->name('category.store');
    Route::get('/edit_category/{category}', [CategoryController::class,'edit'])->name('edit_category');
    Route::post('/update_category/{category}', [CategoryController::class,'update'])->name('update_category');
    Route::delete('/delete_category/{category}', [CategoryController::class,'destroy'])->name('delete_category');
    Route::get('/all_products', [ProductController::class,'index'])->name('all_products');
    Route::get('/new_product', [ProductController::class,'create'])->name('new_product');
    Route::post('/new_product/store', [ProductController::class,'store'])->name('new_product.store');
    Route::get('/edit_product/{product}', [ProductController::class,'edit'])->name('edit_product');
    Route::post('/update_product/{product}', [ProductController::class,'update'])->name('update_product');
    Route::delete('/delete_product/{product}', [ProductController::class,'destroy'])->name('delete_product');
    Route::get('/all_orders', [AdminOrderController::class,'index'])->name('all_orders');
    Route::get('/orders_product/{order_id}', [AdminOrderController::class,'show'])->name('orders_product');
    Route::get('/all_customers', [CustomerController::class,'index'])->name('all_customers');
    Route::get('/resetPassword_user/{user}', [CustomerController::class,'resetPassword'])->name('resetPassword_user');
    Route::delete('/delete_user/{user}', [CustomerController::class,'destroy'])->name('delete_user');
    Route::get('/admin/dashboard',function () {return view('admin.dashboard');})->name("admin.dashboard");
    //role and permission route
    Route::get('/all_roles', [RoleController::class,'create'])->name('all_roles');
    Route::post('/all_roles/store', [RoleController::class,'store'])->name('all_roles.store');
    Route::get('/edit_role/{role}', [RoleController::class,'edit'])->name('edit_role');
    Route::post('/update_role/{role}', [RoleController::class,'update'])->name('update_role');

    Route::get('/users_roles', [RoleUserController::class,'create'])->name('users_roles');
    Route::post('/users_roles/store', [RoleUserController::class,'store'])->name('users_roles.store');
    Route::get('/users_roles/edit/{user}', [RoleUserController::class,'edit'])->name('users_roles.edit');
    Route::post('/users_roles/update/{user}', [RoleUserController::class,'update'])->name('users_roles.update');

    Route::get('/upload/file', [FileController::class,'create'])->name('upload');
    Route::post('/upload/store', [FileController::class,'store'])->name('upload.store');
    
    Route::get('/admin_log', [ActivityController::class,'showAdminLogs'])->name('admin.log');
});






