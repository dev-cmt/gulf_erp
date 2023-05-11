<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MastLeave extends Model
{
    use HasFactory;

    protected $fillable = [
        'leave_name',
        'max_limit',
        'leave_code',
        'yearly_limit',
        'description',
        'status',
    ];
}
