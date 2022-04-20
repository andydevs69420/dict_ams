<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\GenerateFormController;
use App\Http\Controllers\AppController;

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


// purchase request
Route::get('/newpurchaserequest/viewprform', [GenerateFormController::class,'viewPRForm']);
Route::post('/newpurchaserequest/searchforapproval', [GenerateFormController::class,'searchForApproval']);


Route::controller(AppController::class)->group(function () {

    // dashboard
    Route::get('/dashboard', 'dashboard');

    // create form
        // pr
        Route::get('/newpurchaserequest', 'purchaseRequest');
        // jo
        Route::get('/newjoborder', 'jobOrder');
    
    // users
    Route::get('/users', 'users');
        // accept
        // decline
        // delete
    
});