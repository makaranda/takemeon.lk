<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSocialLink extends Model
{
    use HasFactory;
    
    protected $table = 'user_social_links';

    protected $fillable = [
        'user_id',
        'facebook_link',
        'linkedin_link',
        'github_link',
        'instagrame_link',
        'twitter_link',
    ];

    /**
     * Relationship: Social links belong to a user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
