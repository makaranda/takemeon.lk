<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPastEmployment extends Model
{
    use HasFactory;

    protected $table = 'user_past_employments';

    protected $fillable = [
        'user_id',
        'company_name',
        'role',
        'employee_category',
        'industry',
        'start_date',
        'end_date',
        'about_role',
    ];

    /**
     * Relationship: Employment belongs to User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
