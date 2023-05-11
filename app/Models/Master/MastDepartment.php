<?php

namespace App\Models\Master;


use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MastDepartment extends Model
{
    use HasFactory;
    protected $fillable = [
        'dept_name',
        'description',
        'dept_head',
        'status'
    ];

    public function user()
    {
        return $this->hasOne(User::class,'id','dept_head');
    }

}
