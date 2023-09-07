<?php

namespace App\Http\Controllers;

use App\Models\Histories;
use App\Models\Role;
use Illuminate\Http\Request;

class HistoriesController extends Controller
{
    //
    public function index(){
        $histories = Histories::orderBy("id", "DESC")->with(["user"])->limit(20)->get();

        return view('pages.history')->with("histories", $histories);
    }
}
