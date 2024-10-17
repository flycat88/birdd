<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;
    protected $fillable = [
       'name',
       'house_no',
       'rent',
       'balance',
       'phone_number',
       'unit_id'
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function invoices()
{
    return $this->hasMany(Invoice::class);
}

public function receipts()
    {
        return $this->hasMany(Receipt::class);
    }
}


