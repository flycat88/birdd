<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Unit extends Model
{
    protected $fillable = ['name', 'property_id','occupancy_status'];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function tenant()
    {

        return $this->belongsTo(Tenant::class); // A unit belongs to one tenant
    }

  // In the Unit Model
public function setOccupancyStatusAttribute()
{
    // If tenant_id is set, it's occupied; otherwise, vacant
    $this->attributes['occupancy_status'] = $this->tenant_id ? 1 : 0;
}

    public function scopeVacant($query)
    {
        return $query->where('occupancy_status', false);
    }
}
