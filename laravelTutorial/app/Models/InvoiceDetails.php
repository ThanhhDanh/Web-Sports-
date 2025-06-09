<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetails extends Model
{
    use HasFactory;

    protected $table = 'invoice_details';

    public $fillable = [
        'quantity',
        'unit_price',
        'status_payment',
        'method_payment',
        'discount_id',
        'product_id',
        'invoice_id',
        'size_id',
        'color_id',
    ];

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }

    // Mối quan hệ với Invoice (1 đơn hàng có nhiều chi tiết đơn hàng)
    public function invoice()
    {
        return $this->belongsTo(Invoices::class, 'invoice_id');
    }

    // Mối quan hệ với Discount (1 phiếu giảm giá có nhiều chi tiết đơn hàng)
    public function discount()
    {
        return $this->belongsTo(Discounts::class, 'discount_id');
    }

    public function size()
    {
        return $this->belongsTo(Sizes::class, 'size_id');
    }

    public function color()
    {
        return $this->belongsTo(Colors::class, 'color_id');
    }
}
