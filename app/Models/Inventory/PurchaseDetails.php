<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseDetails extends Model
{
    use HasFactory;
    protected $fillable=[
        'item_id',
        'qty',
        'price',
        'rcv_qty',
        'status',
    ];
}
