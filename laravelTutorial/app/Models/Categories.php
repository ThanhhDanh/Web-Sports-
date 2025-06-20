<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Categories extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'categories';

    public $fillable = [
        'name',
        'description',
    ];

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(200)
            ->height(200)
            ->sharpen(10);
    }

    public function getImageAttribute()
    {
        return asset($this->getFirstMediaUrl('category_images', 'thumb') ?: 'storage/default-product.png');
    }
}
