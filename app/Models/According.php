<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class According extends Model
{
    use HasFactory;
    protected $table = 'accordings';

    protected $fillable = [
        'page_id',
        'topic',
        'sub_topic',
        'type',
        'section',
        'description',
        'order',
        'status',
    ];
}
