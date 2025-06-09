<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Products extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'products';

    public $fillable = [
        'name',
        'description',
        'price',
        'user_id',
        'category_id',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(\App\Models\Categories::class, 'category_id');
    }

    public function invoiceDetails()
    {
        return $this->hasMany(InvoiceDetails::class, 'product_id');
    }

    public function invoices()
    {
        return $this->belongsToMany(Invoices::class, 'invoice_details', 'product_id', 'invoice_id')
            ->withPivot('quantity', 'discount_id', 'status_payment', 'payment_method');
    }

    public function sizes()
    {
        return $this->belongsToMany(Sizes::class, 'product_size', 'product_id', 'size_id');
    }

    public function colors()
    {
        return $this->belongsToMany(Colors::class, 'product_color', 'product_id', 'color_id');
    }

    public function comments()
    {
        return $this->hasMany(Comments::class);
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
        return asset($this->getFirstMediaUrl('product_images', 'thumb') ?: 'storage/default-product.jpg');
    }
}