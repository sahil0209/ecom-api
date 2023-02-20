<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CropController;
use App\Http\Controllers\MachineryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProductController;
use App\Http\Controllers\UserIssuesController;
use App\Models\UserProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// ADMIN ROUTES
Route::post('/admins/login',[AdminController::class,'login']);
Route::post('/admins/register', [AdminController::class, 'register']);



Route::resource('/users',UserController::class);
Route::post("/users/login",[UserController::class,'login']);

// Category routes 
Route::resource('/categories',CategoryController::class);
// product routes 
Route::resource("/products",ProductController::class);
Route::middleware('auth:sanctum')->group(function(){
    
    
    Route::get("/productswithcart/{userid}",[ProductController::class,'allProducts']);
    Route::delete("/removefromcart/{userid}/{productid}",[UserProductController::class,'removeFromCart']);
    
    Route::get("/cart/{id}",[UserProductController::class,'userProducts']);
    Route::post('/cart/add',[UserProductController::class,'store']);
    Route::put("/cart/update/{id}",[UserProductController::class,'update']);
    
    // Issues
    
    Route::get('/issue',[UserIssuesController::class,'index']);
    Route::put('/issue/{id}',[UserIssuesController::class,'update']);
    Route::post('/issue',[UserIssuesController::class,'store']);
    Route::get('/issue/{id}',[UserIssuesController::class,'userIssues']);
    
});
// Crop
Route::get('/crops',[CropController::class,'index']);

// Machinery
Route::get('/machineries',[MachineryController::class,'index']);

Route::middleware('auth:sanctum')->get("/users/something", [UserController::class, 'checkToken']);
