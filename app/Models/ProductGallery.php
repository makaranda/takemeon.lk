<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductGallery extends Model
{
    use HasFactory;
    protected $table = 'product_gallery';
    protected $fillable = [
        'product_id', 'feature_image', 'link', 'video_image', 'video',
        'order', 'status', 'author_id'
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
