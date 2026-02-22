<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfessionalDetail extends Model
{
    use HasFactory;
    protected $table = 'user_professional_details';

    protected $fillable = [
        'user_id',
        'total_years_experience',
        'skills_summary',
        'about_yourself',
        'current_employer',
        'current_industry',
        'current_business_function',
        'designation',
        'started_in',
        'notice_period_days',
        'about_current_role',
        'current_salary',
        'cv_file',
        'nic_front',
        'nic_back',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
