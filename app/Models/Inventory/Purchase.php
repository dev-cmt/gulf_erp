<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Master\MastWorkStation;
use App\Models\Master\MastSupplier;

class Purchase extends Model
{
    use HasFactory;
    protected $fillable=[
        'inv_date',
        'inv_no',
        'mast_supplier_id',
        'mast_item_category_id',
        'mast_work_station_id',
        'status',
        'remarks',
        'user_id',
    ];
    public function mastSupplier()
    {
        return $this->belongsTo(MastSupplier::class);
    }
    public function mastWorkStation()
    {
        return $this->belongsTo(MastWorkStation::class);
    }
}
