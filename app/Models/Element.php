<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Element extends Model {
    protected $fillable = ['name', 'slug', 'description', 'icon', 'color', 'glow_color', 'symbol'];
    public function characters() { return $this->hasMany(Character::class); }
}
