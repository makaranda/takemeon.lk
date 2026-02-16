<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $table = 'districts';

    protected $fillable = [
        'province_id',
        'name',
        'slug',
        'order',
        'status',
    ];

        // A district belongs to a province
    public function province()
    {
        return $this->belongsTo(Province::class);
    }
}
