<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Models\Invoice;

class BillController extends Controller
{
    public function create()
    {
        // Assuming you want to create a bill for a specific tenant
        $tenants = Tenant::all(); // Fetch all tenants
        return view('bills.create', compact('tenants'));
    }

    public function store(Request $request)
    {
        // Validate and store the bill data
        $validated = $request->validate([
            'tenant_id' => 'required|exists:tenants,id', // Validate tenant exists
            'name_of_bill' => 'required|string|max:255', // Validate name of bill (added validation rule)
            'bill_amount' => 'required|numeric', // Validate bill amount is numeric
            'bill_date' => 'required|date', // Validate bill date is a valid date
        ]);

        // Store the bill (assuming you have a Bill model)
        Bill::create([
            'tenant_id' => $validated['tenant_id'],
            'name_of_bill' => $validated['name_of_bill'], // Store the name of bill
            'bill_amount' => $validated['bill_amount'],
            'bill_date' => $validated['bill_date'],
        ]);

        return redirect()->route('invoices.create')->with('success', 'Bill added successfully!');
    }
}
