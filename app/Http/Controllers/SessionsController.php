<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\Histories;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SessionsController extends Controller
{
    // public function create2()
    // {
    //     $roles = Role::get();
    //     $agencies = Agency::get();

    //     return view('session.login-session')
    //     ->with('roles', $roles)
    //     ->with('agencies', $agencies);
    // }

    public function create()
    {
        $roles = Role::get();
        $agencies = Agency::get();

        return view('session.login-session')
            ->with('roles', $roles)
            ->with('agencies', $agencies);
    }

    public function store()
    {
        $attributes = request()->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        if (Auth::attempt($attributes)) {

            session()->regenerate();
            $user_id = auth()->user()->id;

            Histories::create([
                "notification" => " logged in Successfully",
                "type" => "login",
                "user_id" => $user_id,
            ]);
            if (auth()->user()->role->id === 1) {
                return redirect('dashboard')->with(['success' => 'You are logged in.']);
            } else {
                return redirect('manager-dashboard')->with(['success' => 'You are logged in.']);
            }
        } else {

            return back()->withErrors(['email' => 'Email or password invalid.']);
        }
    }

    public function destroy()
    {
        $user_id = auth()->user()->id;
        Histories::create([
            "notification" => " logged out Successfully",
            "type" => "logout",
            "user_id" => $user_id,
        ]);

        Auth::logout();

        return redirect('/login')
            ->with(['success' => 'You\'ve been logged out.']);
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
                    dd($th->getMessage());
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
