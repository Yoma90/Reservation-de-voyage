<?php

namespace App\Http\Controllers;

use App\Helper\UserService;
use App\Models\Bus;
use App\Models\Agency;
use App\Models\Bus as ModelsBus;
use App\Models\Customer;
use App\Models\Histories;
use App\Models\History;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use function PHPSTORM_META\type;

class UserController extends Controller
{

    public function register(Request $request)
    {
        $response = (new UserService($request->first_name, $request->last_name, $request->user_name, $request->email, $request->password));
        return response()->json($response);
    }

    public function index()
    {
        return view('pages.user-management');
    }

    // public function listBusesByAgency($agency_id)
    // {
    //     $agencies = Agency::findOrFail($agency_id);
    //     $bus = Bus::where('agency_id', $agencies->id)->get();

    //     return view('pages.list-bus')->with('agencies', $agencies)->with('bus', $bus);
    // }

    public function listUser()
    {
        $users = User::where('id', '!=', auth()->user()->id)->get();
        $roles = Role::get();
        $agencies = Agency::get();

        return view('pages.user-management')
            ->with('agencies', $agencies)
            ->with('roles', $roles)
            ->with('users', $users);
    }

    public function addUser(Request $request)
    {
        $attributes = $request->validate([
            'first_name' => "required|max:50",
            'last_name' => "required|max:50",
            'email'     => "required|max:50",
            'phone' => "required|max:50",
            'agency_id' => "required|max:50"
        ]);
        $response = [
            'type' => "",
            'message' => ""
        ];

        try {
            if ($this->checkEmail($attributes['email'])) {
                $attributes['password'] = Hash::make('00000000');
                $attributes['role_id'] = ('2');
                if ($this->checkAgencyId($attributes['agency_id'])) {
                    $user = User::create($attributes);
                    $response = [
                        "type" => "success",
                        "message" => "User added successfully",
                    ];
                    $user_id = auth()->user()->id;
                    Histories::create([
                        "notification" => " added $user->first_name user Successfully",
                        "type" => "add",
                        "user_id" => $user_id,
                    ]);
                } else {
                    $response = [
                        "type" => "danger",
                        "message" => "This agency name has already been used",
                    ];
                }
            } else {
                $response = [
                    "type" => "danger",
                    "message" => "This email has already been used",
                ];
            }
        } catch (\Throwable $th) {
            $response = [
                "type" => "danger",
                "message" => "internal server error",
            ];
        }


        return redirect()->back()->with($response['type'], $response['message']);
    }

    public function checkEmail($email)
    {
        if (User::where("email", $email)->count() > 0) {
            return false;
        } else {
            return true;
        }
    }

    public function checkAgencyId($agency)
    {
        if (User::where("agency_id", $agency)->count() > 0) {
            return false;
        } else {
            return true;
        }
    }


    public function changeUserStatus($id, $status)
    {
        $response = [
            "type" => "",
            "message" => "",
        ];
        $user = User::find($id);
        if ($user) {
            $user->status = $status;
            $user->save();

            if ($status === "active") {
                $response = [
                    "type" => "success",
                    "message" => "User activated successfully",
                ];
                $user_id = auth()->user()->id;
                Histories::create([
                    "notification" => " activated $user->first_name user Successfully",
                    "type" => "change",
                    "user_id" => $user_id,
                ]);
            } else {
                $response = [
                    "type" => "success",
                    "message" => "User suspended successfully",
                ];
                $user_id = auth()->user()->id;
                Histories::create([
                    "notification" => " suspended $user->first_name user Successfully",
                    "type" => "change",
                    "user_id" => $user_id,
                ]);
            }
        } else {
            $response = [
                "type" => "danger",
                "message" => "This user doesn't exist",
            ];
        }


        return redirect()->back()->with($response['type'], $response["message"]);
    }


    public function deleteUser($id)
    {

        try {
            $user = User::find($id);
            $user->delete();

            $response = [
                "type" => "success",
                "message" => "The user has successfully deleted",
            ];
            $user_id = auth()->user()->id;
            Histories::create([
                "notification" => " deleted $user->first_name user Successfully",
                "type" => "delete",
                "user_id" => $user_id,
            ]);
        } catch (\Throwable $th) {
            $response = [
                "type" => "danger",
                "message" => "internal server error",
            ];
        }


        return redirect()->back()->with($response['type'], $response['message']);
    }
}
