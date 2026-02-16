<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MusicTrack extends Model
{
    use HasFactory;
    protected $table = 'music_tracks';
    protected $fillable = ['track_code','title','author_id', 'sub_title','description','link','track', 'track_image', 'type','price','qty','order', 'status'];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

}
