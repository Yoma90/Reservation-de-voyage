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
use App\Http\Controllers\UserController;
use App\Http\Controllers\VilleController;
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
    Route::get('manager-dashboard', [DashboardController::class, 'index'])->name('manager-dashboard');


    //Customers routes
    Route::get('customer-management', [CustomerController::class, 'listCustomers'])->name("customer-management");
    Route::get('customer-status/{id}/{status}', [CustomerController::class, 'changeCustomerStatus']);
    Route::get('/delete-user/{id}', [CustomerController::class, 'deleteUser']);
    Route::get('customer-management', [CustomerController::class, 'index']);


    //Managers routes
    Route::get('agency-management', [AgencyController::class, 'listAgencies'])->name('agency-management');
    Route::get('list-agencies', [AgencyController::class, 'listAgency'])->name('list-agencies');
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

    Route::get('user-management', [UserController::class, 'listUser'])->name('user-management');
    Route::get('user-status/{id}/{status}', [UserController::class, 'changeUserStatus']);
    Route::post('/add-user', [UserController::class, 'addUser'])->name('add-user');


    //Bus routes
    Route::get('bus-management', [BusController::class, 'index'])->name('bus-management');
    // Route::get('list-bus', [BusController::class, 'listBuses'])->name('list-bus');
    Route::get('bus-status/{id}/{status}', [BusController::class, 'changeBusStatus']);
    Route::get('/delete-bus/{id}', [BusController::class, 'deleteBus']);
    Route::put('/update-bus/{id}', [BusController::class, 'updateBus'])->name('update-bus');


    //Travels routes
    Route::get('travel-management', [TravelController::class, 'all'])->name("travel-management");
    Route::get('/delete-travel/{id}', [TravelController::class, 'deleteTravel']);
    Route::get('travel-status/{id}/{status}', [TravelController::class, 'changeTravelStatus']);
    Route::post('/add-travel', [TravelController::class, 'addTravel'])->name('add-travel');




    //Destinations routes
    Route::get('destination-management', [DestinationController::class, 'index'])->name('destination-management');



    // Route::middleware(['user-role:2'])->group(function () {

        Route::post('/add-bus', [BusController::class, 'addBus'])->name('add-bus');

    // });

    Route::post('/add-city', [VilleController::class, 'addCity'])->name('add-city');
    Route::get('ville-management', [VilleController::class, 'listVille'])->name('ville-management');
    Route::get('/delete-city/{id}', [VilleController::class, 'deleteCity']);
    Route::get('city-status/{id}/{status}', [VilleController::class, 'changeCityStatus']);



    Route::post('/take-city', [VilleController::class, 'takeCity'])->name('take-city');
    Route::get('/delete-ville-agency/{id}', [VilleController::class, 'deleteVilleToAgency'])->name('delete-ville-agency');
    Route::get('city-management', [VilleController::class, 'listVilles'])->name('city-management');
});






//Récupération des utilisateurs

Route::group(['middleware' => 'guest'], function () {
    // Route::get('/register', [RegisterController::class, 'create']);
    // Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [SessionsController::class, 'create'])->name('login');
    Route::post('/session', [SessionsController::class, 'store']);

    // Route::get('/login/forgot-password', [ResetController::class, 'create']);
    // Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
});
Route::post('/change-password', [SessionsController::class, 'changeUserPassword']);

Route::get('user-profile', [SessionsController::class, 'index'])->name("user-profile");

Route::get('/login', function () {
    return view('session/login-session');
})->name('login');
