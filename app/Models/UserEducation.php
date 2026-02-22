<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEducation extends Model
{
    use HasFactory;

    protected $table = 'user_educations';

    protected $fillable = [
        'user_id',
        'highest_education_level',
        'educational_specialization',
        'institute_university',
    ];

    // Relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
