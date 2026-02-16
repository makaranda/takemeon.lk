<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $table = 'settings';
    protected $fillable = [
        'main_logo','page_banner', 'footer_logo', 'fevicon_logo', 'contact_number','contact_number2', 'email_address',
        'address', 'google_map', 'social_facebook','special_offer', 'social_twitter','social_linkedin',
        'social_youtube', 'social_instagram', 'footer_content','seo_keywords','seo_description','status'
    ];
}
