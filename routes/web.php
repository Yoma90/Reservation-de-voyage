<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\MobileUsersController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\UserController;
use App\Models\Mobile_users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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


Route::group(['middleware' => 'auth'], function () {

	Route::get('dashboard', [DashboardController::class, 'dash'])->name('dashboard');
    Route::get('/', [DashboardController::class, 'home']);
	// Route::get('dashboard', function () {
	// 	return view('dashboard');
	// })->name('dashboard');

	Route::get('billing', function () {
		return view('billing');
	})->name('billing');

	Route::get('profile', function () {
		return view('profile');
	})->name('profile');

	Route::get('rtl', function () {
		return view('rtl');
	})->name('rtl');

	Route::get('customer-management', function () {
		return view('laravel-examples/customer-management');
	})->name('customer-management');

	Route::get('manager-management', function () {
		return view('laravel-examples/manager-management');
	})->name('manager-management');

	Route::get('tables', function () {
		return view('tables');
	})->name('tables');

    Route::get('virtual-reality', function () {
		return view('virtual-reality');
	})->name('virtual-reality');

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

    Route::get('/login', function () {
		return view('dashboard');
	})->name('sign-up');
});

//user routes
Route::get('customer-management', [CustomerController::class, 'listUsers'])->name("customer-management");
Route::get('dashboard', [CustomerController::class, 'listUser'])->name('dashboard');
Route::get('user-status/{id}/{status}', [CustomerController::class, 'changeUserStatus']);
Route::get('/delete-user/{id}', [CustomerController::class, 'deleteUser']);




//manager routes
Route::get('manager-management', [ManagerController::class, 'listManagers'])->name("manager-management");
Route::get('dashboard', [ManagerController::class, 'listManager'])->name('dashboard');
Route::get('manager-status/{id}/{status}', [ManagerController::class, 'changeManagerStatus']);
Route::get('/delete-manager/{id}', [ManagerController::class, 'deleteManager']);






//Récupération des utilisateurs



Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/session', [SessionsController::class, 'store']);
	Route::get('/login/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');

});

Route::get('/login', function () {
    return view('session/login-session');
})->name('login');