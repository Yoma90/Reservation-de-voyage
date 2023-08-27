<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Api\User;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VoyageController;
use App\Http\Controllers\ManagerController;



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


Route::get('/', [DashboardController::class, 'dash']);


Route::post('register', [CustomerController::class, 'register']);

// Route::group(['namespace' => 'Api'], function(){

    Route::post("/register", [AuthController::class, "register"]);
    Route::post("/logout", [AuthController::class, "logout"]);
    Route::post("/login", [AuthController::class, "login"]);

    Route::resource("voyages", VoyageController::class);
    
    // Route::group(['middleware' => ['auth:sanctum']], function () {
    //     Route::any('/register', [AuthController::class, 'register']);
    // });

// });

// Route::post("register", [AuthController::class, "register"]);

Route::get('/manager', [ManagerController::class, 'index']);

Route::get('dashboard', [CustomerController::class, 'listUser'])->name('dashboard');
Route::get('user-management', [CustomerController::class, 'listUsers'])->name("user-management");
Route::get('user-status/{id}/{status}', [CustomerController::class, 'changeUserStatus']);
Route::get('/delete-user/{id}', [CustomerController::class, 'deleteUser']);



//manager routes
Route::get('manager-management', [ManagerController::class, 'listManagers'])->name("manager-management");
Route::get('dashboard', [ManagerController::class, 'listManager'])->name('dashboard');
Route::get('manager-status/{id}/{status}', [ManagerController::class, 'changeManagerStatus']);
Route::get('/delete-manager/{id}', [ManagerController::class, 'deleteManager']);