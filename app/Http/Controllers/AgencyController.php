<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\AgencyVille;
use App\Models\Histories;
use App\Models\Role;
use App\Models\Ville;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AgencyController extends Controller
{
    public function listAgency(){
        $agencies = Agency::get();
        $villes = Ville::get();

        return view('pages.list-agencies')
        ->with('villes', $villes)
        ->with('agencies', $agencies);
    }

    public function listAgencies()
    {
        $villes = Ville::get();
        $roles = Role::get();
        $agencies = Agency::get();

        return view('pages.agency-management')
        ->with('villes', $villes)
        ->with('agencies', $agencies)->with('roles', $roles);
    }

    public function changeAgencyStatus($id, $status)
    {

        $response = [
            "type" => "",
            "message" => "",
        ];
        $agency = Agency::find($id);
        if ($agency) {
            $agency->status = $status;
            $agency->save();

            if ($status === "active") {

                $response = [
                    "type" => "success",
                    "message" => "Agency activated successfully",
                ];
                $user_id = auth()->user()->id;
                Histories::create([
                    'notification' => "activated $agency->name agency successfully ",
                    'type' => "change",
                    'user_id' => $user_id,
                ]);
            } else {
                $response = [
                    "type" => "success",
                    "message" => "Agency suspended successfully",
                ];
                $user_id = auth()->user()->id;
                Histories::create([
                    'notification' => "suspended $agency->name agency successfully ",
                    'type' => "change",
                    'user_id' => $user_id,
                ]);
            }
        } else {
            $response = [
                "type" => "danger",
                "message" => "This Agency doesn't exist",
            ];
        }


        return redirect()->back()->with($response['type'], $response["message"]);
    }

    public function deleteAgency($id)
    {

        try {
            $agency = Agency::find($id);
            // dd($agency);

            $agency->delete();
            $response = [
                "type" => "success",
                "message" => "The agency has successfully deleted",
            ];
            $user_id = auth()->user()->id;
            Histories::create([
                'notification' => "deleted $agency->name agency successfully ",
                'type' => "delete",
                'user_id' => $user_id,
            ]);
        } catch (\Throwable $th) {
            // dd($th->getMessage());
            $response = [
                "type" => "danger",
                "message" => "internal server error",
            ];
        }


        return redirect()->back()->with($response['type'], $response['message']);
    }

    public function addAgency(Request $request)
    {
        $attributes = $request->validate([
            'name' => "required",
            'location' => 'required',
            'ville_id' => "required"
        ]);

        $response = [
            "type" => "",
            "message" => "",
        ];

        try {
            // if ($this->checkEmail($attributes['name'])) {

                $agency = Agency::create($attributes);
                AgencyVille::create([
                    'ville_id' => $attributes['ville_id'],
                    'location' => $attributes['location'],
                    'agency_id' => $agency->id,
                ]);
                $user_id = auth()->user()->id;
                Histories::create([
                    'notification' => "added $agency->name agency successfully ",
                    'type' => "add",
                    'user_id' => $user_id,
                ]);
                $response = [
                    "type" => "success",
                    "message" => "Agency added successfully",
                ];
            // } else {
            //     $response = [
            //         "type" => "danger",
            //         "message" => "This Agency name already exist",
            //     ];
            // }
        } catch (\Throwable $th) {
            dd($th->getMessage());
            $response = [
                "type" => "danger",
                "message" => "internal server error",
            ];
        }

        return redirect()->back()->with($response['type'], $response['message']);
    }

    public function updateAgency(Request $request)
    {
        $attributes = $request->validate([
            'agency' => 'required|max:50',
        ]);

        $response = [
            'type' => "",
            'message' => ""
        ];

        try {
            $agencies = Agency::updated($attributes);
            $user_id = auth()->user()->id;
            Histories::create([
                'notification' => "updated $agencies agency successfully ",
                'type' => "add",
                'user_id' => $user_id,
            ]);
            $response = [
                "type" => "success",
                "message" => "Agency updated successfully",
            ];
        } catch (\Throwable $th) {
            $response = [
                "type" => "danger",
                "message" => "internal server error",
            ];
        }
        return redirect()->back()->with($response['type'], $response['message']);
    }

    // public function checkEmail($name)
    // {
    //     if (Agency::where("name", $name)->count() > 0) {
    //         return false;
    //     } else {
    //         return true;
    //     }
    // }
}
