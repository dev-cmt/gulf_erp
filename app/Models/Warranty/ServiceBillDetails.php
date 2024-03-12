<?php

namespace App\Models\Warranty;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceBillDetails extends Model
{
    use HasFactory;

    protected $fillable=[
        'description',
        'qty',
        'price',
        'total',
        'service_bill_id',
        'user_id',
        'status',
    ];

    public function serviceBill()
    {
        return $this->belongsTo(ServiceBill::class, 'service_bill_id');
    }
}
