<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\Bus;
use App\Models\Histories;
use App\Models\Role;
use App\Models\Type;
use Illuminate\Http\Request;
use Throwable;

class BusController extends Controller
{



    public function listBuses(Agency $agencies)
    {
        $buses = $agencies->buses;
        $bus = Bus::with('type')->get();
        $roles = Role::get();
        $agencies = Agency::get();
        $types = Type::get();

        $vipBus = Bus::get()->where('type_id', 1);
        $classicBus = Bus::get()->where('type_id', 2);



        return view('pages.list-bus')
            ->with('buses', $buses)
            ->with('types', $types)
            ->with('bus', $bus)
            ->with('agencies', $agencies)
            ->with('vipBus', $vipBus)
            ->with('classicBus', $classicBus)
            ->with('roles', $roles);
    }


    public function view()
    {
        $bus = Bus::with('type')->get();
        $roles = Role::get();
        $vipBus = $bus->where('type', 'VIP');
        $classicBus = $bus->where('type', 'Classic');

        return view('pages.bus-management')
            ->with('bus', $bus)
            ->with('roles', $roles)
            ->with('vipBus', $vipBus)
            ->with('classicBus', $classicBus);
    }

    public function index()
    {
        $bus = Bus::get();
        $types = Type::get();
        $roles = Role::get();


        $vipBus = Bus::get()->where('type_id', 1);
        $classicBus = Bus::get()->where('type_id', 2);

        return view('pages.bus-management')
            ->with('bus', $bus)
            ->with('types', $types)
            ->with('roles', $roles)
            ->with('vipBus', $vipBus)
            ->with('classicBus', $classicBus);
    }

    public function updateBus(Request $request, $id)
    {
        $request->validate([
            'type_id' => "required",
        ]);
        $response = [
            "type" => "",
            "message" => "",
        ];
        try {
            $bus = Bus::findOrFail($id);
            $bus->type_id = $request->input('type_id');
            $bus->save();

            $response = [
                "type" => "success",
                "message" => "Updated bus successfully"
            ];

            $user_id = auth()->user()->id;
            Histories::create([
                "notification" => "updated $bus->type_id bus successfully.",
                "type" => "change",
                "user_id" => $user_id,
            ]);
        } catch (Throwable $th) {
            $response = [
                "type" => "danger",
                "message" => "Internal server error",
            ];
        }

        return redirect()->back()->with($response['type'], $response['message']);
    }


    public function addBus(Request $request)
    {
        $attributes = $request->validate([
            'type_id' => "required",
            'immatriculation' => "required",
        ]);
        $response = [
            "type" => "",
            "message" => "",
        ];
        try {
            if ($this->checkBusImmatriculation($attributes["immatriculation"])) {


                $bus = Bus::create($attributes);
                $bus_type = $bus->type->name;
                $user_id = auth()->user()->id;
                Histories::create([
                    'notification' => "added $bus_type bus successfully ",
                    'type' => "add",
                    'user_id' => $user_id,
                ]);
                $response = [
                    "type" => "success",
                    "message" => "Bus added successfully",
                ];
            } else {
                $response = [
                    'type' => "danger",
                    "message" => "This immatriculation has already been used"
                ];
            }
        } catch (\Throwable $th) {
            $response = [
                "type" => "danger",
                "message" => "internal server error",
            ];
        }

        return redirect()->back()->with($response['type'], $response['message']);
    }

    public function checkBusImmatriculation($bus_type)
    {
        if (Bus::where("immatriculation", $bus_type)->count() > 0) {
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
                $user_id = auth()->user()->id;
                Histories::create([
                    'notification' => "activated $bus->bus_type bus successfully ",
                    'type' => "change",
                    'user_id' => $user_id,
                ]);
            } else {
                $response = [
                    "type" => "success",
                    "message" => "Bus suspended successfully",
                ];
                $user_id = auth()->user()->id;
                Histories::create([
                    'notification' => "suspended $bus->bus_type bus successfully ",
                    'type' => "change",
                    'user_id' => $user_id,
                ]);
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
            $user_id = auth()->user()->id;
            Histories::create([
                'notification' => "suspended $bus->bus_type bus successfully ",
                'type' => "change",
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
}
