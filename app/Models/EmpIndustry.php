<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpIndustry extends Model
{
    use HasFactory;
    protected $table = 'emp_industries';

    protected $fillable = [
        'name',
        'slug',
        'order',
        'status',
    ];

    public function designations()
    {
        return $this->hasMany(EmpDesignation::class, 'industry_id');
    }   
}
