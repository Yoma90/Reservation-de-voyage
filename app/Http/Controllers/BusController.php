<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\Histories;
use App\Models\Type;
use Illuminate\Http\Request;

class BusController extends Controller
{

    public function index()
    {
        $bus = Bus::get();
        $types = Type::get();

        return view('pages.bus-management')
            ->with('bus', $bus)
            ->with('types', $types);
    }

    public function updateBus(Request $request)
    {
        $attributes = $request->validate([
            'type_id' => "required",
        ]);
        $response = [
            "type" => "",
            "message" => "",
        ];

        if ($this->checkBusType($attributes["type_id"])) {
            $bus = Bus::updated($attributes);
            $response = [
                "type" => "success",
                "message" => "Bus updated successfully",
            ];
        }
        return redirect()->back()->with($response['type'], $response['message']);
    }

    public function addBus(Request $request)
    {
        $attributes = $request->validate([
            'type_id' => "required",
            'immatriculation' => "required"
        ]);
        $response = [
            "type" => "",
            "message" => "",
        ];
        if ($this->checkBusType($attributes["immatriculation"])) {
            $bus = Bus::create($attributes);
            $user_id = auth()->user()->id;
            Histories::create([
                'notification' => "added $bus->type bus successfully ",
                'type' => "add",
                'user_id' => $user_id,
            ]);
            $response = [
                "type" => "success",
                "message" => "Bus added successfully",
            ];
        }
        else{

        }
        return redirect()->back()->with($response['type'], $response['message']);
    }

    public function checkBusType($type)
    {
        if (Bus::where("immatriculation", $type)->count() > 0) {
            return false;
        } else {
            return true;
        }
    }

    public function changeBusStatus($id, $status)
    {

        $response = [
            "type" => "",
            "message" => "",
        ];
        $bus = Bus::find($id);
        if ($bus) {
            $bus->status = $status;
            $bus->save();

            if ($status === "active") {
                $response = [
                    "type" => "success",
                    "message" => "Bus activated successfully",
                ];
            } else {
                $response = [
                    "type" => "success",
                    "message" => "Bus suspended successfully",
                ];
            }
        } else {
            $response = [
                "type" => "danger",
                "message" => "This Bus doesn't exist",
            ];
        }


        return redirect()->back()->with($response['type'], $response["message"]);
    }

    public function deleteBus($id)
    {

        try {
            $bus = Bus::find($id);
            $bus->delete();
            $response = [
                "type" => "success",
                "message" => "The bus has successfully deleted",
            ];
        } catch (\Throwable $th) {
            $response = [
                "type" => "danger",
                "message" => "internal server error",
            ];
        }


        return redirect()->back()->with($response['type'], $response['message']);
    }

    /**
     * Display a listing of the resource.
     */


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
