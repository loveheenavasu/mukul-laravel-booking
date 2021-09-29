<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    protected $fillable=['slider_image','slider_title','slider_button_text','slider_button_link','hotel_id'];
    protected $table = 'slider';
}
