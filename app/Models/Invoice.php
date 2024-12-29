<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'tenant_id',
        'invoice_number',
        'invoice_date',
        'due_date',
        'total_amount',
        'paid_amount',
        'status',
    ];
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
    public function receipts()
    {
        return $this->hasMany(Receipt::class);
    }
    public function bills()
    {
        return $this->hasMany(Bill::class);
    }
}
