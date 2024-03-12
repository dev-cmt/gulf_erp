<?php

namespace App\Models\Warranty;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Warranty\Complaint;

class JobCard extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'in_time',
        'out_time',
        'is_tools',
        'is_spare_parts',
        'is_next_visit',
        'is_complete',
        'note',
        'description',
        'complaint_id',
        'tech_id',
        'user_id',
    ];

    public function technician()
    {
        return $this->hasOne(User::class,'id','tech_id');
    }
    public function complaint()
    {
        return $this->hasOne(Complaint::class,'id','complaint_id');
    }
}
