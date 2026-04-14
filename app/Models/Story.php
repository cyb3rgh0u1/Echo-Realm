<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Story extends Model {
    protected $fillable = ['title','slug','synopsis','content','cover_image','banner_image','arc_number','chapter_number','status','is_published','sort_order'];
    protected $casts = ['is_published' => 'boolean'];
}
