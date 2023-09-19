<?php

use App\Http\Controllers\Api\AgencyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Api\User;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\VilleController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VoyageController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\MobileApiController;
// use App\Http\Controllers\VilleController;

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

Route::group(['namespace' => 'Api'], function () {

    Route::post("/register", [AuthController::class, "register"]);
    Route::post("/logout", [AuthController::class, "logout"]);
    Route::post("/login", [AuthController::class, "login"]);

    Route::get('/list-agencies/{id}', [AgencyController::class, 'listAgency'])->name('list-agencies');
    Route::get('/list-ville', [VilleController::class, 'listCity'])->name('list-ville');

    Route::resource("voyages", VoyageController::class);
    Route::post("voyages", [VoyageController::class, 'store']);
    Route::get("voyages", [VoyageController::class, 'index']);


    // Route::group(['middleware' => ['auth:sanctum']], function () {
    //     Route::any('/register', [AuthController::class, 'register']);
    // });

});

// Route::post("register", [AuthController::class, "register"]);

Route::get('/manager', [ManagerController::class, 'index']);

Route::get('dashboard', [CustomerController::class, 'listCustomer'])->name('dashboard');
Route::get('user-management', [CustomerController::class, 'listCustomers'])->name("user-management");
Route::get('user-status/{id}/{status}', [CustomerController::class, 'changeUserStatus']);
Route::get('/delete-user/{id}', [CustomerController::class, 'deleteUser']);





// Route::prefix('bus')->group(function () {
//     Route::get('/', [ApiController::class, 'index']); // Liste de tous les bus
//     Route::get('/{id}', [ApiController::class, 'show']); // Afficher un bus par ID
//     Route::put('/{id}', [ApiController::class, 'update']); // Mettre à jour un bus par ID
//     Route::delete('/{id}', [ApiController::class, 'destroy']); // Supprimer un bus par ID
// });


Route::group(['middleware' => 'auth:sanctum'], function () {
});
Route::prefix('mobile')->group(function () {
    Route::post('/add-bus', [MobileApiController::class, 'addBus']);
});
