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
        $invoices = Invoice::with('tenant')->get(); // Fetch all invoices with their associated tenant
        return view('invoices.index', compact('invoices'));
    }

    public function create()
{
    $tenants = Tenant::all(); // Fetch all tenants to associate with the invoice
    return view('invoices.create', compact('tenants'));
}
public function store(Request $request)
{
    $request->validate([
        'tenant_id' => 'required|exists:tenants,id',
        // 'invoice_number' => 'required|unique:invoices,invoice_number',
        'invoice_date' => 'required|date',
        'due_date' => 'required|date|after_or_equal:invoice_date',
        'total_amount' => 'required|numeric|min:0',
        'paid_amount' => 'nullable|numeric|min:0',
        'status' => 'required|in:pending,paid,canceled',
    ]);
    $latestInvoice = Invoice::orderBy('id', 'desc')->first();
    $invoiceNumber = $latestInvoice ? 'INV-' . str_pad($latestInvoice->id + 1, 3, '0', STR_PAD_LEFT) : 'INV-000001';


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
    $invoice->update($request->all());

    return redirect()->route('invoices.index')->with('success', 'Invoice updated successfully');
}public function show($id)
{
    // Fetch the invoice by ID
    $invoice = Invoice::with('tenant')->findOrFail($id); // Load the invoice with its associated tenant

    // Pass the invoice data to the view
    return view('invoices.show', compact('invoice'));
}




}
