<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Histories;
use App\Models\History;
use App\Models\Manager;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManagerController extends Controller
{
    public function listManager()
    {
        $managers = Manager::get();

        return view('dashboard')->with('managers', $managers);

    }

    public function listManagers()
    {
        $roles = Role::get();
        $managers = Manager::get();

        return view('pages.manager-management')->with('managers', $managers)->with('roles', $roles);
    }

    public function changeManagerStatus($id, $status)
    {


        $response = [
            "type" => "",
            "message" => "",
        ];
        $manager = Manager::find($id);
        if ($manager) {
            $manager->status = $status;
            $manager->save();

            if ($status === "active") {
                $response = [
                    "type" => "success",
                    "message" => "Manager activated successfully",
                ];
            } else {
                $response = [
                    "type" => "success",
                    "message" => "Manager suspended successfully",
                ];
            }
        } else {
            $response = [
                "type" => "danger",
                "message" => "This Manager doesn't exist",
            ];
        }


        return redirect()->back()->with($response['type'], $response["message"]);
    }

    public function deleteManager($id)
    {

        try {
            $manager = Manager::find($id);
            $manager->delete();

            $response = [
                "type" => "success",
                "message" => "The manager has successfully deleted",
            ];
        } catch (\Throwable $th) {
            $response = [
                "type" => "danger",
                "message" => "internal server error",
            ];
        }


        return redirect()->back()->with($response['type'], $response['message']);
    }

    public function addManager(Request $request)
    {
        $attributes = $request->validate([
            'first_name' => "required|max:50|string",
            'last_name' => "required|max:50|string",
            'email'     => "required|max:50|string",
            'phone' => "required|max:50|string",
            'agency' => "required|max:50|string",
        ]);

        $response = [
            "type" => "",
            "message" => "",
        ];

        if ($this->checkManagerEmail($attributes['email'])) {

            $attributes['password'] = Hash::make('00000000');
            $attributes['role_id'] = 2;

            $managers = Manager::create($attributes);
            $user_id = auth()->user()->id;
            Histories::create([
                'notification' => "added $managers->first_name manager successfully ",
                'type' => "add ",
                'user_id' => $user_id,
            ]);
            $response = [
                "type" => "success",
                "message" => "Manager added successfully",
            ];
        } else {
            $response = [
                "type" => "danger",
                "message" => "This Manager email already exist",
            ];
        }

        return redirect()->back()->with($response['type'], $response['message']);
    }

    public function checkManagerEmail($email)
    {
        if (Manager::where("email", $email)->count() > 0) {
            return false;
        } else {
            return true;
        }
    }


}
