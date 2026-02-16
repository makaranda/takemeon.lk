<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use Notifiable,HasFactory;

    protected $table = 'pages';
    protected $casts = [
        'attributes' => 'array',
    ];
    protected $fillable = [
        'title',
        'description',
        'sub_description',
        'feature_image',
        'banner_image',
        'type', // Added type field
        'link',
        'video_image',
        'author_id', // Added author_id field
        'video',
        'attributes', // Added attributes field
        'slug',
        'route_name',
        'seo_keywords',
        'seo_description',
        'order',
        'parent',
        'status',
    ];

    // Relationship: A page has many visitor counts
    public function visitors()
    {
        return $this->hasMany(VisitorsCount::class, 'page_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id'); // Adjust 'author_id' if necessary
    }
}
