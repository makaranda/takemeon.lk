<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpDesignation extends Model
{
    use HasFactory;
    protected $table = 'emp_designations';

    protected $fillable = [
        'name',
        'slug',
        'order',
        'status',
    ];

    public function industry()
    {
        return $this->belongsTo(EmpIndustry::class, 'industry_id');
    }
}
