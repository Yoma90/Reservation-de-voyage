<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Histories;
use App\Models\Manager;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function home()
    {
        $managers = Manager::get();
        $customers = Customer::get();
        $histories = Histories::get();
        return view('dashboard')
        ->with("customers", $customers)
        ->with("histories", $histories)
        ->with("managers", $managers);
    }

    public function dash(){
        $customers = Customer::get();

        return view('dashboard')->with('customers', $customers);
    }
}
