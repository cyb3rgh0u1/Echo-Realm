<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Character extends Model {
    protected $fillable = ['name','slug','title','bio','lore','image','portrait','splash_art','element_id','rarity','role','faction','weapon_type','stats','abilities','voice_lines','is_featured','is_playable','is_published','sort_order'];
    protected $casts = ['stats' => 'array', 'abilities' => 'array', 'voice_lines' => 'array', 'is_featured' => 'boolean', 'is_playable' => 'boolean', 'is_published' => 'boolean'];
    public function element() { return $this->belongsTo(Element::class); }
    public function getRarityColorAttribute(): string {
        return match($this->rarity) {
            'legendary' => '#f59e0b', 'epic' => '#a855f7', 'rare' => '#3b82f6', 'uncommon' => '#10b981', default => '#6b7280'
        };
    }
}
