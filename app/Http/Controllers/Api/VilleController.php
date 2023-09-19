<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ville;
use Illuminate\Http\Request;

class VilleController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth:sanctum");
    }

    public function listCity(){
        $response = [];
        $code = 400;

        try {
            $villes = Ville::get();
            $response = [
                "data" => $villes,
                "message" => "Cities listed successfully",
            ];
            $code = 200;
        } catch (\Throwable $th) {
            $response = [
                'error' => $th->getMessage(),
                'message' => 'could not change password'
            ];
            $code = 500;
        }
        return response($response, $code);
    }
}
