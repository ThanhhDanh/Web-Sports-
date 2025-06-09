<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discounts extends Model
{
    use HasFactory;

    protected $table = 'discounts';

    public $fillable = [
        'name',
        'price_discount',
        'expirate_time',
        'amount_discount',
    ];

    public function invoiceDetails()
    {
        return $this->hasMany(InvoiceDetails::class, 'discount_id');
    }
}
