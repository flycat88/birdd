<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Tenant;
use App\Models\balances;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with('tenant','bills')->get(); // Fetch all invoices with their associated tenant
        foreach ($invoices as $invoice) {
            $invoice->total_bill_amount = $invoice->bills->sum('bill_amount');
        }
        
        return view('invoices.index', compact('invoices'));


    }

    public function create()
{
    $tenants = Tenant::all(); // Fetch all tenants to associate with the invoice
    $tenant_id = session('tenant_id'); // Fetch tenant_id from session
    $total_amount = session('total_amount', 0); // Default total_amount is 0 if not in session

    // Return the view with the tenants, tenant_id, and total_amount
    return view('invoices.create', compact('tenants', 'tenant_id', 'total_amount'));


}


public function store(Request $request)
{
    try {

        // $request->validate([
        //     'tenant_id' => 'required|exists:tenants',
        //     'invoice_number' => 'unique:invoices,invoice_number',
        //     'invoice_date' => 'required|date',
        //     'due_date' => 'required|date|after_or_equal:invoice_date',
        //     'total_amount' => 'required|numeric|min:0',
        //     'paid_amount' => 'nullable|numeric|min:0',
        //     'status' => 'required|in:pending,paid,canceled',
        // ]);

        $request->validate([
            'tenant_id' => 'required',
            'invoice_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:invoice_date',
            'total_amount' => 'required|numeric|min:0',
            'paid_amount' => 'nullable|numeric|min:0',
            'status' => 'required|in:pending,paid,canceled',
        ]);


        // Generate the invoice number
        $latestInvoice = Invoice::orderBy('id', 'desc')->first();
        $invoiceNumber = $latestInvoice ? 'INV-' . str_pad($latestInvoice->id + 1, 3, '0', STR_PAD_LEFT) : 'INV-000001';

        print($invoiceNumber);

        // Create the invoice
        Invoice::create([
            'tenant_id' => $request->tenant_id,
            'invoice_number' => $invoiceNumber,
            'invoice_date' => $request->invoice_date,
            'due_date' => $request->due_date,
            'total_amount' => $request->total_amount,
            'paid_amount' => $request->paid_amount ?? 0,
            'status' => $request->status,
        ]);

        return redirect()->route('invoices.index')->with('success', 'Invoice created successfully.');

    } catch (\Exception $e) {
        // Log the error message
        \Log::error('Invoice creation failed: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Invoice creation failed. Please try again.');
    }
}

public function edit($id)
{
    $invoice = Invoice::findOrFail($id); // Fetch the invoice by ID
    $tenants = Tenant::all(); // Fetch all tenants if you need to display them in the form
    return view('invoices.edit', compact('invoice', 'tenants')); // Return the edit view with the invoice and tenants
}

public function update(Request $request, $id)
{
    $request->validate([
        'tenant_id' => 'required|exists:tenants,id',
        'invoice_date' => 'required|date',
        'due_date' => 'required|date',
        'total_amount' => 'required|numeric',
        'paid_amount' => 'nullable|numeric',
        'status' => 'required|string|in:pending,paid,canceled',
    ]);

    $invoice = Invoice::findOrFail($id);
    $invoice->update([
        'tenant_id' => $request->tenant_id,
        'invoice_date' => $request->invoice_date,
        'due_date' => $request->due_date,
        'total_amount' => $request->total_amount,
        'paid_amount' => $request->paid_amount ?? 0,
        'status' => $request->status,
    ]);

    return redirect()->route('invoices.index')->with('success', 'Invoice updated successfully');
}

    public function show($id)
    {
        // Fetch the invoice by ID
        $invoice = Invoice::with('tenant')->findOrFail($id); // Load the invoice with its associated tenant

        // Pass the invoice data to the view
        return view('invoices.show', compact('invoice'));
    }


    public function addBill($tenant_id)
    {
        // Fetch the tenant data for the specific tenant
        $tenant = Tenant::findOrFail($tenant_id);

        // Return the view to add a bill for the tenant
        return view('invoices.addBill', compact('tenant'));
    }

    // Store the bill in the database
    public function storeBill(Request $request, $tenant_id)
{
    // Validate the incoming request
    $validated = $request->validate([
        'description' => 'required|string|max:255',  // Bill description
        'amount' => 'required|numeric|min:0',        // Amount for the bill
        'bill_date' => 'required|date',              // Date of the bill
    ]);

    // Find the tenant
    $tenant = Tenant::findOrFail($tenant_id);

    // Create the bill for this tenant
    $bill = $tenant->bills()->create([
        'name_of_bill' => $validated['description'],  // Store bill description as name_of_bill
        'amount' => $validated['amount'],
        'bill_date' => $validated['bill_date'],
    ]);

    // Update the total amount in the session (add the bill amount)
    $currentTotal = session('total_amount', 0); // Default to 0 if no total_amount in session
    $updatedTotal = $currentTotal + $bill->amount;

    // Store the updated total amount in the session
    session([
        'tenant_id' => $tenant_id,
        'total_amount' => $updatedTotal,
    ]);

    // Redirect to the invoice creation page with updated total amount
    return redirect()->route('invoices.create');
}


}




