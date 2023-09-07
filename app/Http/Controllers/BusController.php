<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\Histories;
use App\Models\Role;
use App\Models\Type;
use Illuminate\Http\Request;

class BusController extends Controller
{
    public function view()
    {
        $bus = Bus::with('type')->get();
        $vipBus = $bus->where('type', 'VIP');
        $classicBus = $bus->where('type', 'Classic');

        return view('pages.bus-management')
        ->with('bus', $bus)
        ->with('vipBus', $vipBus)
        ->with('classicBus', $classicBus);
    }

    public function index()
    {
        $bus = Bus::with('type')->get();
        $types = Type::get();
        $roles = Role::get();


        $vipBus = $bus->where('type', 'VIP');
        $classicBus = $bus->where('type', 'Classic');

        return view('pages.bus-management')
            ->with('bus', $bus)
            ->with('types', $types)
            ->with('bus', $bus)
            ->with('roles', $roles)
            ->with('vipBus', $vipBus)
            ->with('classicBus', $classicBus);
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
        Bus::create($attributes);
        $user_id = auth()->user()->id;
        Histories::create([
            'notification' => "updated bus successfully ",
            'type' => "add",
            'user_id' => $user_id,
        ]);
        $response = [
            "type" => "success",
            "message" => "Bus updated successfully",
        ];
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
        if ($this->checkBusImmatriculation($attributes["immatriculation"])) {
            $bus = Bus::create($attributes);
            $user_id = auth()->user()->id;
            Histories::create([
                'notification' => "added $bus->type_id bus successfully ",
                'type' => "add",
                'user_id' => $user_id,
            ]);
            $response = [
                "type" => "success",
                "message" => "Bus added successfully",
            ];
        } else {
        }
        return redirect()->back()->with($response['type'], $response['message']);
    }

    public function checkBusImmatriculation($type_id)
    {
        if (Bus::where("immatriculation", $type_id)->count() > 0) {
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
}
