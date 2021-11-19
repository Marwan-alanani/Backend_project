<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\SendCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/SendCategory',[SendCategory::class,'send']);
// Route::post('/Add/Cart',[CartController::class,'AddToCart']);

