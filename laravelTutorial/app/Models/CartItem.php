<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $table = 'cart_items';

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'discount_id',
        'size_id',
        'color_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Products::class);
    }

    public function discount()
    {
        return $this->belongsTo(Discounts::class);
    }

    public function size()
    {
        return $this->belongsTo(Sizes::class);
    }

    public function color()
    {
        return $this->belongsTo(Colors::class);
    }
}
