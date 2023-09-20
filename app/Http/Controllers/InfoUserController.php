<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;

class InfoUserController extends Controller
{

    public function create()
    {
        return view('pages/user-profile');
    }

    public function store(Request $request)
    {

        $attributes = request()->validate([
            'first_name'    => ['required', 'max:255'],
            'last_name'    => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore(Auth::user()->id)],
            'phone'     => ['max:50'],
            'location' => ['max:70'],
        ]);
        if($request->get('email') != Auth::user()->email)
        {
            if(env('IS_DEMO') && Auth::user()->id == 1)
            {
                return redirect()->back()->withErrors(['msg2' => 'You are in a demo version, you can\'t change the email address.']);

            }

        }
        else{
            $attributes = request()->validate([
                'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore(Auth::user()->id)],
            ]);
        }


        User::where('id',Auth::user()->id)
        ->update([
            'first_name'    => $attributes['first_name'],
            'last_name'    => $attributes['last_name'],
            'phone'         => $attributes['phone'],
        ]);


        return redirect('/user-profile')->with('success','Profile updated successfully');
    }


    public function changeUserPassword(Request $request)
    {
        $fields = $request->validate([
            "old_password" => "required",
            "new_password" => "required",
            "c_password" => "required",
        ]);
        $response = [
            "type" => "",
            "message" => "",
        ];
        if ($fields["new_password"] === $fields["c_password"]) {
            if ($fields["new_password"] !== $fields["old_password"]) {
                try {

                    $attributes = [
                        "email" => auth()->user()->email,
                        "password" => $fields["old_password"]
                    ];

                    if (Auth::attempt($attributes)) {
                        $user_id = auth()->user()->id;
                        User::where('id', $user_id)->update([
                            "password" => Hash::make($fields["new_password"]),
                        ]);

                        $response = [
                            "type" => "success",
                            "message" => "Password changed successfully",
                        ];
                        Auth::logout();
                    } else {

                        $response = [
                            "type" => "danger",
                            "message" => "your old password doesn't correspond",
                        ];
                    }
                } catch (\Throwable $th) {
                    $response = [
                        "type" => "danger",
                        "message" => "internal server error",
                    ];
                }
            } else {
                $response = [
                    "type" => "danger",
                    "message" => "The new password cannot be same as the old password",
                ];
            }
        } else {
            $response = [
                "type" => "danger",
                "message" => "The password doesn't match",
            ];
        }

        return redirect()->back()->with($response['type'], $response['message']);
    }
}
