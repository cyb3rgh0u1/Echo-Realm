<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Order extends Model {
    protected $fillable = ['order_number','user_id','total','status','payment_method','payment_id','billing_info','notes'];
    protected $casts = ['total' => 'float', 'billing_info' => 'array'];
    public function user() { return $this->belongsTo(User::class); }
    public function items() { return $this->hasMany(OrderItem::class); }
    public static function generateNumber(): string {
        return 'ER-' . strtoupper(substr(md5(uniqid()), 0, 8));
    }
}
