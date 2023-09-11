<?php

namespace App\Http\Controllers;

use Bus;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function index()
    {
        return Bus::all();
    }

    public function store(Request $request)
    {
        return Bus::create($request->all());
    }

    public function show($id)
    {
        return Bus::find($id);
    }

    public function update(Request $request, $id)
    {
        $bus = Bus::find($id);
        $bus->update($request->all());
        return $bus;
    }

    public function destroy($id)
    {
        $bus = Bus::find($id);
        $bus->delete();
        return ['message' => 'Bus deleted successfully'];
    }
}
