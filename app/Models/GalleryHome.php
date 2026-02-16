<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryHome extends Model
{
    use HasFactory;
    protected $table = 'gallery_home';

    protected $fillable = ['title', 'image_name','order','status'];
}
