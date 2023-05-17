<?php

namespace App\Models\Master;


use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\InfoPersonal;

class MastDepartment extends Model
{
    use HasFactory;
    protected $fillable = [
        'dept_name',
        'description',
        'dept_head',
        'status',
        'user_id'
    ];
    public function infoPersonal()
    {
        return $this->hasOne(InfoPersonal::class);
    }
}
