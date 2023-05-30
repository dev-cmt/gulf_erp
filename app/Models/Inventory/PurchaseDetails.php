<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseDetails extends Model
{
    use HasFactory;
    protected $fillable=[
        'qty',
        'price',
        'rcv_qty',
        'status',
        'purchase_id',
        'mast_item_register_id',
        'user_id',
    ];
}
