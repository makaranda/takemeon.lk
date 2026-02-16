<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProgramSubCategory extends Model
{
    use HasFactory;
    protected $fillable = ['category_id','name','slug','status'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProgramCategory::class, 'category_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(ProgramSubCategoryItem::class, 'sub_category_id');
    }
}
