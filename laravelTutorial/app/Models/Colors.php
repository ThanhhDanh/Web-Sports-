<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colors extends Model
{
    use HasFactory;

    protected $table = 'colors';

    public $fillable = [
        'name',
        'code'
    ];

    public function products()
    {
        return $this->belongsToMany(Products::class, 'product_color');
    }
}
