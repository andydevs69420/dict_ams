<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\GenerateFormController;
use App\Http\Controllers\BOController;

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
Route::get("/", function () {
    return view("welcome");
});

// auth group routes
Route::controller(AuthController::class)->group(function () {

    // login
    Route::get("/login", "login");
        // login -> check | attempt
        Route::post("/login", "check");

    // logout
    Route::get("/logout", "logout");

});

// Register
Route::get("/register", [RegisterController::class,"index"]);
Route::post("/register", [RegisterController::class,"store"]);

// purchase request
Route::get("/newpurchaserequest/viewprform", [GenerateFormController::class,"viewPRForm"]);
Route::post("/newpurchaserequest/searchforapproval", [GenerateFormController::class,"searchForApproval"]);

// Budget Officer
Route::get('/BO',[BOController::class,'index']);
Route::get('/edit-ors',[BOController::class,'edit']);

// app group routes
Route::controller(AppController::class)->group(function () {

    // dashboard
    Route::get("/dashboard", "dashboard");

    // create form
        // pr
        Route::get("/newpurchaserequest", "purchaseRequest");
        // jo
        Route::get("/newjoborder", "jobOrder");
    
    // users
    Route::get("/users", "users");
        // accept or decline
        Route::post("/user/updateverificationstatus", "user__updateVerificationStatus");
        // delete
        Route::post("/user/deleteuser", "user__deleteUser");

    // item list
    Route::get("/itemlist", "itemlist");
        // add item
        Route::post("/itemlist/additem", "itemlist__addItem");
        // update item
        Route::post("/itemlist/updateitem", "itemlist__updateItem");
        // delete item
        Route::post("/itemlist/deleteitem", "itemlist__deleteItem");

    // requisitioner
    Route::get("/requisitioner", "requisitioner");
    
});
