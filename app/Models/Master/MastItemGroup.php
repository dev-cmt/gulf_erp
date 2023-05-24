<?php

namespace App\Models\Master;

use App\Models\Master\MastItemRegister;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MastItemGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'part_name',
        'description',
        'status',
        'user_id',
        'cat_id'
    ];

    public function itemName()
    {
        return $this->hasOne(MastItemCategory::class,'id','cat_name');
    }
}
