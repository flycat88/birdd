<?php




namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tenant;
use App\Models\Unit;
use App\Models\Property;

class TenantController extends Controller
{
    public function index()
    {
        $tenants = Tenant::with('unit')->get(); // Eager load the unit relationship
        return view('tenants.index', compact('tenants'));


    $tenants = Tenant::with('invoices')->get();
    return view('balances.index', compact('tenants'));

}
    public function create()
    {
        $properties = Property::all(); // Fetch all properties
        $units = Unit::whereNull('tenant_id')->get();
        return view('tenants.create', compact('properties', 'units')); // Pass both to the view
    }
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'rent' => 'required|numeric',
            'balance' => 'nullable|numeric',
            'phone_number' => 'required|string|max:15',
            'unit_id' => 'required|exists:units,id', // Ensure the unit exists
        ]);
    
        // Create the tenant
        $tenant = Tenant::create($request->only(['name', 'rent', 'balance', 'phone_number', 'unit_id']));
    
        // Now, update the unit's tenant_id and occupancy_status
        $unit = Unit::find($request->unit_id); // Find the unit by unit_id
        if ($unit) {
            $unit->tenant_id = $tenant->id; // Set the tenant_id on the unit
            $unit->occupancy_status = 1; // Mark it as occupied
            $unit->save(); // Save the updated unit
        }
    
        // Redirect to the tenant list or another page
        return redirect()->route('tenants.index')->with('success', 'Tenant added and unit marked as occupied.');
    }
    
    
    

    public function update(Request $request, $id)
{
    // Validate the incoming request data
    $request->validate([
        'name' => 'required|string|max:255',
        'rent' => 'required|numeric',
        'balance' => 'required|numeric',
        'phone_number' => 'required|string|max:15',
        'unit_id' => 'required|exists:units,id',
    ]);

    // Find the tenant by ID
    $tenant = Tenant::find($id);

    // Check if tenant exists
    if (!$tenant) {
        return redirect()->route('tenants.index')->with('error', 'Tenant not found.');
    }

    // Update tenant information
    $tenant->update($request->all());

    // Redirect to the tenant's show page
    return redirect()->route('tenants.index', $tenant->id)->with('success', 'Tenant updated successfully.');
}


public function edit($id)
{
    $tenant = Tenant::find($id);

    if (!$tenant) {
        return redirect()->route('tenants.index')->with('error', 'Tenant not found.');
    }

    // Fetch all units
    $units = Unit::all();

    // Return the edit view with the tenant and units data
    return view('tenants.edit', compact('tenant', 'units'));
}
    public function destroy($id)
    {
        $tenant = Tenant::findOrFail($id);

        $unit = $tenant->unit; // Assuming Tenant has a 'unit' relationship
        $unit->occupancy_status = false; // Set occupancy status back to vacant
        $unit->save(); // Save the updated unit
        $tenant->delete();

        return redirect()->route('tenants.index')->with('success', 'Tenant deleted successfully');
    }

    public function show($id)
    {
        // Find the tenant by ID
        $tenant = Tenant::find($id);

        // Check if tenant exists
        if (!$tenant) {
            return redirect()->route('tenants.index')->with('error', 'Tenant not found.');
        }

        // Return the view with the tenant data
        return view('tenants.show', compact('tenant'));
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function getBalanceAttribute()
    {
        $totalInvoiced = $this->invoices()->sum('total_amount');
        $totalPaid = $this->invoices()->sum('paid_amount');

        return $totalInvoiced - $totalPaid;
    }

    public function getCarryForwardAttribute()
    {
        return $this->balance; // You can adjust this if your logic for carry forward is different
    }

    // Get total balance (if there are any additional calculations, include them here)
    public function getTotalBalanceAttribute()
    {
        return $this->balance; // Adjust if needed for any additional calculations
    }

    public function getVacantUnits($propertyId)
{
    // Fetch only vacant units for the selected property (tenant_id is null)
    $units = Unit::where('property_id', $propertyId)
                 ->whereNull('tenant_id')  // Only fetch units that have no tenant assigned
                 ->get();

    // Return the units as a JSON response
    return response()->json($units);
}



}
