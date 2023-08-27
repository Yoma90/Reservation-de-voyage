<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\History;
use App\Models\Manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManagerController extends Controller
{
    public function listManager()
    {
        $managers = Manager::get();

        return view('dashboard')->with('managers', $managers);
    }

    public function listManagers()
    {
        $managers = Manager::get();

        return view('laravel-examples.manager-management')->with('managers', $managers);
    }

    public function changeManagerStatus($id, $status)
    {


        $response = [
            "type" => "",
            "message" => "",
        ];
        $manager = Manager::find($id);
        if ($manager) {
            $manager->status = $status;
            $manager->save();

            if ($status === "active") {
                $response = [
                    "type" => "success",
                    "message" => "Manager activated successfully",
                ];
            } else {
                $response = [
                    "type" => "success",
                    "message" => "Manager suspended successfully",
                ];
            }
        } else {
            $response = [
                "type" => "danger",
                "message" => "This Manager doesn't exist",
            ];
        }


        return redirect()->back()->with($response['type'], $response["message"]);
    }

    public function deleteManager($id)
    {

        try {
            $manager = Manager::find($id);
            $manager->delete();

            $response = [
                "type" => "success",
                "message" => "The manager has successfully deleted",
            ];
        } catch (\Throwable $th) {
            $response = [
                "type" => "danger",
                "message" => "internal server error",
            ];
        }


        return redirect()->back()->with($response['type'], $response['message']);
    }

    public function addManager(Request $request)
    {

        $attributes = $request->validate([
            'first_name' => "required|max:50|string",
            'last_name' => "required|max:50|string",
            'email'     => "required|max:50|string",
            'phone' => "required|max:50|string",
            'agency' => "required|max:50|string",
        ]);

        // dd($attributes);

        $response = [
            "type" => "success",
            "message" => "Manager added successfully",
        ];


        try {
            // Crée un nouveau manager avec les attributs validés
            $manager = new Manager([
                'first_name' => $attributes['first_name'],
                'last_name' => $attributes['last_name'],
                'email' => $attributes['email'],
                'phone' => $attributes['phone'],
                'agency' => $attributes['agency'],
            ]);

            // Enregistre le manager dans la base de données
            $manager->save();

            $response = [
                'type' => 'success',
                'message' => 'Manager added successfully',
            ];
        } catch (\Exception $e) {
            $response = [
                'type' => 'error',
                'message' => 'Failed to add manager'
            ];
        }

        return redirect()->back()->with($response['type'], $response['message']);
    }
}

/**
 * Display a listing of the resource.
 */
// public function index()
// {
//     return Manager::all();
// }

/**
 * Show the form for creating a new resource.
 */
// public function create()
// {

// }

/**
 * Store a newly created resource in storage.
 */
// public function store(Request $request)
// {
//     //
// }

/**
 * Display the specified resource.
 */
// public function show(Manager $manager)
// {
//     //
// }

/**
 * Show the form for editing the specified resource.
 */
// public function edit(Manager $manager)
// {
//     //
// }

/**
 * Update the specified resource in storage.
 */
    // public function update(Request $request, Manager $manager)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(Manager $manager)
    // {
    //
