<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\BOController;
use App\Http\Controllers\JOController;
use App\Http\Controllers\CanvController;
use App\Http\Controllers\BACController;


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

// Budget Officer (Purchase Request)
Route::get('/purchaserequeststatus',[BOController::class,'index']);
Route::get('/edit-purchaserequest',[BOController::class,'edit']);
// Budget Officer (Job Order)
Route::get('/joborderstatus',[JOController::class,'index']);
Route::get('/edit-Joborder',[JOController::class,'edit']);

// Canvasser (Purchase Request)
Route::get("/purchaserequest",[CanvController::class,'purchaserequest']);
Route::get('/edit-canvasserPR',[CanvController::class,'editpurchaserequest']);
Route::get("/newpurchaserequest/viewprform", [AppController::class,"viewPRForm"]);

// BAC Chairman (Price Quotation)
Route::get("/pricequotation",[BACController::class,'index']);

// app group routes
Route::controller(AppController::class)->group(function () {

    // dashboard page
    Route::get("/dashboard", "dashboard");

    // create form
        // pr
        Route::get("/newpurchaserequest", "purchaseRequest");
            // view pr form
                Route::get("/newpurchaserequest/viewprform", [AppController::class,"viewPRForm"]);
        // jo
        Route::get("/newjoborder", "jobOrder");
            // view jo form
                Route::get('/newjoborder/viewjoform', [AppController::class,'viewJOForm']);
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
