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

    public function edit($id)
{
    $property = Property::findOrFail($id);
    return view('properties.edit', compact('property'));
}

public function update(Request $request, $id)
{
    $property = Property::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'description' => 'nullable|string',
    ]);

    $property->update($request->all());

    return redirect()->route('properties.index')->with('success', 'Property updated successfully');
}
public function destroy($id)
{
    $property = Property::findOrFail($id);
    $property->delete();

    return redirect()->route('properties.index')->with('success', 'Property deleted successfully');
}



}
