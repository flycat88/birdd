<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    // Define fillable fields to allow mass assignment
    protected $fillable = ['tenant_id', 'name_of_bill','bill_amount', 'bill_date'];

    // Optionally, add relationships if necessary
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

}
