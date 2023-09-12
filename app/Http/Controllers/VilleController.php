<?php

namespace App\Http\Controllers;

use App\Models\Agency;
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
        $cities = Ville::where('id', auth()->user()->id)->get();
        $agencies = Agency::get();
        $villes = Ville::get();

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
            $city->delete();

            $response = [
                "type" => "success",
                "message" => "The city has successfully deleted",
            ];
            $user_id = auth()->user()->id;
            Histories::create([
                'notification' => "deleted $city->name city successfully ",
                'type' => "delete",
                'user_id' => $user_id,
            ]);
        } catch (\Throwable $th) {
            $response = [
                "type" => "danger",
                "message" => "internal server error",
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
                // dd($attributes);
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
        $attributes = $request->validate([
            'name' => 'required|exists:villes,id',
        ]);

        $response = [
            'type' => '',
            'message' => '',
        ];


        if ($this->checkVilleName($attributes['name'])) {
            $user = auth()->user();

            $city = Ville::findOrFail($request);
            $city->name = $request->input('name');
            $city->save();
            dd($city);
            $response = [
                'type' => 'success',
                'message' => 'City attributed successfully',
            ];
        } else {
            $response = [
                'type' => 'danger',
                'message' => 'City not attributed to this manager',
            ];
        }

        return redirect()->back()->with($response['type'], $response['message']);
    }

    public function checkVilleName($name)
    {
        if (Ville::where("name", $name)->count() > 0) {
            return false;
        } else {
            return true;
        }
    }
}
