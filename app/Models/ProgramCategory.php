<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProgramCategory extends Model
{
    use HasFactory;
    protected $table = 'program_categories';
    protected $fillable = ['name','slug', 'status'];

    public function subCategories(): HasMany
    {
        return $this->hasMany(ProgramSubCategory::class, 'category_id');
    }
}
