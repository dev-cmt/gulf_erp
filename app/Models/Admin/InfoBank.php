<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoBank extends Model
{
    use HasFactory;
    protected $fillable = [
        'bank_name',
        'brance_name',
        'acount_name',
        'acount_no',
        'acount_type',
        'bank_name_office',
        'brance_name_office',
        'acount_name_office',
        'acount_no_office',
        'acount_type_office',
        'status',
        'user_id'
    ];
    
}
