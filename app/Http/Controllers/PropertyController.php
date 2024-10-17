<?php

namespace App\Http\Controllers;
use App\Models\Property;
use App\Models\Unit;

use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function create()
    {
        return view('properties.create'); // Show the form
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            // Add any additional validation rules here
        ]);

        $property = new Property();
        $property->name = $request->name;
        $property->location = $request->location;
        // Set additional properties if needed
        $property->save();

        return redirect()->route('properties.create')->with('success', 'Property added successfully.');
    }

    public function index()
    {
        $properties = Property::all(); // Retrieve all properties
        return view('properties.index', compact('properties')); // Pass properties to the view
    }


    public function getUnits(Request $request, Property $property)
    {
        return $property->units;

    }



}
