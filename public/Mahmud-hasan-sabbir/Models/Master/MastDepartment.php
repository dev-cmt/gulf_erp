<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MastDepartment extends Model
{
    use HasFactory;
    protected $fillable = [
        'dept_name',
        'dept_head',
        'description',
        'status'
    ];
}
