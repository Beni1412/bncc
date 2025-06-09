<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasUuids;

    protected $fillable = [
        'name',
        'email',
        'password',
        'money',
        'is_admin'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
        ];
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // Check if user is admin
    public function isAdmin()
    {
        return $this->is_admin;
    }

    // Format money for display
    public function getFormattedMoneyAttribute()
    {
        return 'Rp ' . number_format($this->money, 0, ',', '.');
    }

    // Check if user has enough money
    public function hasEnoughMoney($amount)
    {
        return $this->money >= $amount;
    }

    // Deduct money from user
    public function deductMoney($amount)
    {
        if ($this->hasEnoughMoney($amount)) {
            $this->decrement('money', $amount);
            return true;
        }
        return false;
    }
}