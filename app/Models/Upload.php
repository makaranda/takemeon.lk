<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    use HasFactory;

    protected $table = 'uploads';
    protected $fillable = [
        'type', 'file_name','author_id','order','status'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id'); // Adjust 'author_id' if necessary
    }
}
