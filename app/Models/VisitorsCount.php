<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorsCount extends Model
{
    use HasFactory;
    protected $table = 'visitors_counts';
    protected $fillable = [
        'route_name',
        'count',
        'mac_address',
        'ip_address',
    ];

    // Relationship: A visitor count belongs to a page
    public function page()
    {
        return $this->belongsTo(Page::class, 'page_id');
    }
}
