<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    use HasFactory;

    protected $table = 'careers';

    protected $fillable = [
        'title',
        'description',
        'sub_description',
        'feature_image',
        'email',
        'whatsapp',
        'closing_date',
        'slug',
        'order',
        'status',
        'author_id',
    ];
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
