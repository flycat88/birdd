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
            // 'occupancy_status' => 'required|boolean', // Validate occupancy status

        ]);

        Unit::create($request->only(['name', 'property_id',
    
    
    
    ]));

        return redirect()->route('units.index')->with('success', 'Unit added successfully.');
    
    
    }


    public function index()
    {
        $units = Unit::with(['tenant', 'property'])->get(); // Fetch units with tenant and property details
        return view('units.index', compact('units')); // Pass the units data to the view
    }

    public function destroy($id)
{
    $unit = Unit::findOrFail($id);
    $unit->delete();

    return redirect()->route('units.index')->with('success', 'Unit deleted successfully');
}
public function getOccupancyData()
{
    // Group units by occupancy status (0 = Vacant, 1 = Occupied)
    $occupancyData = Unit::selectRaw('occupancy_status, COUNT(*) as count')
                         ->groupBy('occupancy_status')
                         ->get();

    // Prepare occupancy counts for occupied and vacant units
    $data = [
        'occupied' => $occupancyData->where('occupancy_status', 1)->first()->count ?? 0,
        'vacant' => $occupancyData->where('occupancy_status', 0)->first()->count ?? 0,
    ];

    return $data;  // Directly return the data to be used in views
}


    // Example of how to pass occupancy data to a view
    public function dashboard()
    {
        // Fetch occupancy data
        $occupancyData = $this->getOccupancyData();  // Now returns the data array
        // dd($occupancyData);
        return view('dashboard', compact('occupancyData'));  // Pass data to the view
    }
    
}



