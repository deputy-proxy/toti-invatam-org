<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeneficiaryRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'requester_name','email','phone','beneficiary_type','educational_need',
        'target_audience','location','estimated_beneficiaries','requested_support',
        'urgency','status','admin_notes',
    ];
}
