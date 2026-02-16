<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoTrack extends Model
{
    use HasFactory;
    protected $table = 'video_tracks';
    protected $fillable = ['title', 'sub_title', 'video', 'video_image', 'order', 'status'];
}
