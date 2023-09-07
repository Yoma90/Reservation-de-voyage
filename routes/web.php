<?php

use App\Http\Controllers\BusController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\HistoriesController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\TravelController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect('dashboard');
});

Route::group(['middleware' => 'auth'], function () {


	Route::get('dashboard', [DashboardController::class, 'home'])->name('dashboard');

	Route::get('billing', function () {
		return view('billing');
	})->name('billing');

	Route::get('profile', function () {
		return view('profile');
	})->name('profile');


	Route::get('static-sign-in', function () {
		return view('static-sign-in');
	})->name('sign-in');

	Route::get('static-sign-up', function () {
		return view('static-sign-up');
	})->name('sign-up');

	Route::get('/logout', [SessionsController::class, 'destroy']);
	Route::get('/user-profile', [InfoUserController::class, 'create']);
	Route::post('/user-profile', [InfoUserController::class, 'store']);

	Route::post('/user-profile/update', [InfoUserController::class, 'updateProfile']);

});

//User route
Route::get('user-management', [UserController::class, 'listUser'])->name('user-management');
Route::post('/add-user', [UserController::class, 'addUser']);
Route::get('/delete-user/{id}', [UserController::class, 'deleteUser']);
Route::get('user-status/{id}/{status}', [UserController::class, 'changeUserStatus']);










//Customers routes
Route::get('customer-management', [CustomerController::class, 'listCustomers'])->name("customer-management");
Route::get('user-status/{id}/{status}', [CustomerController::class, 'changeUserStatus']);
Route::get('/delete-user/{id}', [CustomerController::class, 'deleteUser']);
Route::get('customer-management', [CustomerController::class, 'index']);


//roles routes
Route::get('manager-management', [RoleController::class, 'listRole'])->name('manager-management');


//Managers routes
Route::get('manager-management', [ManagerController::class, 'listManagers']);
Route::get('manager-status/{id}/{status}', [ManagerController::class, 'changeManagerStatus']);
Route::get('/delete-manager/{id}', [ManagerController::class, 'deleteManager']);
Route::post('/add-manager', [ManagerController::class, 'addManager'])->name('add-manager');


//Bus routes
Route::get('bus-management', [BusController::class, 'index'])->name('bus-management');
Route::post('/add-bus', [BusController::class, 'addBus'])->name('add-bus');
Route::get('bus-status/{id}/{status}', [BusController::class, 'changeBusStatus']);
Route::get('/delete-bus/{id}', [BusController::class, 'deleteBus']);
Route::post('/update-bus', [BusController::class, 'updateBus'])->name('update-bus');



//Travels routes
Route::get('travel-management', [TravelController::class, 'all'])->name("travel-management");


//Destinations routes
Route::get('destination-management', [DestinationController::class, 'index'])->name('destination-management');


//History routes
Route::get('history', [HistoriesController::class, 'index']);


//Récupération des utilisateurs

Route::group(['middleware' => 'guest'], function () {
	Route::get('/register', [RegisterController::class, 'create']);
	Route::post('/register', [RegisterController::class, 'store']);
	Route::get('/login', [SessionsController::class, 'create']);
	Route::post('/session', [SessionsController::class, 'store']);
	Route::get('/login/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	Route::post('/change-password', [SessionsController::class, 'changeUserPassword']);
	Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');
});

Route::get('/login', function () {
	return view('session/login-session');
})->name('login');
