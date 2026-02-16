<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MusicBeat extends Model
{
    use HasFactory;
    protected $table = 'music_beats';
    protected $fillable = ['title', 'audio', 'track_image', 'order', 'status'];
}
