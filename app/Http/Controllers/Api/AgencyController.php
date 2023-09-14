<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Agency;
use App\Models\AgencyVille;
use Illuminate\Http\Request;

class AgencyController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth:sanctum");
    }


    public function listAgency($id)
    {
        $response = [];
        $code = 400;

        try {
            $villes = AgencyVille::where('id', $id)->with(['ville', 'agency'])->get();

            if ($villes->isEmpty()) {
                $response = [
                    'error' => 'City not found',
                    'message' => 'Unprocessable entry.'
                ];
                $code = 422;
            } else {
                $response = [
                    "data" => $villes,
                    "message" => "Cities listed successfully",
                ];
                $code = 200;
            }
        } catch (\Throwable $th) {
            $response = [
                'error' => $th->getMessage(),
                'message' => 'Unable to retrieve city data'
            ];
            $code = 500;
        }

        return response($response, $code);
    }
}
