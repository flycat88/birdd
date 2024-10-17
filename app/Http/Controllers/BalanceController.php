<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use App\Models\Tenant;
use App\Models\Invoice;
use Illuminate\Http\Request;

class BalanceController extends Controller
{
    // Display the list of balances
    public function index()
    {
        // Fetch all tenants with their invoices and the receipts associated with those invoices
        $tenants = Tenant::with(['invoices.receipts'])->get();

        $balances = [];

        foreach ($tenants as $tenant) {
            // Calculate total invoiced amount
            $totalInvoiced = $tenant->invoices->sum('total_amount');

            // Calculate total paid amount (sum of all receipts for each invoice)
            $totalPaid = 0;
            foreach ($tenant->invoices as $invoice) {
                $totalPaid += $invoice->receipts->sum('amount_paid');
            }

            // Calculate the balance (invoiced - paid)
            $balance = $totalInvoiced - $totalPaid;

            // Add this tenant's balance data to the array
            $balances[] = [
                'tenant' => $tenant,
                'rent' => $tenant->rent, // Assuming rent is part of Tenant model
                'carry_forward' => $balance < 0 ? abs($balance) : 0, // Negative balance carried forward
                'balance' => $balance, // Final balance after payment
                'house_number' => $tenant->house_number, // Assuming this is part of the Tenant model
            ];
        }

        // Pass the balances data to the view
        return view('balances.index', compact('balances'));
    }



    // Calculate and update balances based on invoices
    public function calculateBalances()
    {
        // Fetch all tenants along with their invoices and receipts
        $tenants = Tenant::with(['invoices', 'receipts'])->get();

        foreach ($tenants as $tenant) {
            // Calculate total invoiced amounts
            $totalInvoiced = $tenant->invoices->sum('total_amount');

            // Calculate total paid amounts from receipts
            $totalPaid = $tenant->receipts->sum('amount_paid');

            // Calculate balance
            $balance = $totalInvoiced - $totalPaid;

            // Ensure house_number is not null
if (is_null($tenant->house_number)) {
    return redirect()->back()->withErrors(['house_number' => 'House number is required.']);
}


            // Update or create a balance record for the tenant
            Balance::updateOrCreate(
                ['tenant_id' => $tenant->id],
                [
                    'rent' => $tenant->rent,
                    'balance' => $balance,
                    'carry_forward' => $balance < 0 ? abs($balance) : 0,
                    'house_number' => $tenant->house_number,
                ]
            );
        }

        return redirect()->route('balances.index')->with('success', 'Balances calculated and updated successfully.');
    }

}
