<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingBooking extends Model
{
    use HasFactory;
    protected $table = 'training_bookings';

    protected $fillable = [
        'user_id',
        'training_date',
        'start_time',
        'end_time',
        'status'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
