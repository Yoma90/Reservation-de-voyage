<?php

namespace App\Http\Controllers;

use App\Models\Mobile_users;
use App\Helper\UserService;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function listUser(){
        $customers = Customer::get();

        return view('dashboard')->with('customers', $customers);
    }

    public function listUsers(){
        $customers = Customer::get();

        return view('laravel-examples.customer-management')->with('customers', $customers);
    }

    public function changeUserStatus($id, $status)
    {


        $response = [
            "type" => "",
            "message" => "",
        ];
        $customer = Customer::find($id);
        if ($customer) {
            $customer->status = $status;
            $customer->save();

            if ($status === "active") {
                $response = [
                    "type" => "success",
                    "message" => "Customer activated successfully",
                ];
            } else {
                $response = [
                    "type" => "success",
                    "message" => "Customer suspended successfully",
                ];
            }
        } else {
            $response = [
                "type" => "danger",
                "message" => "This Customer doesn't exist",
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

    public function register(Request $request){
        $response = (new UserService($request->first_name, $request->last_name, $request->user_name, $request->email, $request->password))->register($request->devicename);
        return response()->json($response);
    }

    public function login(Request $request){

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return Mobile_users::all();
    }

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
    public function show(Customer $mobile_users)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $mobile_users)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $mobile_users)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $mobile_users)
    {
        //
    }

    
}
