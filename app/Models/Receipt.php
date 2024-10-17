<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{


    use HasFactory;

    protected $fillable = [
        'invoice_id', 'receipt_date', 'amount_paid', 'payment_method', 'reference_number'
    ];
    protected $casts = [
        'receipt_date' => 'datetime', // Cast receipt_date to a Carbon instance
    ];

    public function index()
{
    $receipts = Receipt::with('tenant')->get();

    return view('receipts.index', compact('receipts'));
}

    // Define relationship with the Invoice model
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
