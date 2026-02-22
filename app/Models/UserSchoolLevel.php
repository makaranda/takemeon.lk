<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSchoolLevel extends Model
{
    use HasFactory;

    protected $table = 'user_school_levels';
    protected $fillable = [
        'user_id',
        'ol_school',
        'ol_year',
        'al_school',
        'al_year',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
