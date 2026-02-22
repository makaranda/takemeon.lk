<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistrictCity extends Model
{
    use HasFactory;

    protected $table = 'district_cities';

    protected $fillable = [
        'district_id',
        'name',
        'slug',
        'order',
        'status',
    ];

        // A district belongs to a province
    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
