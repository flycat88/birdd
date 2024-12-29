<?php

namespace App\Http\Controllers;

use App\Models\Receipt;
use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Models\Balance;
use App\Models\Tenant;


class ReceiptController extends Controller
{
    // Display the list of receipts
    public function index()
    {

        {
            $receipts = Receipt::with('invoice.tenant')->get(); // This will fetch tenants through invoices

            return view('receipts.index', compact('receipts'));
        }

    }




    public function create()
    {
        $invoices = Invoice::all();
    $tenants = Tenant::all(); // Pass tenants to the view
    return view('receipts.create', compact('invoices', 'tenants'));
    }

    // Store a new receipt



   public function store(Request $request)
{
    $request->validate([
        'invoice_id' => 'required|exists:invoices,id',
        'tenant_id' => 'required|exists:tenants,id',
        'receipt_date' => 'required|date',
        'amount_paid' => 'required|numeric|min:0',
        'payment_method' => 'required|string',
        'tenant_id' => 'required|exists:tenants,id',
    ]);

    // Create the receipt
    $receipt = Receipt::create([
        'invoice_id' => $request->invoice_id,
        'tenant_id' => $request->tenant_id,
        'receipt_date' => $request->receipt_date,
        'amount_paid' => $request->amount_paid,
        'payment_method' => $request->payment_method,
        'reference_number' => $request->reference_number,
    ]);

    // Fetch the associated invoice and tenant
    $invoice = Invoice::findOrFail($request->invoice_id);
    $tenant = $invoice->tenant;

    // Calculate total invoiced amount and total paid (including new receipt)
    $totalInvoiced = $tenant->invoices->sum('total_amount');
    $totalPaid = $tenant->invoices->sum(function($invoice) {
        return $invoice->receipts->sum('amount_paid');
    });

    // Update the tenant's balance (total invoiced - total paid)
    $balance = $totalInvoiced - $totalPaid;
    if (is_null($tenant->house_number)) {
        return redirect()->back()->withErrors(['house_number' => 'House number is required for the tenant.']);
    }
    // Update or create balance entry for the tenant
    Balance::updateOrCreate(
        ['tenant_id' => $tenant->id],
        [
            'rent' => $tenant->rent,
            'balance' => $balance,
            'house_number' => $tenant->house_number,
        ]
    );

    return redirect()->route('receipts.index')->with('success', 'Receipt added and balance updated successfully.');
}


public function destroy($id)
{
    $receipt = Receipt::findOrFail($id); // Find the receipt by ID
    $receipt->delete(); // Delete the receipt

    return redirect()->route('receipts.index')->with('success', 'Receipt deleted successfully.');
}

public function edit($id)
{
    $receipt = Receipt::findOrFail($id); // Find the receipt by ID
    return view('receipts.edit', compact('receipt')); // Pass the receipt to the edit view
}
public function update(Request $request, $id)
{
    $request->validate([
        'amount_paid' => 'required|numeric',
        'payment_method' => 'required|string',
        'reference_number' => 'required|string',
    ]);

    $receipt = Receipt::findOrFail($id);
    $receipt->update($request->all());

    return redirect()->route('receipts.index')->with('success', 'Receipt updated successfully.');
}


}
