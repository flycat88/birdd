<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = ['name', 'property_id'];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function tenants()
    {

        return $this->hasMany(Tenant::class);
    }



}
