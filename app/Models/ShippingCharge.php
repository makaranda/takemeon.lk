<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingCharge extends Model
{
    use HasFactory;
    protected $table = 'shipping_charges';
    protected $fillable = ['district_id', 'charge'];

    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
