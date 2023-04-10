<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Buyer\BuyerController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\Test\TestController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Transaction\TransactionController;
use Illuminate\Auth\Events\Verified;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::resource('buyers', BuyerController::class,['only'=>['index','show']]);

Route::resource('categories', CategoryController::class,['except'=>['create','edit']]);

Route::resource('prodcuts', ProductController::class,['only'=>['index','show']]);

Route::resource('sellers', SellerController::class,['only'=>['index','show']]);

Route::resource('transactions', TransactionController::class,['only'=>['index','show']]);

Route::resource('users', UserController::class,['except'=>['create','edit']]);

Route::resource('test', TestController::class,['except'=>['create','edit']]);

//Route::get('users/verify/{$token}', UserController::class, 'verified')->name('verify');
