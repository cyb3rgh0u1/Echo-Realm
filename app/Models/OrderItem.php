<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model {
    protected $fillable = ['order_id','shop_item_id','quantity','price'];
    protected $casts = ['price' => 'float'];
    public function order() { return $this->belongsTo(Order::class); }
    public function shopItem() { return $this->belongsTo(ShopItem::class); }
}
