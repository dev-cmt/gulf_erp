<?php

namespace App\Models\Warranty;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Master\MastCustomer;
use App\Models\Master\MastComplaintType;

class Complaint extends Model
{
    use HasFactory;
    protected $fillable = [
        'issue_date',
        'issue_no',
        'tech_id',
        'note',
        'remarks',
        'mast_complaint_type_id',
        'mast_customer_id',
        'user_id',
        'view',
        'status',
    ];

    public function mastCustomer()
    {
        return $this->hasOne(MastCustomer::class,'id','mast_customer_id');
    }

    public function compliantType()
    {
        return $this->hasOne(MastComplaintType::class,'id','mast_complaint_type_id');
    }
}
