<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'blogs';
    protected $fillable = [
        'title',
        'description',
        'sub_description',
        'category_id',
        'tags',
        'feature_image',
        'blog_type',
        'slug',
        'route_name',
        'seo_keywords',
        'seo_description',
        'order',
        'status',
        'author_id',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function category()
    {
        return $this->belongsTo(EmpIndustry::class, 'category_id');
    }

}
