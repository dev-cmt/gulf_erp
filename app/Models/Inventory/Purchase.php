<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $fillable=[
        'inv_date',
        'inv_no',
        'sup_id',
        'cat_id',
        'store_id',
        'status',
        'remarks',
        'user_id',
    ];
}
