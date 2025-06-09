<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoices extends Model
{
    use HasFactory;

    protected $table = 'invoices';

    public $fillable = [
        'description',
        'total_amount',
        'signature',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function invoiceDetails()
    {
        return $this->hasMany(InvoiceDetails::class, 'invoice_id');
    }

    public function products()
    {
        return $this->belongsToMany(Products::class, 'invoice_details', 'invoice_id', 'product_id')
            ->withPivot('quantity', 'discount_id', 'status_payment', 'method_payment');
    }
}
