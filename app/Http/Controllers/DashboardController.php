<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function home()
    {
        return redirect('dashboard');
    }

    public function dash(){
        $customers = Customer::get();

        return view('dashboard')->with('customers', $customers);
    }
}
