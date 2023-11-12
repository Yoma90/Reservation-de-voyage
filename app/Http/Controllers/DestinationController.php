<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\View\ViewException;

class DestinationController extends Controller
{
    public function index(){
        $destinations = Destination::get();

        return view('pages.destination-management')->with('destination', $destinations);
    }
}
