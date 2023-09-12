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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        $response = [
            'type' => '',
            'message' => '',
        ];

        try {
            if ($request->file('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/villes', $imageName); // Stocker l'image dans storage/app/public/villes
                $attributes['image'] = 'villes/' . $imageName; // Chemin de l'image dans le stockage
            }

            if ($this->checkName($attributes['name'])) {
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
}
