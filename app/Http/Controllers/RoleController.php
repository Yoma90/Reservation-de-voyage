<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $role = Role::with('user')->get();
        dd($role);
        return $role;
    }

    public function listRole(){

        $roles = Role::get();

        return view('pages.manager-management')->with('roles', $roles);
    }
}
