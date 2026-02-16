<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProgramSubCategoryItem extends Model
{
    use HasFactory;

    protected $fillable = ['sub_category_id', 'name','slug','status','image'];

    public function subCategory(): BelongsTo
    {
        return $this->belongsTo(ProgramSubCategory::class, 'sub_category_id');
    }
}
