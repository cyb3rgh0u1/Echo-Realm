<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class LoreEntry extends Model {
    protected $table = 'lore_entries';
    protected $fillable = ['title','slug','excerpt','content','cover_image','category','tags','classification','is_published','read_time','sort_order'];
    protected $casts = ['tags' => 'array', 'is_published' => 'boolean'];
}
