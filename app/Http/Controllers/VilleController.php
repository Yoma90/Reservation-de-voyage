<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\AgencyVille;
use App\Models\Histories;
use App\Models\Ville;
use Illuminate\Http\Request;

class VilleController extends Controller
{
    public function index()
    {
        return view('pages.ville-management');
    }
    public function listVille()
    {
        $cities = Ville::get();
        $agencies = Agency::get();

        return view('pages.ville-management')
            ->with('agencies', $agencies)
            ->with('cities', $cities);
    }

    public function listVilles()
    {
        $cities = AgencyVille::where('agency_id', auth()->user()->agency->id)->get();
        $agencies = Agency::get();
        $villes = Ville::get();

        // dd($cities)

        return view('pages.city-management')
            ->with('villes', $villes)
            ->with('agencies', $agencies)
            ->with('cities', $cities);
    }

    public function changeCityStatus($id, $status)
    {

        $response = [
            "type" => "",
            "message" => "",
        ];
        $city = Ville::find($id);
        if ($city) {
            $city->status = $status;
            $city->save();

            if ($status === "active") {

                $response = [
                    "type" => "success",
                    "message" => "City activated successfully",
                ];
                $user_id = auth()->user()->id;
                Histories::create([
                    'notification' => "activated $city->name city successfully ",
                    'type' => "change",
                    'user_id' => $user_id,
                ]);
            } else {
                $response = [
                    "type" => "success",
                    "message" => "City suspended successfully",
                ];
                $user_id = auth()->user()->id;
                Histories::create([
                    'notification' => "suspended $city->name city successfully ",
                    'type' => "change",
                    'user_id' => $user_id,
                ]);
            }
        } else {
            $response = [
                "type" => "danger",
                "message" => "This City doesn't exist",
            ];
        }


        return redirect()->back()->with($response['type'], $response["message"]);
    }

    public function deleteCity($id)
    {
        try {
            $city = Ville::find($id);

            if ($city && $city->status === 'suspended') {
                $city->delete();

                $response = [
                    "type" => "success",
                    "message" => "The city has been successfully deleted",
                ];
                $user_id = auth()->user()->id;
                Histories::create([
                    'notification' => "deleted $city->name city successfully ",
                    'type' => "delete",
                    'user_id' => $user_id,
                ]);
            } elseif ($city && $city->status !== 'suspended') {
                $response = [
                    "type" => "danger",
                    "message" => "You can only delete a suspended city",
                ];
            } else {
                $response = [
                    "type" => "danger",
                    "message" => "City not found",
                ];
            }
        } catch (\Throwable $th) {
            dd($th->getMessage());
            $response = [
                "type" => "danger",
                "message" => "Internal server error",
            ];
        }

        return redirect()->back()->with($response['type'], $response['message']);
    }


    public function deleteVilleToAgency($id)
    {
        $ville = AgencyVille::find($id);

        $response = [
            'type' => '',
            'message' => '',
        ];

        if ($ville) {
            try {
                AgencyVille::where('id', $id)->delete();
                $response = [
                    "type" => "success",
                    "message" => "The city has been successfully deleted",
                ];
            } catch (\Throwable $th) {
                dd($th->getMessage());
                $response = [
                    "type" => "danger",
                    "message" => "Internal server error",
                ];
            }
        } else {
            $response = [
                "type" => "danger",
                "message" => "City not found",
            ];
        }
        return redirect()->back()->with($response['type'], $response['message']);
    }


    public function addCity(Request $request)
    {
        $attributes = $request->validate([
            'name' => 'required|max:50',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        $response = [
            'type' => '',
            'message' => '',
        ];

        try {
            if ($this->checkName($attributes['name'])) {
                $imageController = new ImageController();
                $image = $request->file('image');
                $imageFileName = $imageController->upload($image, 'villes');
                $attributes['image_path'] = $imageFileName;
                $city = Ville::create($attributes);
                $user_id = auth()->user()->id;
                Histories::create([
                    'notification' => "added $city->name city successfully ",
                    'type' => 'add',
                    'user_id' => $user_id,
                ]);
                $response = [
                    'type' => 'success',
                    'message' => 'City added successfully',
                ];
            } else {
                $response = [
                    'type' => 'danger',
                    'message' => 'This City name already exists',
                ];
            }
        } catch (\Throwable $th) {
            dd($th->getMessage());
            $response = [
                'type' => 'danger',
                'message' => 'Internal server error',
            ];
        }

        return redirect()->back()->with($response['type'], $response['message']);
    }


    public function checkName($name)
    {
        if (Ville::where("name", $name)->count() > 0) {
            return false;
        } else {
            return true;
        }
    }

    public function takeCity(Request $request)
    {
        $request->validate([
            'ville_id' => 'required|exists:villes,id',
            'name' => 'required',
        ]);

        try {
            $cityId = $request->input('ville_id');
            $name = $request->input('name');

            if ($this->checkAgencyInVille($cityId)) {
                AgencyVille::create([
                    'ville_id' => $cityId,
                    'agency_id' => auth()->user()->agency->id,
                    'location' => $name,
                ]);

                $response = [
                    'type' => 'success',
                    'message' => 'City attributed successfully',
                ];
            } else {
                $response = [
                    'type' => 'danger',
                    'message' => 'City is already in your list',
                ];
            }
        } catch (\Throwable $th) {
            dd($th->getMessage());
            $response = [
                'type' => 'danger',
                'message' => 'Internal server error',
            ];
        }

        return redirect()->back()->with($response['type'], $response['message']);
    }


    public function checkAgencyInVille($ville_id)
    {
        if (AgencyVille::where("ville_id", $ville_id)->where('agency_id', auth()->user()->agency->id)->count() > 0) {
            return false;
        } else {
            return true;
        }
    }
}
