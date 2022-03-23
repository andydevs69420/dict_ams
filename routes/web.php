<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;

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


// OOOH NO!!

// welcome
Route::get('/', function () {
    return view('welcome');
});

// login
Route::get('/login', [LoginController::class,'index']);

// dashboard
Route::match(['get', 'post'],'/dashboard', [DashboardController::class,'index']);
