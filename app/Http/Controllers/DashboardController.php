<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\Bus;
use App\Models\Customer;
use App\Models\Histories;
use App\Models\Manager;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function home()
    {
        $bus = Bus::get();
        $types = Type::get();
        $users = User::get();
        $agencies = Agency::get();
        $customers = Customer::get();
        $histories = Histories::orderBy("id", "DESC")->with('user')->limit(5)->get();


        return view('dashboard')
        ->with("customers", $customers)
        ->with("histories", $histories)
        ->with("bus", $bus)
        ->with("types", $types)
        ->with("users", $users)
        ->with("agencies", $agencies);
    }

}
