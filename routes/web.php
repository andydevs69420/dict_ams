<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AppController;
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

// Budget Officer
Route::get('/BO',[BOController::class,'index']);
Route::get('/edit-ors',[BOController::class,'edit']);

// app group routes
Route::controller(AppController::class)->group(function () {

    // dashboard
    Route::get("/dashboard", "dashboard");

    // create form
        // pr
        Route::get("/purchaserequest/newpurchaserequest", "purchaseRequest");
            // view pr list
                Route::get("/purchaserequest/viewprlist", "viewPRFormList");
            // view uploaded form
                Route::get("/purchaserequest/viewprforminfo", "viewPRFormInfo");
                // upload comment
                Route::post("/purchaserequest/addcomment", "addPrFormInfoComment");
            // upload pr form
                Route::post("/purchaserequest/uploadprform", "uploadPRForm");
            // view pr form
                Route::get("/purchaserequest/viewprform", "viewPRForm");
        // jo
        Route::get("/newjoborder", "jobOrder");
            // view jo form
                Route::get('/newjoborder/viewjoform', [AppController::class,'viewJOForm']);
    // users
    Route::get("/users", "users");
        // view profile
            Route::get("/user/userprofile", "user__user_profile");
        // upload profile picture
            Route::post("/user/uploadprofilepicture", "user__user_profile_update");
        // delete profile picture
            Route::get("/user/deleteprofilepicture", "user__delete_user_profile_image");
        // edit profile
            Route::post("/user/editprofile", "user__edit_profile");
        // accept or decline
            Route::post("/user/updateverificationstatus", "user__updateVerificationStatus");
        // delete
            Route::post("/user/deleteuser", "user__deleteUser");
        // closure | hash user_id
            Route::post("/user/hashid", function() {
                return response()->json([
                    "hashid" => Crypt::encrypt(request()->user_id)
                ]);
            });

    // requisitioner
    Route::get("/requisitioner", "requisitioner");

    // supply officer approved forms
    Route::get("/so_approvedforms", "so_approvedforms");
        //Generate Price Quotation Sheet
        Route::get("/so_approvedforms/generatepqs", "so_approvedforms_generatepqs");
        //View Form
        //...

    // supply officer approved forms
    Route::get("/bac_chair_pqsforms", "bac_chair_pqsforms");
        //Generate Price Quotation Sheet
        //Route::get("/so_approvedforms/generatepqs", "so_approvedforms_generatepqs");
        //View Form
        //...


});
