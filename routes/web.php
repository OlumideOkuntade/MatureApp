<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;

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
    $product = Product::find(1);
    return view('index')->with('key', $gen1 .' '. $gen2)->with('view',$view)->with("product", $product);
});
Route::get('/login', function () {
    return view('login');
})->name("login");
Route::get('/register', function () {
    return view('register');
})->name("register");
Route::get('/about', function () {
    return view('about_us');
})->name("about");
Route::get('/contact', function () {
    return view('contact');
})->name("contact");
Route::get('/product/{product}', function (Product $product ) {
    return view('product')->with("product", $product);
})->name("product");
Route::get('/admin/login', function () {
    return view('admin.login');
})->name("admin.login");
Route::get('/admin/logout', function () {
    return view('admin.logout');
})->name("admin.logout");