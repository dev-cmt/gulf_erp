<?php

namespace App\Models\Warranty;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Warranty\Complaint;
use App\Models\Warranty\RequisitionDetails;
use App\Models\User;

class Requisition extends Model
{
    use HasFactory;
    protected $fillable=[
        'requ_no',
        'requ_date',
        'tech_id',
        'complaint_id',
        'status',
        'remarks',
        'user_id',
    ];

    public function requisitionDetails()
    {
        return $this->hasMany(RequisitionDetails::class, 'requisition_id');
    }
    public function complaint()
    {
        return $this->belongsTo(Complaint::class,'complaint_id');
    }
    public function technician()
    {
        return $this->belongsTo(User::class, 'tech_id');
    }
}
