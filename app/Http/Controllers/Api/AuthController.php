<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth:sanctum", ['except' => ["register", "login"]]);
    }

    public function register(Request $request)
    {

        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'user_name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        $response = [
            "statusCode" => 400,
            "data" => [],
            "message" => "",
        ];

        try {
            //Créer un nouvel utilisateur
            $user = Customer::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'user_name' => $request->user_name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            //Générer un token d'authentification (utilisant sanctum)
            $token = $user->createToken("token-name")->plainTextToken;
            $response["statusCode"] = 200;
            $response["message"] = "Registered successfully";
        } catch (\Throwable $th) {
            $response = [
                "statusCode" => 500,
                "data" => $th->getMessage(),
                "message" => "Internal server error",
            ];
        }

        return response()->json([
            'data' => $response,
            "user" => $user,
            'token' => $token,
        ], $response['statusCode']);
    }

    public function logout(Request $request)
    {
        $response = [
            "statusCode" => 400,
            "data" => [],
            "message" => "",
        ];
        try {
            $request->user()->currentAccessToken()->delete();
            $response["statusCode"] = 200;
            $response["message"] = "Logged out successfully";
        } catch (\Throwable $th) {
            $response = [
                "statusCode" => 500,
                "data" => $th->getMessage(),
                "message" => "Internal server error",
            ];
        }
        return response()->json([
            "data" => $response
        ], $response['statusCode']);
    }


    public function login(Request $request)
    {
        $attributes = $request->validate([
            'email'     => "required",
            'password'     => "required",
        ]);
        $response = [
            "statusCode" => 400,
            "data" => [],
            "message" => "",
        ];

        try {
            if (!Auth::attempt($attributes)) {
                $user = Customer::where("email", $request["email"])->firstOrFail();
                $token = $user->createToken("token-name")->plainTextToken;
                $response = [
                    "statusCode" => 200,
                    "data" => [
                        "user" => $user,
                        "token" => $token
                    ],
                    "message" => "Login successfully",
                ];
            } else {
                $response["statusCode"] = 422;
                $response["message"] = "Wrong credentials";
            }
        } catch (\Throwable $th) {
            $response = [
                "statusCode" => 500,
                "data" => $th->getMessage(),
                "message" => "Internal server error",
            ];
        }

        return response()->json([
            "data" => $response
        ], $response['statusCode']);
    }
}
