<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Loggedin;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SendCategory;
use App\Http\Controllers\SocialsController;
use App\Http\Controllers\UserController;
use Illuminate\Routing\Route as IlluminateRoutingRoute;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Routing\Route as RoutingRoute;

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
    return view('welcome');
});
// Home routes
Route::get('/home', [HomeController::class,'index'])->name('home');
Route::get('/Dashboard',[DashboardController::class,'View'])->middleware('App\Http\Middleware\CheckifAdmin')->name('dashboard');
Route::post('/home/search',[HomeController::class,'Search'])->name('Search');
// Product Routes
Route::get('/Dashboard/Main_type', [TypeController::class,'select'])->middleware('App\Http\Middleware\CheckifAdmin')->name('type.view');
Route::get('/Dashboard/Products',[ProductController::class,'index'])->middleware('App\Http\Middleware\CheckifAdmin')->name('products.view');
Route::get('/Dashboard/Products/Type/{Main_type}',[ProductController::class,'indexType'])->middleware('App\Http\Middleware\CheckifAdmin')->name('type.show');
Route::get('/Dashboard/Products/create',[ProductController::class,'create'])->middleware('App\Http\Middleware\CheckifAdmin')->name('product.create');
Route::post('/Dashboard/Products/create',[ProductController::class,'store'])->middleware('App\Http\Middleware\CheckifAdmin')->name('product.store');
Route::get('/Dashboard/Delete/Product/{id}', [ProductController::class,'destroy'])->middleware('App\Http\Middleware\OnlyAdmins')->name('product.delete');
Route::get('Dashboard/Edit/Product/{id}',[ProductController::class,'edit'])->middleware('App\Http\Middleware\OnlyAdmins')->name('product.edit');
Route::post('/Dashboard/Edit/Product/{id}',[ProductController::class,'update'])->middleware('App\Http\Middleware\OnlyAdmins')->name('product.update');
Route::get('Dashboard/View/Product/{id}',[ProductController::class,'show'])->middleware('App\Http\Middleware\CheckifAdmin')->name('product.show');
Route::post('Product/Names',[HomeController::class,'GetProductnames'])->name('Getname');
// auth routes
Auth::routes();
Route::get('home/login/facebook',[SocialsController::class,'facebook'])->name('facebook.login');
Route::get('home/login/facebook/callback',[SocialsController::class,'redirecthome'])->name('facebook.callback');
// Categories routes
Route::get('Dashboard/Categories',[CategoryController::class,'index'])->middleware('App\Http\Middleware\CheckifAdmin')->name('categories.view');
Route::get('Dashboard/View/Category/{id}',[CategoryController::class,'show'])->middleware('App\Http\Middleware\CheckifAdmin')->name('category.show');
Route::get('Dashboard/Category/create',[CategoryController::class,'create'])->middleware('App\Http\Middleware\CheckifAdmin')->name('category.create');
Route::post('Dashboard/Category/create',[CategoryController::class,'store'])->middleware('App\Http\Middleware\CheckifAdmin')->name('category.store');
Route::get('Dashboard/Delete/Category/{id}',[CategoryController::class,'destroy'])->middleware('App\Http\Middleware\OnlyAdmins')->name('category.delete');
Route::get('Dashboard/Edit/Category/{id}',[CategoryController::class,'edit'])->middleware('App\Http\Middleware\OnlyAdmins')->name('category.edit');
Route::post('Dashboard/Edit/Category/{id}',[CategoryController::class,'update'])->middleware('App\Http\Middleware\OnlyAdmins')->name('category.update');
// User routes
Route::get('Dashboard/users',[UserController::class,'index'])->middleware('App\Http\Middleware\CheckifAdmin')->name('users.view');
Route::get('user/create',[UserController::class,'create'])->middleware('App\Http\Middleware\CheckifAdmin')->name('user.create');
Route::post('user/create',[UserController::class,'store'])->middleware('App\Http\Middleware\CheckifAdmin')->name('user.store');
Route::get('View/user/{id}',[UserController::class,'show'])->middleware('App\Http\Middleware\CheckifAdmin')->name('user.show');
Route::get('Delete/user/{id}',[UserController::class,'destroy'])->middleware('App\Http\Middleware\OnlyAdmins')->name('user.delete');
Route::get('Edit/user/{id}',[UserController::class,'edit'])->middleware('App\Http\Middleware\OnlyAdmins')->name('user.edit');
Route::post('Edit/user/{id}',[UserController::class,'update'])->middleware('App\Http\Middleware\OnlyAdmins')->name('user.update');
// Cart routes
Route::post('Add/Cart',[CartController::class,'AddToCart'])->middleware('App\Http\Middleware\OnlyIfLoggedin')->name('Addtocart');
Route::get('home/cart',[CartController::class,'ViewCart'])->middleware('App\Http\Middleware\OnlyIfLoggedin')->name('ViewCart');
Route::get('home/cart/delete/{id}',[CartController::class,'delete'])->middleware('App\Http\Middleware\OnlyIfLoggedin')->name('DeleteCart');
