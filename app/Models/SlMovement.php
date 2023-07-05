<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlMovement extends Model
{
    use HasFactory;

    protected $fillable = [
        'serial_no',
        'ref_id',
        'ref_type',
        'status',
        'mast_item_register_id',
        'mast_work_station_id',
        'user_id',
    ];

}
