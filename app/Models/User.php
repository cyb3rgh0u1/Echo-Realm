<?php
// app/Models/User.php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable {
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = ['name', 'username', 'email', 'password', 'avatar', 'role', 'is_banned', 'ban_reason', 'last_login_at'];
    protected $hidden = ['password', 'remember_token'];
    protected $casts = ['email_verified_at' => 'datetime', 'password' => 'hashed', 'is_banned' => 'boolean', 'last_login_at' => 'datetime'];
    public function isAdmin(): bool { return $this->role === 'admin'; }
    public function orders() { return $this->hasMany(Order::class); }
}
