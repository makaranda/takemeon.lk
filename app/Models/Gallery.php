<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $table = 'galleries';

    protected $fillable = [
        'title',
        'description',
        'sub_description',
        'feature_image',
        'banner_image',
        'slug',
        'route_name',
        'year',
        'seo_keywords',
        'seo_description',
        'order',
        'status',
        'author_id',
    ];

        /* Relationships */
    public function items()
    {
        return $this->hasMany(GalleryItem::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
    
      // Relationship: A page has many visitor counts
    public function visitors()
    {
        return $this->hasMany(VisitorsCount::class, 'page_id');
    }
}
