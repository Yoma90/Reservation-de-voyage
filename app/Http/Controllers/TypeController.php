<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function index(){
        $types = Type::get();
        return view('pages.bus-management')->with('types', $types);
    }
}
