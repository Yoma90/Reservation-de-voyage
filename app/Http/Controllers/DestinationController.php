<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\ViewException;

class DestinationController extends Controller
{
    public function index(){
        return view('laravel-examples.destination-management');
    }
}
