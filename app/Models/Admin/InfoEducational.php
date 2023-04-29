<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoEducational extends Model
{
    use HasFactory;
    protected $fillable = [
        'qualification',
        'institute_name',
        'passing_year',
        'grade',
    ];
}
