<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;
    protected $table = 'links';

    protected $fillable = [
        'page_id',
        'name',
        'file_name',
        'link',
        'icon',
        'image',
        'type',
        'order',
        'status',
    ];
}
