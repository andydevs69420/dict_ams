<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\CTRLR_1_DashboardController;
use App\Http\Controllers\CTRLR_2_ReqisitionerController;
use App\Http\Controllers\CTRLR_3_BudgetOfficerController;
use App\Http\Controllers\CTRLR_7_UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\BOController;
use App\Http\Controllers\BACController;
use App\Http\Controllers\CanvController;


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


// dashboard
Route::get("/dashboard", [CTRLR_1_DashboardController::class, "dashboard"]);

// requisitioner
Route::controller(CTRLR_2_ReqisitionerController::class)->group(function () {

    // ==================== PURCHASE REQUEST =============
    Route::get("/requisitioner/purchaserequest/newpurchaserequest", "purchaseRequest");
        // view pr list
            Route::get("/requisitioner/purchaserequest/viewprlist", "viewPRFormList");
        // view uploaded form
            Route::get("/requisitioner/purchaserequest/viewprforminfo/{prform}/view", "viewPRFormInfo");
        // cancel uploaded form
            Route::post("/requisitioner/purchaserequest/viewprforminfo/{prform}/cancel", "cancelPRForm");
            // load comments
            Route::get("/requisitioner/purchaserequest/loadcomment/{hashid}/load", "loadPrFormInfoComment");
            // upload comment
            Route::post("/requisitioner/purchaserequest/addcomment", "addPrFormInfoComment");
        // upload pr form
            Route::post("/requisitioner/purchaserequest/uploadprform", "uploadPRForm");
        // view pr form
            Route::get("/requisitioner/purchaserequest/viewprform", "viewPRForm");
        
    // ==================== JOB ORDER ====================
    Route::get("/requisitioner/joborder/newjoborder", "jobOrder");
        // view jo list
            Route::get("/requisitioner/joborder/viewjolist", "viewJOFormList");
        // view jo form
            Route::get("/requisitioner/joborder/viewjoform", "viewJOForm");
        // cancel uploaded form
            Route::post("/requisitioner/joborder/viewjoforminfo/{joform}/cancel", "cancelJOForm");
            // load comments
            Route::get("/requisitioner/joborder/loadcomment/{hashid}/load", "loadJoFormInfoComment");
            // upload comment
            Route::post("/requisitioner/joborder/addcomment", "addJoFormInfoComment");
        // upload jo form
            Route::post("/requisitioner/joborder/uploadjoform", "uploadJOForm");
        // view uploaded form
            Route::get("/requisitioner/joborder/viewjoforminfo/{joform}/view", "viewJOFormInfo");

});

Route::controller(CTRLR_3_BudgetOfficerController::class)->group(function() {

    // Budget Officer (Purchase Request)
    Route::get("/budgetofficer/purchaserequeststatus", "PrIndex");
    // Review pr form
    Route::get("/budgetofficer/reviewpurchaserequest/{prform}/review", "PrReview");
    // Take actions
    Route::post("/budgetofficer/reviewpurchaserequest/takeaction", "takePrActions");
        // load comments
        Route::get("/budgetofficer/reviewpurchaserequest/loadcomment/{hashid}/load", "loadPrFormReviewComment");
        // add comments
        Route::post("/budgetofficer/reviewpurchaserequest/addcomment", "addPrFormReviewComment");

    // Budget Officer (Job Order)
    Route::get("/budgetofficer/joborderstatus", "JoIndex");
    Route::get("/budgetofficer/reviewjoborder/{joform}/review", "Joedit");
    // Take actions
    Route::post("/budgetofficer/reviewjoborder/takeaction", "takeJoActions");
        // load comments
        Route::get("/budgetofficer/reviewjoborder/loadcomment/{hashid}/load", "loadJoFormReviewComment");
        // add comments
        Route::post("/budgetofficer/reviewjoborder/addcomment", "addJoFormReviewComment");

});

// BAC chairman
Route::get("/BACpricequotation",[BACController::class,"BACIndex"]);

// Canvasser
Route::get("/CanVpricequotation",[BACController::class,"CanvIndex"]);


// users
Route::controller(CTRLR_7_UserController::class)->group(function() {

    // users
    Route::get("/users", "users");
        // view profile
            Route::get("/user/userprofile/{user}/view", "user_profile");
        // upload profile picture
            Route::post("/user/uploadprofilepicture", "user_profile_update");
        // delete profile picture
            Route::get("/user/deleteprofilepicture", "delete_user_profile_image");
        // edit profile
            Route::post("/user/editprofile", "edit_profile");
        // accept or decline
            Route::post("/user/updateverificationstatus", "updateVerificationStatus");
        // delete
            Route::post("/user/deleteuser", "deleteUser");
        // closure | hash user_id
            Route::post("/user/hashid", function() {
                return response()->json([
                    "hashid" => Crypt::encrypt(request()->user_id)
                ]);
            });

});

// app group routes
Route::controller(AppController::class)->group(function () {


    // requisitioner
    Route::get("/requisitioner", "requisitioner");

    // supply officer approved forms
    Route::get("/so_approvedforms", "so_approvedforms");
        //Generate Price Quotation Sheet
            Route::get("/so_approvedforms/generatepqs", "so_approvedforms_generatepqs");
        //View Form
            Route::get("/so_approvedforms/viewform", "so_approvedforms_viewform");
        //Uploadd PQS
            Route::post("/so_approvedforms/uploadpqs", "so_approvedforms_uploadpqs");

    // supply officer approved forms
    Route::get("/bac_chair_pqsforms", "bac_chair_pqsforms");
        //Generate Price Quotation Sheet
        //Route::get("/so_approvedforms/generatepqs", "so_approvedforms_generatepqs");
        //View Form
        //...


});
