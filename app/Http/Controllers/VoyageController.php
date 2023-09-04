<?php

namespace App\Http\Controllers;

use App\Models\Voyage;
use Illuminate\Http\Request;

class VoyageController extends Controller
{

    public function __construct(){
        $this->middleware("auth:sanctum", ["except" => ["index", "show"]]);
    }




    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $voyages = Voyage::all();
        return response()->json([
            "success" => true,
            "voyages" => $voyages,
        ]);
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
        $request -> validate([
            "name" => "required",
            "location" => "required",
            "details" => "required",
            "price" => "required",
        ]);

        $voyage = Voyage::create([
            "name" => $request->name,
            "location" => $request->location,
            "details" => $request->details,
            "price" => $request->price,
        ]);

        return response()->json([
            "success" => true,
            "voyage" => $voyage,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $voyage = Voyage::find($id);
        return response()->json([
            "success" => true,
            "voyage" => $voyage,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Voyage $voyage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Voyage::find($id);

        $product -> update($request->all());

        return response()->json([
            "success" => true,
            "product" => $product,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Voyage::find($id)->delete();

        return response()->json([
            "success" => true,
            "message" => "The trip has been deleted successfully !",
        ]);
    }
}
