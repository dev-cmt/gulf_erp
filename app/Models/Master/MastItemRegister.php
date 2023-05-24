<?php

namespace App\Models\Master;

use App\Models\Master\MastUnit;
use App\Models\Master\MastItemGroup;
use App\Models\Master\MastItemCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MastItemRegister extends Model
{
    use HasFactory;

    protected $fillable = [
        'box_code',
        'gulf_code',
        'part_no',
        'description',
        'box_qty',
        'price',
        'image',
        'cat_id',
        'bar_code',
        'user_id',
        'mast_item_group_id',
        'unit_id',
    ];

    public function unit()
    {
        return $this->belongsTo(MastUnit::class);
    }
    public function mastItemGroup()
    {
        return $this->belongsTo(MastItemGroup::class);
    }
}
