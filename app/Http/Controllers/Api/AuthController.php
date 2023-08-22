<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\AuthController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function __construct(){
        $this->middleware("auth:sanctum", ['except' =>["register", "login"]]);
    }

    public function register(Request $request){

        $request ->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'user_name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        //Créer un nouvel utilisateur
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'user_name' => $request->user_name,
            'email' => $request->email,
            'password' => bcrypt($request->password), 
        ]);

        $data = [
            'message' => 'Données récupérées avec succès',
        ];

        //Générer un token d'authentification (utilisant sanctum)
        $token = $user->createToken("token-name")->plainTextToken;

        return response()->json([
            'message' => $data,
            "user" => $user,
            'token' => $token, 
        ]);
    }

    public function logout(Request $request){
        $request -> user()->currentAccessToken()->delete();
        return response()->json([
            "success" =>true,
            "message" => "Logged out successfully !",
        ]);
    }

    public function login(Request $request){
        $request -> validate([
            "email" => "required|email",
            "password" => "required",
        ]);

        if (!Auth::attempt($request->only("email", "password"))) {
            return response()->json([
                "success" =>false,
                "message" => "The provided cridentials are incorrect !",
            ]);
        }

        $user = User::where("email", $request["email"])->firstOrFail();

        $token = $user->createToken("token-name")->plainTextToken;


        return response()->json([
            "success" =>true,
            "user" => $user,
            "token" => $token,
            "message" => "Login successfully !",
        ]);
    }
}
