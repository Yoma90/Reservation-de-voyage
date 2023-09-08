<?php

use App\Http\Controllers\BusController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\HistoriesController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\AgencyController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
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
    Route::get('/', function () {
        return redirect('dashboard');
    });

    // Route::middleware(['user-role:1'])->group(function () {
        Route::get('dashboard', [DashboardController::class, 'home'])->name('dashboard');


        //Customers routes
        Route::get('customer-management', [CustomerController::class, 'listCustomers'])->name("customer-management");
        Route::get('user-status/{id}/{status}', [CustomerController::class, 'changeUserStatus']);
        Route::get('/delete-user/{id}', [CustomerController::class, 'deleteUser']);
        Route::get('customer-management', [CustomerController::class, 'index']);


        //Managers routes
        Route::get('agency-management', [AgencyController::class, 'listAgencies'])->name('agency-management');
        Route::get('/update-agency', [AgencyController::class, 'updateAgency'])->name('update-agency');
        Route::get('agency-status/{id}/{status}', [AgencyController::class, 'changeAgencyStatus']);
        Route::get('/delete-agency/{id}', [AgencyController::class, 'deleteAgency']);
        Route::post('/add-agency', [AgencyController::class, 'addAgency'])->name('add-agency');


        //History routes
        Route::get('history', [HistoriesController::class, 'index']);
    // });



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


    //Bus routes
    Route::get('bus-management', [BusController::class, 'index'])->name('bus-management');
    Route::get('list-bus', [BusController::class, 'listBuses'])->name('list-bus');
    Route::post('/add-bus', [BusController::class, 'addBus'])->name('add-bus');
    Route::get('bus-status/{id}/{status}', [BusController::class, 'changeBusStatus']);
    Route::get('/delete-bus/{id}', [BusController::class, 'deleteBus']);
    Route::post('/update-bus', [BusController::class, 'updateBus'])->name('update-bus');
    // Route::get('bus-management', [BusController::class, 'edit'])->name('bus-management');


    //Travels routes
    Route::get('travel-management', [TravelController::class, 'all'])->name("travel-management");


    //Destinations routes
    Route::get('destination-management', [DestinationController::class, 'index'])->name('destination-management');
});

//Récupération des utilisateurs

Route::group(['middleware' => 'guest'], function () {
    // Route::get('/register', [RegisterController::class, 'create']);
    // Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/session', [SessionsController::class, 'store']);
    // Route::get('/login/forgot-password', [ResetController::class, 'create']);
    // Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
    Route::post('/change-password', [SessionsController::class, 'changeUserPassword']);
});

Route::get('/login', function () {
    return view('session/login-session');
})->name('login');
