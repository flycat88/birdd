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
        return $this->belongsTo(Unit::class);
    }

    public function invoices()

{
    return $this->hasMany(Invoice::class);
}

public function receipts()
    {
        return $this->hasMany(Receipt::class);
    }
    public function bills()
    {
        return $this->hasMany(Bill::class);
    }

    public function property()
    {
        return $this->belongsTo(Property::class); // A tenant belongs to one property
    }

    protected static function booted()
    {
        static::created(function ($tenant) {
            $tenant->unit->update(['occupancy_status' => true]); // Mark unit as occupied
        });

        static::deleted(function ($tenant) {
            $tenant->unit->update(['occupancy_status' => false]); // Mark unit as vacant
        });
}


}