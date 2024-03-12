<?php

namespace App\Models\Warranty;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Master\MastItemCategory;
use App\Models\Master\MastItemGroup;
use App\Models\Master\MastItemRegister;

class RequisitionDetails extends Model
{
    use HasFactory;
    protected $fillable=[
        'requisition_id',
        'mast_item_category_id',
        'mast_item_group_id',
        'mast_item_register_id',
        'qty',
        'rcv_qty',
        'status',
        'user_id',
    ];

    public function mastItemCategory()
    {
        return $this->belongsTo(MastItemCategory::class, 'mast_item_category_id');
    }
    public function mastItemGroup()
    {
        return $this->belongsTo(MastItemGroup::class, 'mast_item_group_id');
    }
    public function mastItemRegister()
    {
        return $this->belongsTo(MastItemRegister::class, 'mast_item_register_id');
    }
    public function requisition()
    {
        return $this->belongsTo(Requisition::class);
    }
    

}
