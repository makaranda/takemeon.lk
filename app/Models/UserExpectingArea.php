<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserExpectingArea extends Model
{
    use HasFactory;

    protected $table = 'user_expecting_areas';

    protected $fillable = [
        'user_id',
        'job_industry',
        'job_type',
        'job_role',
        'designation',
        'expected_salary',
    ];

    protected $casts = [
        'expected_salary' => 'decimal:2',
    ];

    /**
     * Relationship: Expecting area belongs to a user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
