<?php


namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Property;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function create()
    {
        $properties = Property::all(); // Fetch all properties
        return view('units.create', compact('properties'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'property_id' => 'required|exists:properties,id',
        ]);

        Unit::create($request->only(['name', 'property_id']));

        return redirect()->route('units.create')->with('success', 'Unit added successfully.');
    }


    public function index()
    {
        $units = Unit::with('property')->get(); // Retrieve all units
        return view('units.index', compact('units')); // Pass units to the view
    }
}
