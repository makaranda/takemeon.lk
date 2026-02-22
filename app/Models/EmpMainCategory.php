<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpMainCategory extends Model
{
    use HasFactory;
    protected $table = 'emp_main_categories';

    protected $fillable = [
        'name',
        'order',
        'slug',
        'status',
    ];
}
