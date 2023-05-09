<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MastEmployeeCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'cat_name',
        'description',
        'status',
    ];
}
