<?php

namespace App\Http\Controllers;

use App\Helper\UserService;
use App\Models\Customer;
use App\Models\Histories;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    // UserController

    public function index()
    {
        $customers = Customer::get();

        $activeCustomers = $customers->filter(function ($customer) {
            return $customer->status == 'active';
        });
        $suspendedCustomers = $customers->filter(function ($customer) {
            return $customer->status == 'suspended';
        });

        return view('pages.customer-management')
            ->with('customers', $customers)
            ->with('activeCustomers', $activeCustomers)
            ->with('suspendedCustomers', $suspendedCustomers);
    }

    // public function index2()
    // {
    //     $customers = Customer::where('status', 'suspended')->get();
    //     Customer::suspended()->get();
    //     $customers = Customer::has('status')->get();

    //     $suspendedCustomers = $customers->filter(function ($customer) {
    //         return $customer->status == 'suspended';
    //     });

    //     return view('pages.customer-management', ['customers' => $customers, $suspendedCustomers]);
    // }


    public function listCustomer()
    {
        $customers = Customer::get();

        return view('dashboard')->with('customers', $customers);
    }

    public function listCustomers()
    {
        $customers = Customer::get();

        return view('pages.customer-management')->with('customers', $customers);
    }

    public function changeCustomerStatus($id, $status)
    {


        $response = [
            "type" => "",
            "message" => "",
        ];

        try {
            $customer = Customer::find($id);
            if ($customer) {
                $customer->status = $status;
                $customer->save();

                if ($status === "active") {
                    $response = [
                        "type" => "success",
                        "message" => "Customer activated successfully",
                    ];
                    $user_id = auth()->user()->id;
                    Histories::create([
                        'notification' => "activated $customer->type_id customer successfully ",
                        'type' => "change",
                        'user_id' => $user_id,
                    ]);
                } else {
                    $response = [
                        "type" => "success",
                        "message" => "Customer suspended successfully",
                    ];
                    $user_id = auth()->user()->id;
                    Histories::create([
                        'notification' => "suspended $customer->type_id customer successfully ",
                        'type' => "change",
                        'user_id' => $user_id,
                    ]);
                }
            } else {
                $response = [
                    "type" => "danger",
                    "message" => "This Customer doesn't exist",
                ];
            }
        } catch (\Throwable $th) {
            $response = [
                "type" => "danger",
                "message" => "Internal server error",
            ];
        }


        return redirect()->back()->with($response['type'], $response["message"]);
    }

    public function deleteUser($id)
    {

        try {
            $customer = Customer::find($id);
            $customer->delete();

            $response = [
                "type" => "success",
                "message" => "The customer has successfully deleted",
            ];
        } catch (\Throwable $th) {
            $response = [
                "type" => "danger",
                "message" => "internal server error",
            ];
        }


        return redirect()->back()->with($response['type'], $response['message']);
    }

    // public function register(Request $request)
    // {
    //     $response = (new UserService($request->first_name, $request->last_name, $request->user_name, $request->email, $request->password))->register($request->devicename);
    //     return response()->json($response);
    // }


}
