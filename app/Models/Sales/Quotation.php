<?php

namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;
    protected $fillable = [
        'offer_date',
        'ref_no',
        'order_no',
        'vat',
        'tax',
        'remarks',
        'status',
        'mast_item_category_id',
        'mast_customer_id',
        'user_id'
    ];

}
