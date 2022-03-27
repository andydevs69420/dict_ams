<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NewPurchaseRequestController;

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

// welcome
Route::get('/', function () {
    return view('welcome');
});

// login
Route::get('/login', [LoginController::class,'index']);
Route::post('/login', [LoginController::class,'check']);

// Register
Route::get('/register', [RegisterController::class,'index']);
Route::post('/register', [RegisterController::class,'store']);

// dashboard
Route::match(['get', 'post'],'/dashboard', [DashboardController::class,'index']);

// purchase request
Route::match(['get','post'],'/newpurchaserequest', [NewPurchaseRequestController::class,'index']);