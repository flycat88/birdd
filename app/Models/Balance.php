<?php


namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    protected $fillable = [
        'tenant_id',
        'rent',
        'balance',
        'carry_forward',
        'house_number',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }


}
