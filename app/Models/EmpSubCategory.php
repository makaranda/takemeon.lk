<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpSubCategory extends Model
{
    use HasFactory;
    protected $table = 'emp_sub_categories';

    protected $fillable = [
        'name',
        'slug',
        'order',
        'status',
    ];
}
