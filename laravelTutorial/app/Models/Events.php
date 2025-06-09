<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Events extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'events';

    public $fillable = [
        'name',
        'description',
        'video_id',
        'post_date',
        'author',
        'is_public',
        'user_id',
    ];

    public function getVideoUrlAttribute()
    {
        return 'https://www.youtube.com/watch?v=' . $this->video_id;
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
        return asset($this->getFirstMediaUrl('event_images', 'thumb') ?: 'storage/default-product.jpg');
    }
}