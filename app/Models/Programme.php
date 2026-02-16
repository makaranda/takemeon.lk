<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programme extends Model
{
    use HasFactory;
    protected $table = 'programmes';
    protected $fillable = [
        'title',
        'description',
        'sub_description',
        'feature_image',
        'category',
        'sub_category',
        'slug',
        'parent',
        'route_name',
        'seo_keywords',
        'seo_description',
        'order',
        'status',
        'author_id',
    ];

    public function according()
    {
        return $this->belongsTo(According::class, 'id', 'page_id');
    }

    public function visitors()
    {
        return $this->hasMany(VisitorsCount::class, 'page_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id'); // Adjust 'author_id' if necessary
    }
}
