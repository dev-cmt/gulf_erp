<?php

namespace App\Models\Warranty;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Master\MastCustomer;
use App\Models\Warranty\Complaint;
use App\Models\Warranty\ServiceBillDetails;
use App\Models\User;

class ServiceBill extends Model
{
    use HasFactory;

    protected $fillable=[
        'bill_no',
        'bill_date',
        'complaint_id',
        'mast_customer_id',
        'tech_id',
        'user_id',
        'remarks',
        'status',
    ];

    public function complaint()
    {
        return $this->belongsTo(Complaint::class,'complaint_id');
    }
    public function technician()
    {
        return $this->belongsTo(User::class, 'tech_id');
    }
    public function serviceBillDetails()
    {
        return $this->belongsTo(ServiceBillDetails::class, 'service_bill_id');
    }
    public function mastCustomer()
    {
        return $this->hasOne(MastCustomer::class, 'mast_customer_id');
    }
}
