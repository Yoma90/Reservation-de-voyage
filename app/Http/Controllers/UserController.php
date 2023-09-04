<?php

namespace App\Http\Controllers;

use App\Helper\UserService;
use App\Models\Customer;
use App\Models\History;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function register(Request $request){
        $response = (new UserService($request->first_name, $request->last_name, $request->user_name, $request->email, $request->password));
        return response()->json($response);
    }

   
}
