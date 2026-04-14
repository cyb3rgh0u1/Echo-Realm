<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class TimelineEvent extends Model {
    protected $table = 'timeline_events';
    protected $fillable = ['title','slug','description','details','era','year_in_lore','icon','color','type','is_published','sort_order'];
    protected $casts = ['is_published' => 'boolean'];
}
