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

//Customers routes
Route::get('customer-management', [CustomerController::class, 'listCustomers'])->name("customer-management");
Route::get('user-status/{id}/{status}', [CustomerController::class, 'changeUserStatus']);
Route::get('/delete-user/{id}', [CustomerController::class, 'deleteUser']);
Route::get('customer-management', [CustomerController::class, 'index', 'index2']);
// Route::get('customer-management', [CustomerController::class, 'index2']);


//roles routes
Route::get('manager-management', [RoleController::class, 'listRole'])->name('manager-management');


//Managers routes
Route::get('manager-management', [ManagerController::class, 'listManagers']);
Route::get('manager-status/{id}/{status}', [ManagerController::class, 'changeManagerStatus']);
Route::get('/delete-manager/{id}', [ManagerController::class, 'deleteManager']);
Route::post('/add-manager', [ManagerController::class, 'addManager'])->name('add-manager');


//Travels routes
Route::get('travel-management', [TravelController::class, 'all'])->name("travel-management");


//Bus routes
Route::get('bus-management', [BusController::class, 'index'])->name('bus-management');


//Destinations routes
Route::get('destination-management', [DestinationController::class, 'index'])->name('destination-management');


Route::get('history', [HistoriesController::class, 'index']);



//Change Password route



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
