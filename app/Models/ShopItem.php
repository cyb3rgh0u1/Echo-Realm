<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ShopItem extends Model {
    protected $table = 'shop_items';
    protected $fillable = ['name','slug','description','image','price','original_price','type','rarity','stock','is_featured','is_active','includes','preview_images'];
    protected $casts = ['price' => 'float', 'original_price' => 'float', 'is_featured' => 'boolean', 'is_active' => 'boolean', 'includes' => 'array', 'preview_images' => 'array'];
    public function getDiscountPercentAttribute(): ?int {
        if ($this->original_price && $this->original_price > $this->price) {
            return round((1 - $this->price / $this->original_price) * 100);
        }
        return null;
    }
    public function orderItems() { return $this->hasMany(OrderItem::class); }
}
