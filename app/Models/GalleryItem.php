<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryItem extends Model
{
    use HasFactory;

    protected $table = 'gallery_items';
    protected $fillable = [
        'gallery_id',
        'feature_image',
        'link',
        'video_image',
        'video',
        'route_name',
        'order',
        'status',
        'author_id',
    ];

    /* Relationships */
    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
    
}
