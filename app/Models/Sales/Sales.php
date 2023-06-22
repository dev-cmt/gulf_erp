<?php

namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Master\MastCustomer;
use App\Models\Master\MastItemCategory;
use App\Models\Sales\SalesDetails;

class Sales extends Model
{
    use HasFactory;
    protected $fillable = [
        'inv_date',
        'inv_no',
        'vat',
        'tax',
        'status',
        'remarks',
        'mast_item_category_id',
        'mast_distributor_id',
        'user_id'
    ];
    public function mastCustomer()
    {
        return $this->belongsTo(MastCustomer::class);
    }
    public function mastItemCategory()
    {
        return $this->belongsTo(MastItemCategory::class);
    }
    public function salesDetails()
    {
        return $this->hasMany(SalesDetails::class);
    }
}
