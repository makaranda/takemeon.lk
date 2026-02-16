<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainSlider extends Model
{
    use HasFactory;
    protected $table = 'main_slider';
    protected $fillable = ['banner','icon', 'heading', 'sub_heading','description','switch', 'music_area_switch'];
}
