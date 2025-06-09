<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Comments extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'comments';

    public $fillable = [
        'rate_level',
        'description',
        'user_id',
        'product_id',
        'parent_id',
        'is_reply'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Products::class);
    }

    // Quan hệ cha (comment gốc)
    public function parent()
    {
        return $this->belongsTo(Comments::class, 'parent_id');
    }

    // Quan hệ replies (comment con)
    public function replies()
    {
        return $this->hasMany(Comments::class, 'parent_id');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(200)
            ->height(200)
            ->sharpen(10);
    }

    public function getImageAttribute()
    {
        return asset($this->getFirstMediaUrl('comment_images', 'thumb') ?: 'storage/default-product.jpg');
    }
}
