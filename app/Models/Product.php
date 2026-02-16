<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'product_code', 'title', 'description', 'sub_description', 'feature_image',
        'seo_keywords', 'seo_description', 'brand_id', 'category_id',
        'sub_category', 'size', 'color', 'qty', 'price', 'discount',
        'order', 'status', 'author_id'
    ];

    public function gallery()
    {
        return $this->hasMany(ProductGallery::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }
    public function sizes()
    {
        return $this->belongsTo(Size::class, 'size');
    }
    public function colors()
    {
        return $this->belongsTo(Color::class, 'color');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category');
    }
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
