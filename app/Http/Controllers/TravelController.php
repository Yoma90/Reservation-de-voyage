<?php

namespace App\Http\Controllers;

use App\Models\Histories;
use App\Models\Travel;
use App\Models\Voyage;
use Illuminate\Http\Request;

class TravelController extends Controller
{

    public function all()
    {
        $travels = Voyage::get();

        return view('pages.travel-management')
            ->with('travels', $travels);
    }

    public function addTravel(Request $request)
{
    $attributes = $request->validate([
        'from' => 'required',
        'to' => 'required',
        'details' => 'required',
        'price' => 'required'
    ]);

    $response = [
        'type' => '',
        'message' => ''
    ];

    try {
        if ($attributes["from"] !== $attributes["to"]) {
            // Vérifiez si "from" est différent de "to"
            if ($this->checkFromName($attributes["from"])) {
                $travel = Voyage::create($attributes);
                $travels = $travel->from;
                $user_id = auth()->user()->id;
                Histories::create([
                    'notification' => "added $travels Travel successfully ",
                    'type' => 'add',
                    'user_id' => $user_id,
                ]);
                $response = [
                    'type' => 'success',
                    'message' => 'Travel added successfully',
                ];
            } else {
                $response = [
                    'type' => 'danger',
                    'message' => 'You can\'t put the same name',
                ];
            }
        } else {
            $response = [
                'type' => 'danger',
                'message' => 'The "from" and "to" fields cannot have the same value',
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


    public function checkFromName($travels)
    {
        if (Voyage::where("from", $travels)->count() > 0) {
            return false;
        } else {
            return true;
        }
    }
}
